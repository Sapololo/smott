<template>
  <div class="carte-des-partenaires">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <v-layout row>
        <v-flex xs12>
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Retrouvez toutes les adresses de nos partenaires</v-toolbar-title>
          </v-toolbar>
          <v-card>
            <v-card-text>
              <google-map :listPartenaire="listPartenaire"/>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import GoogleMap from '../GoogleMap.vue'

@Component({ components: { GoogleMap } })
export default class CarteDesPartenaires extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  listPartenaire: boolean = true
}
</script>
