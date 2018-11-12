import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth'
import snackbar from './snackbar'
import dialog from './dialog'
import dialogApp from './dialogApp'
import drawer from './drawer'

Vue.use(Vuex)

export interface RootState {
  [stateKey: string]: any
}

export default new Vuex.Store<RootState>({
  state: {} as RootState,
  modules: {
    auth,
    snackbar,
    dialog,
    dialogApp,
    drawer
  },
  strict: false
})
