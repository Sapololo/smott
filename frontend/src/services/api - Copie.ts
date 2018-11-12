import axios, { AxiosError, AxiosInstance, AxiosRequestConfig, AxiosResponse } from 'axios'

import jwtDecode from 'jwt-decode'
import { Store } from 'vuex'
import cloneDeep from 'lodash/cloneDeep'

import { Payload } from '@/store/auth'
import errorHandler from '@/errorHandler'

const TOKEN_STORAGE_KEY = 'token'
const REFRESH_TOKEN_STORAGE_KEY = 'refreshToken'
const SAVE_CREDENTIALS_STORAGE_KEY = 'saveCredentials'

export interface IAuth {
  /**
   * Obtient le payload de l'utilisateur connecté (JWT), ou undefined si l'utilisateur n'est pas connecté.
   *
   * @returns {Payload | undefined}
   */
  getPayload (): Payload | undefined

  /**
   * Vérifie que l'utilisateur est connecté.
   *
   * @returns {boolean}
   */
  isAuthenticated (): boolean

  /**
   * S'authentifie.
   *
   * @param username
   * @param password
   * @param saveCredentials
   */
  login (username: string, password: string, saveCredentials?: boolean): Promise<AxiosResponse>

  logout (): Promise<any>
}

interface RenewTokenRequestConfig extends AxiosRequestConfig {
  renewToken?: boolean
}

/**
 * Couche d'accès aux données fournies par l'API.
 */
export default class ApiService implements IAuth {
  axios: AxiosInstance

  private payload?: Payload
  private token?: string
  private refreshToken?: string | null
  private saveCredentials?: boolean

  private responseInterceptor?: number
  private requestInterceptor?: number
  private store: Store<any>

  private renewTokenRunning: boolean = false
  private renewTokenPromises: { promise: Promise<any>, resolve: any, reject: any }[] = []

  constructor (config: AxiosRequestConfig, store: Store<any>) {
    this.axios = axios.create(config)
    this.store = store

    let existingToken = window.sessionStorage.getItem(TOKEN_STORAGE_KEY)
    let existingRefreshToken = window.sessionStorage.getItem(REFRESH_TOKEN_STORAGE_KEY)
    let saveCredentials = window.sessionStorage.getItem(SAVE_CREDENTIALS_STORAGE_KEY) === 'true'

    if (!existingToken) {
      existingToken = window.localStorage.getItem(TOKEN_STORAGE_KEY)
    }

    if (!existingRefreshToken) {
      existingRefreshToken = window.localStorage.getItem(REFRESH_TOKEN_STORAGE_KEY)
    }

    if (!saveCredentials) {
      saveCredentials = window.localStorage.getItem(SAVE_CREDENTIALS_STORAGE_KEY) === 'true'
    }

    if (existingToken) {
      this.setTokens(existingToken, existingRefreshToken, saveCredentials)
    } else {
      this.unsetTokens()
    }

    this.addDefaultInterceptors()
    this.addInterceptors()
  }

  getPayload (): Payload | undefined {
    return this.payload
  }

  getToken (): string | undefined {
    return this.token
  }

  getRefreshToken (): string | null | undefined {
    return this.refreshToken
  }

  isAuthenticated (): boolean {
    return !!this.token
  }

  login (username: string, password: string, saveCredentials?: boolean): Promise<AxiosResponse> {
    return this.axios.post('login_check', { username: username, password: password }).then((response) => {
      this.setTokens(response.data.token, response.data.refresh_token, saveCredentials === undefined ? this.saveCredentials : saveCredentials)
      // TODO: Store TTL to refresh token before 401 error
      return response
    })
  }

  logout (): Promise<void> {
    this.unsetTokens()
    if (window.stop) {
      window.stop() // Annnule toutes les requêtes en cours. Non supporté sur IE.
    }

    let promise = new Promise<void>((resolve, reject) => {
      resolve()
    })
    return promise
  }

  async renewToken () {
    if (!this.renewTokenRunning) {
      try {
        this.renewTokenRunning = true
        const response = await this.axios.post('/api/token/refresh', { refresh_token: this.refreshToken }, { renewToken: true } as AxiosRequestConfig)
        this.setTokens(response.data.token, response.data.refresh_token, this.saveCredentials)
        for (const renewTokenPromise of this.renewTokenPromises) {
          renewTokenPromise.resolve(response)
        }
        return response
      } catch (err) {
        for (const renewTokenPromise of this.renewTokenPromises) {
          renewTokenPromise.reject(err)
        }
        errorHandler(err)
        throw err
      } finally {
        this.renewTokenRunning = false
        this.renewTokenPromises = []
      }
    } else {
      const renewTokenPromise = new Promise((resolve, reject) => {
        this.renewTokenPromises.push({ promise: renewTokenPromise, resolve, reject })
      })
      const response = await renewTokenPromise
      return response
    }
  }

