declare module 'vue-body-class' {
  import { PluginObject } from 'vue/types/plugin'

  export interface VueBodyClass extends PluginObject<any> {
  }

  const vueBodyClass: VueBodyClass
  export default vueBodyClass
}
