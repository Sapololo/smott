import { Module } from 'vuex'
import { RootState } from '@/store'
import { namespace } from 'vuex-class'

const _namespace = 'dialogApp'
export const StateDialogApp = namespace(_namespace).State
export const GetterDialogApp = namespace(_namespace).Getter
export const MutationDialogApp = namespace(_namespace).Mutation
export const ActionDialogApp = namespace(_namespace).Action

export interface DialogAppState {
  contact?: boolean
  login?: boolean
}

const dialogApp = {
  namespaced: true,
  state: {
    contact: undefined,
    login: undefined
  },
  getters: {
    DialogAppContact (state: DialogAppState) {
      return state.contact
    },
    DialogAppLogin (state: DialogAppState) {
      return state.login
    }
  },
  mutations: {
    setDialogAppContact (state: DialogAppState, value: boolean) {
      state.contact = value
    },
    setDialogAppLogin (state: DialogAppState, value: boolean) {
      state.login = value
    }
  }
} as Module<DialogAppState, RootState>

export default dialogApp
