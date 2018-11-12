<template>
  <div class="telethon">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-toolbar flat dense color="primary" class="mb-2">
        <v-toolbar-title>VAINCRE LA MALADIE, C'EST ENFIN POSSIBLE</v-toolbar-title>
      </v-toolbar>

      <v-layout row>
        <v-flex xs12 md8 mr-2>
          <v-layout column justify-space-between fill-height>
            <v-card color="brown lighten-5">
              <v-card-text>
                <p>Lors de ce week-end particulier, le club s'associe à cet événement par l'organisation d'un tournoi
                  ouvert à tous pendant le créneau "PNG POUR TOUS" du samedi matin</p>
              </v-card-text>
            </v-card>
          </v-layout>
        </v-flex>
        <v-flex xs12 md4 class="text-xs-center">
          <v-layout column justify-space-between fill-height>
            <v-card color="blue darken-3" height="100%">
              <v-card-text>
                <h2 class="white--text">Nombre de participants</h2>
                <p class="white--text">
                  <v-icon class="mdi mdi-clock white--text">mdi-human-child</v-icon>
                  Autant que possible
                </p>
                <v-divider color="white"></v-divider>
                <h2 class="white--text">Période</h2>
                <p class="white--text">Samedi 8 Décembre 2018</p>
              </v-card-text>
            </v-card>
          </v-layout>
        </v-flex>
      </v-layout>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class Telethon extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
