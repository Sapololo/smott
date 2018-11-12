import { AxiosRequestConfig } from 'axios'

export interface Config {
  api: AxiosRequestConfig
  mapserverUrl: { [key: string]: string }
}

export default {
  api: {
    // baseURL: '/api'
    // baseURL: 'http://api.stmarceautt.fr'
    baseURL: 'http://recette.stmarceautt.fr'
    // baseURL: 'http://127.0.0.1:8000'
  }
}