  private addDefaultInterceptors () {
    this.axios.interceptors.request.use((config) => {
      config.data = cloneDeep(config.data)
      if (config.data && config.data.$axios) {
        delete config.data.$axios
      }
      return config
    })
  }

  private addInterceptors () {
    if (this.requestInterceptor === undefined) {
      this.requestInterceptor = this.axios.interceptors.request.use((config) => {
        if (this.token) {
          config.headers.Authorization = 'Bearer ' + this.token
        }
        return config
      })
    }

    if (this.responseInterceptor === undefined) {
      this.responseInterceptor = this.axios.interceptors.response.use((response: AxiosResponse) => response, (error: AxiosError) => {
        let response = error.response
        let config = error.config

        if (response && config.headers.Authorization) {
          if (response.status === 401 && response.data.message === 'Expired JWT Token' &&
            (!response.config || !(response.config as RenewTokenRequestConfig).renewToken) &&
            this.refreshToken) {
            console.log('Token JWT expiré. Reconnexion ...')

            return this.renewToken().then(() => {
              error.config.baseURL = undefined // Workaround
              return this.axios.request(error.config)
            }).then((response: AxiosResponse) => {
              console.log('Reconnecté !')
              return response
            }).catch((err: any) => {
              console.log('Echec de la reconnexion ! ' + err + '.')
              this.unsetTokens()
              throw err
            })
          } else if (response.status === 401 &&
            response.config && (response.config as RenewTokenRequestConfig).renewToken &&
            this.refreshToken) {
            if (error.message) {
              error.message = `Echec de la reconnexion automatique ! ${error.message}`
            } else {
              error.message = 'Echec de la reconnexion automatique !'
            }
            this.unsetTokens()
          }
        }

        errorHandler(error)
        return Promise.reject(error)
      })
    }
  }

  public unsetTokens () {
    window.sessionStorage.removeItem(TOKEN_STORAGE_KEY)
    window.sessionStorage.removeItem(REFRESH_TOKEN_STORAGE_KEY)
    window.sessionStorage.removeItem(SAVE_CREDENTIALS_STORAGE_KEY)
    window.localStorage.removeItem(TOKEN_STORAGE_KEY)
    window.localStorage.removeItem(REFRESH_TOKEN_STORAGE_KEY)
    window.localStorage.removeItem(SAVE_CREDENTIALS_STORAGE_KEY)
    this.token = undefined
    this.refreshToken = undefined
    this.saveCredentials = false
    this.payload = undefined
    this.store.commit('auth/logout')
  }

  public setTokens (token: string, refreshToken?: string | null, saveCredentials?: boolean) {
    let payload = jwtDecode(token)
    window.sessionStorage.setItem(TOKEN_STORAGE_KEY, token)

    if (refreshToken) {
      window.sessionStorage.setItem(REFRESH_TOKEN_STORAGE_KEY, refreshToken)
    } else {
      window.sessionStorage.removeItem(REFRESH_TOKEN_STORAGE_KEY)
    }

    if (saveCredentials) {
      window.sessionStorage.setItem(SAVE_CREDENTIALS_STORAGE_KEY, '' + saveCredentials)
    } else {
      window.sessionStorage.removeItem(SAVE_CREDENTIALS_STORAGE_KEY)
    }

    if (saveCredentials) {
      window.localStorage.setItem(TOKEN_STORAGE_KEY, token)
      if (refreshToken) {
        window.localStorage.setItem(REFRESH_TOKEN_STORAGE_KEY, refreshToken)
      } else {
        window.localStorage.removeItem(REFRESH_TOKEN_STORAGE_KEY)
      }

      window.localStorage.setItem(SAVE_CREDENTIALS_STORAGE_KEY, '' + saveCredentials)
    } else {
      window.localStorage.removeItem(TOKEN_STORAGE_KEY)
      window.localStorage.removeItem(REFRESH_TOKEN_STORAGE_KEY)
      window.localStorage.removeItem(SAVE_CREDENTIALS_STORAGE_KEY)
    }

    this.token = token
    this.refreshToken = refreshToken
    this.saveCredentials = !!saveCredentials
    this.payload = payload as Payload
    this.store.commit('auth/login', payload)
  }
}
