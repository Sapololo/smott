import 'babel-polyfill' // Polyfills chargés automatiquement
import smoothscroll from 'smoothscroll-polyfill'

require('custom-event-polyfill') // For IE11 suppor

import './router-hooks'
import Vue from 'vue'
import errorHandler from '@/errorHandler'
import App from './App.vue'
import router from './router'
import store from './store'
import services from './services'
import config from './config'
import './registerServiceWorker'
import Vuetify from 'vuetify'
import vbclass from 'vue-body-class'
import vhclass from './lib/vue-html-class'
import VueMoment from 'vue-moment'
import * as moment from 'moment'
import 'moment/locale/fr'
// https://github.com/declandewet/vue-meta
import VueMeta  from 'vue-meta'
import VueFlip from 'vue-flip'
// https://github.com/dzava/vue-slug-input/
import SlugInput from 'vue-slug-input'
// https://github.com/xkjyeah/vue-google-maps
import * as VueGoogleMaps from 'vue2-google-maps'
// https://www.highcharts.com/blog/tutorials/highcharts-vue-wrapper/
// https://github.com/weizhenye/vue-highcharts
import VueHighcharts from 'vue-highcharts'
// https://github.com/MatteoGabriele/vue-analytics/
import VueAnalytics from 'vue-analytics'

Vue.config.errorHandler = errorHandler

require('css-element-queries/src/ElementQueries')

require('material-design-icons/iconfont/material-icons.css')
require('@mdi/font/scss/materialdesignicons.scss')
require('roboto-fontface/css/roboto/sass/roboto-fontface-regular.scss')
require('roboto-fontface/css/roboto/sass/roboto-fontface-thin.scss')
require('roboto-fontface/css/roboto/sass/roboto-fontface-regular-italic.scss')
require('./styles/theme.scss')

require('vuetify/dist/vuetify.css') // Ensure you are using css-loader

smoothscroll.polyfill()
// VueMoment()
// require('moment/locale/fr')
Vue.use(VueMoment, { moment })
// VueFlip()
Vue.use(VueFlip)
// VueSlugInput
Vue.use(SlugInput)

Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyB4dcprzKs1otPR24eU2Vx9NTPEVTs1BIM',
    libraries: 'places'
  },
  installComponents: true
})

Vue.use(VueAnalytics, {
  id: 'UA-35276216-1', router
})

Vue.use(VueMeta
//   {
//   keyName: 'metaInfo', // the component option name that vue-meta looks for meta info on.
//   attribute: 'data-vue-meta', // the attribute name vue-meta adds to the tags it observes
//   ssrAttribute: 'data-vue-meta-server-rendered', // the attribute name that lets vue-meta know that meta info has already been server-rendered
//
// tagIDKeyName: 'vmid' // the property name that vue-meta uses to determine whether to overwrite or append a tag
// }
)

Vue.use(Vuetify, {
  theme: {
    'primary': '#ff3434',
    'secondary': '#404040',
    'third': '#009688',
    'twitter': '#55acee',
    'facebook': '#3b5998',
    'google-plus': '#dd4b39',
    'youtube': '#ff0000'
  }
})

Vue.use(vbclass, router)
Vue.use(vhclass, router)

Vue.use(VueHighcharts)

Vue.prototype.$device = services.device
Vue.prototype.$permission = services.permission
Vue.prototype.$utils = {
  console: console
}

var filter = function (text, length, clamp) {
  clamp = clamp || '...'
  var node = document.createElement('div')
  node.innerHTML = text
  var content = node.textContent
  return content.length > length ? content.slice(0, length) + clamp : content
}
Vue.filter('truncate', filter)

new Vue({
  router,
  store,
  provide: { config, ...services },
  metaInfo: () => ({
    title: 'Bienvenue au Tennis de table de SAINT MARCEAU ORLEANS, l\'actualité et les résultats',
    // titleTemplate: this.$route.name + ' - Saint Marceau Orléans Tennis de Table | stmarceautt.fr',
    meta: [
      // { vmid: 'charset', charset: 'utf-8' },
      // {'http-equiv': 'Content-Type', content: 'text/html; charset=utf-8'},
      { name: 'viewport', content: 'width=device-width, initial-scale=1.0' },
      {
        name: 'description',
        content: 'Suivez, retrouvez l&#039;actualité, les résultats, les videos et photos préférés, toutes les actions et événement proposés par le club, situé dans le quartier Saint Marceau.'
      },
      { name: 'Reply-to', content: 'stmarceau.tt@free.fr' },
      { name: 'Revisit-after', content: '14 days' },
      { name: 'Robots', content: 'all' },
      { name: 'Content-Language', content: 'fr' },
      // Twitter card
      { name: 'twitter:card', content: 'summary' },
      { name: 'twitter:site', content: '@stmarceautt' },
      { name: 'twitter:title', content: 'Bienvenu sur Saint Marceau Orléans Tennis de Table' },
      { name: 'twitter:image', content: 'http://stmarceautt.fr/logo_560.png' },
      { name: 'twitter:url', content: 'http://stmarceautt.fr/' },
      {
        name: 'twitter:description',
        content: 'Suivez, retrouvez l&amp;#039;actualité, les résultats, les videos et photos préférés, toutes les actions et événement proposés par le club, situé dans le quartier Saint Marceau.'
      },
      {
        property: 'og:title',
        content: 'Bienvenue au Tennis de table de SAINT MARCEAU ORLEANS, l\'actualité et les résultats - Saint Marceau Orléans Tennis de Table - stmarceautt.fr'
      },
      { property: 'og:type', content: 'website' },
      { property: 'og:url', content: 'http://stmarceautt.fr/' },
      { property: 'og:image', content: 'http://stmarceautt.fr/icons/smott-logo.png' },
      {
        property: 'og:description',
        content: 'Suivez, retrouvez l\'actualité, les résultats, les videos et galeries préférés, toutes les actions et événement proposés par le club, situé dans le quartier Saint Marceau.'
      },
      { property: 'og:site_name', content: 'Saint Marceau Orléans Tennis de Table' }
    ]
  }),
  render: (h) => h(App)
}).$mount('#app')
