import store from './store'
import translate from '@/api/translation'
import services from '@/services'
import router from '@/router'
import { SnackbarEntry } from '@/store/snackbar'

import { AxiosResponse } from 'axios'

const errorHandler = function (err: any, vm?: any, info?: any) {
  if (!err.__handled__ && !err.__CANCEL__ && err.message !== 'Network Error') {
    const snackbar = {
      title: 'Une erreur inattendue s\'est produite.',
      icon: 'mdi-alert',
      message: err.message,
      color: 'error'
    } as SnackbarEntry

    let afterDisplay: () => any = () => {
      // Do nothing
    }

    if (err.response) {
      const response = err.response as AxiosResponse
      let responseMessage = response.data ? response.data.message : undefined

      snackbar.title = response.statusText

      if (response.status === 404 || response.status === 504) {
        snackbar.message = 'Impossible de contacter la plateforme. Veuillez réessayer ultérieurement.'
      } else if (responseMessage) {
        snackbar.message = response.data.message
      }

      if (response.status === 401 && responseMessage && responseMessage === 'Expired JWT Token'
        || (response.status === 401 && /Refresh token .* is invalid\./g.test(responseMessage))) {
        store.commit('snackbar/setSnackbarEntry', {
          icon: 'mdi-alert-circle',
          title: 'Session expirée',
          message: 'Veuillez vous connecter à nouveau',
          color: 'info'
        })

        afterDisplay = () => {
          return services.api.logout().then(() => {
            router.push({ name: 'Home' })
          })
        }
      }
    }

    if (snackbar.title) {
      snackbar.title = translate(snackbar.title)
      snackbar.title = snackbar.title
    }

    if (snackbar.message) {
      snackbar.message = translate(snackbar.message)
      snackbar.message = snackbar.message
    }

    if (info) {
      snackbar.message += ' (' + info + ')'
    }

    err.__handled__ = true
    store.commit('snackbar/setSnackbarEntry', snackbar)
    afterDisplay()
  }

  if (console.error) {
    console.error(err)
  } else {
    console.log(err)
  }
}

export default errorHandler
