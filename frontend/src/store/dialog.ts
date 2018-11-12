import { Module } from 'vuex'
import { RootState } from './index'
import { namespace } from 'vuex-class'
import { Vue } from 'vue/types/vue'

const _namespace = 'dialog'
export const StateDialog = namespace(_namespace).State
export const GetterDialog = namespace(_namespace).Getter
export const MutationDialog = namespace(_namespace).Mutation
export const ActionDialog = namespace(_namespace).Action

export interface DialogEntry {
  message?: string
  icon?: string
  title?: string
  trueandfalse?: boolean
  onOk?: () => void
  okLabel?: string
  onCancel?: () => void
  cancelLabel?: string
  component?: string | typeof Vue
  componentProps?: object
}

export interface DialogState {
  entry?: DialogEntry | null
}

const dialog = {
  namespaced: true,
  state: {
    entry: undefined
  },
  mutations: {
    setDialogEntry (state: DialogState, payload: DialogEntry | null) {
      state.entry = payload
    },
    clearDialogEntry (state: DialogState) {
      state.entry = undefined
    }
  },
  getters: {
    currentDialogEntry (state: DialogState): DialogEntry | undefined | null {
      return state.entry
    }
  }
} as Module<DialogState, RootState>

export default dialog
