import { intersection } from 'lodash'
import { default as VueRouter, Route } from 'vue-router/types'
import { IAuth } from '@/services/api'
import { AxiosResponse } from 'axios'
import { Payload } from '@/store/auth'
import store from '@/store'
import Vue from 'vue'

/**
 * Données associées à un state pour les autorisations d'accès.
 */
export interface IStateAccessData {
  /**
   * Rôles autorisés pour l'accès à un state.
   */
  allowedRoles?: string[]

  /**
   * Autorise les accès anonymes.
   */
  allowAnonymous?: boolean

  /**
   * Fonction permettant d'évaluer l'autorisation d'accès à un state.
   */
  allowFunction?: { (route: Route, auth: IAuth): boolean }
}

/**
 * Type d'évenement d'authentification.
 */
export type AuthType = 'login' | 'logout'

/**
 * Listener notifiant les évènement d'authentification.
 */
export interface IAuthListener {
  (event: AuthEvent): any
}

/**
 * Evenement d'authentification.
 */
export class AuthEvent {
  type: AuthType
  payload?: Payload

  constructor (type: AuthType, payload?: Payload) {
    this.type = type
    this.payload = payload
  }
}

/**
 * Service d'accès en fonction de l'utilisateur connecté.
 */
export default class AccessService implements IAuth {
  private auth: IAuth

  private authListeners: IAuthListener[] = []
  private router: VueRouter

  /**
   * @param router
   * @param auth Authentication provider.
   */
  constructor (router: VueRouter, auth: IAuth) {
    this.router = router
    this.auth = auth

    this.router.beforeEach((to, from, next) => {
      if (!this.isAllowed(to)) {
        if (!from.name && from.path === '/') {
          next({ name: 'Home' })
        } else {
          next(false)
        }

        Vue.nextTick(() => {
          store.commit('snackbar/setSnackbarEntry', {
            color: 'error',
            icon: 'mdi-alert-decagram',
            message: `Vous n'avez pas le droit d'accéder à cette page ! Uniquement accessible aux adhérents au club.`
          })
        })
      } else {
        next()
      }
    })
  }

  /**
   * Enregistre un listener d'authentification.
   *
   * @param listener
   */
  public addAuthListener (listener: IAuthListener) {
    this.authListeners.push(listener)
  }

  /**
   * Supprime l'enregistrement d'un listener d'authentification.
   *
   * @param listener
   * @returns {boolean}
   */
  public removeAuthListener (listener: IAuthListener) {
    let index = this.authListeners.indexOf(listener, 0)
    if (index > -1) {
      this.authListeners.splice(index, 1)
      return true
    }
    return false
  }

  /**
   * Obtient le payload de l'utilisateur connecté (JWT), ou null si l'utilisateur n'est pas connecté.
   *
   * @returns {Payload | undefined}
   */
  public getPayload (): Payload | undefined {
    return this.auth.getPayload()
  }

  /**
   * Obtient les rôles de l'utilisateur connecté (JWT), ou bien un tableau vide si l'utilisateur n'est pas connecté.
   *
   * @returns {string[]}
   */
  public getRoles (): string[] {
    let payload = this.getPayload()
    return payload ? payload.roles : []
  }

  /**
   * Vérifie que l'utilisateur est connecté.
   *
   * @returns {boolean}
   */
  public isAuthenticated (): boolean {
    return this.auth.isAuthenticated()
  }

  /**
   * Authentifie l'utilisateur.
   *
   * @param username
   * @param password
   * @param saveCredentials
   * @returns {Promise<any>}
   */
  public login (username: string, password: string, saveCredentials: boolean = false): Promise<AxiosResponse> {
    return this.auth.login(username, password, saveCredentials).then((response: AxiosResponse) => {
      this.fireAuthEvent(new AuthEvent('login', this.getPayload()))
      return response
    })
  }

  /**
   * Oublie l'authentification de l'utilisateur.
   *
   * @returns {Promise<void>}
   */
  public logout (): Promise<void> {
    return this.auth.logout().then(() => this.fireAuthEvent(new AuthEvent('logout')))
  }

  /**
   * Vérifie l'autorisation d'accès à un state.
   *
   * L'accès est autorisé si allowAnonymous est vrai, ou bien que l'utilisateur est authentifié et possède au moins un
   * rôle présent dans allowedRoles.
   *
   * @param route
   * @returns {boolean}
   */
  public isAllowed (route: Route): boolean {
    let accessData: IStateAccessData = route.meta ? route.meta.access : {}

    if (!accessData) {
      accessData = {}
    }

    let allowFunction = accessData.allowFunction

    if (!allowFunction) {
      allowFunction = () => {
        if (accessData.allowAnonymous) {
          return true
        }
        if (!this.isAuthenticated()) {
          return false
        }
        if (!accessData.allowedRoles) {
          return true
        }
        return intersection(this.getRoles(), accessData.allowedRoles).length > 0
      }
    }

    return allowFunction(route, this.auth)
  }

  private fireAuthEvent (event: AuthEvent) {
    for (let listener of this.authListeners) {
      listener(event)
    }
  }
}
