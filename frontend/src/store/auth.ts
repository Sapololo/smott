import { Module } from 'vuex'
import { RootState } from '@/store'
import { Action, Getter, Mutation, namespace, State } from 'vuex-class'

const _namespace = 'auth'
export const StateAuth = namespace(_namespace, State)
export const GetterAuth = namespace(_namespace, Getter)
export const MutationAuth = namespace(_namespace, Mutation)
export const ActionAuth = namespace(_namespace, Action)

export interface Payload {
  username: string
  lastName: string
  firstName: string
  email: string
  licenceId: string
  adresseId: string
  genre: string
  enabled: boolean
  roles: string[]
  exp: number
  iat: number
}

export interface AuthState {
  payload?: Payload
}

const auth = {
  namespaced: true,
  state: {
    payload: undefined
  },
  getters: {
    authenticated: (state: AuthState) => {
      return !!state.payload
    },
    payload: (state: AuthState) => {
      return state.payload
    }
  },
  mutations: {
    login (state: AuthState, payload: Payload) {
      state.payload = payload
    },
    logout (state: AuthState) {
      state.payload = undefined
    }
  }
} as Module<AuthState, RootState>

export default auth
