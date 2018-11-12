import { Module } from 'vuex'
import { RootState } from '@/store'
import { namespace } from 'vuex-class'

const _namespace = 'drawer'
export const StateDrawer = namespace(_namespace).State
export const GetterDrawer = namespace(_namespace).Getter
export const MutationDrawer = namespace(_namespace).Mutation
export const ActionDrawer = namespace(_namespace).Action

export interface DrawerState {
  drawer?: boolean
  mini?: boolean
  display?: boolean
}

const drawer = {
  namespaced: true,
  state: {
    drawer: undefined,
    mini: undefined,
    display: undefined
  },
  getters: {
    Drawer (state: DrawerState) {
      return state.drawer
    },
    DrawerMini (state: DrawerState) {
      return state.mini
    },
    DrawerDisplay (state: DrawerState) {
      return state.display
    }
  },
  mutations: {
    setDrawer (state: DrawerState, value: boolean) {
      state.drawer = value
    },
    setDrawerMini (state: DrawerState, value: boolean) {
      state.mini = value
    },
    setDrawerDisplay (state: DrawerState, value: boolean) {
      state.display = value
    }
  }
} as Module<DrawerState, RootState>

export default drawer
