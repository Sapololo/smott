<template>
  <div class="loisirs">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-toolbar flat dense color="primary">
        <v-toolbar-title>Vous avez envie de pratiquer le tennis de table en vous amusant dans une
                ambiance conviviale.</v-toolbar-title>
      </v-toolbar>
      <v-layout row wrap>
        <v-flex d-flex xs12 md8>
          <v-card>
            <v-img src="/img/galerie/2014/20140122_loisir_compt/DSCN0432.jpg" height="235px"/>
            <v-card-text>
              <p>Venez rejoindre nos différentes sections loisirs. En effet, le Club de Saint Marceau
                TT met tout en
                oeuvre pour toucher le public le plus large.</p>
              <p>La salle harismendy est accessible pendant les autres créneaux, dans la limite des
                tables
                restantes.</p>
              <p>Pendant les vacances scolaires, des créneaux sont aussi mis à la disposition des
                adhérents, et non
                adhérents.</p>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex d-flex xs12 md4>
          <v-layout column>
            <v-flex d-flex xs12 class="text-xs-center">
              <v-card class="text-xs-center" height="100%">
                <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin blue lighten-1 py-4"><h1>Séance dirigée</h1></span>
                </v-card-title>
                <v-card-text>
                  <h1>Mercredi de 20h30 à 22h</h1>
                </v-card-text>
              </v-card>
            </v-flex>
            <v-flex d-flex xs12 class="text-xs-center">
              <v-card class="text-xs-center" height="100%">
                <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin teal lighten-1 py-4"><h1>Séance libre</h1></span>
                </v-card-title>
                <v-card-text>
                  <h1>Jeudi de 19h30 à 21h</h1>
                </v-card-text>
              </v-card>
            </v-flex>
            <v-flex d-flex xs12 class="text-xs-center">
              <v-card class="text-xs-center" height="100%">
                <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin orange lighten-1 py-4"><h1>Loisirs/Vétérans</h1></span>
                </v-card-title>
                <v-card-text pb-2>
                  <h1>Mardi &amp; Vendredi de 13h30 à 15h45</h1>
                </v-card-text>
              </v-card>
            </v-flex>
            <v-flex d-flex xs12 class="text-xs-center">
              <v-card class="text-xs-center" height="100%">
                <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin green lighten-1 py-4"><h1>Ping pour tous</h1></span>
                </v-card-title>
                <v-card-text>
                  <h1>Samedi de 10h à 12h</h1>
                </v-card-text>
              </v-card>
            </v-flex>
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
export default class Loisirs extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>

<style lang="scss" scoped>
h1 {
  -webkit-box-flex: 1;
  -ms-flex: 1 1 auto;
  flex: 1 1 auto;
}
</style>
