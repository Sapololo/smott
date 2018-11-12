<template>
  <div class="carte-licencie">
    <v-flex xs12>
      <google-map :listLicencie="listLicencie"/>
    </v-flex>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import GoogleMap from '../GoogleMap.vue'

@Component({ components: { GoogleMap } })

export default class CarteLicencie extends Vue {
  listLicencie: boolean = true
  latitude: number = 0
  longitude: number = 0

  mounted () {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(position => {
        this.latitude = position.coords.latitude
        this.longitude = position.coords.longitude
      })
    }
  }
}
</script>

<style scoped>
</style>
