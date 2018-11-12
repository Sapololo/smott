<template>
  <div class="qui-fait-quoi">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-toolbar flat dense color="primary" class="mb-2">
        <v-toolbar-title>PING TOUR</v-toolbar-title>
      </v-toolbar>

      <v-layout row>
        <v-flex xs12 md8 mr-2>
          <v-layout column justify-space-between fill-height>
            <v-card color="brown lighten-5">
              <v-card-text>
                <p>"Urban Ping" est une action Urbaine, qui propose aux passants la
                  découverte d'un
                  sport, ici le "Ping Pong", plus connu sous Tennis de Table.<br/>Cette discipline, aussi appelée le
                  "Street
                  Ping", a pour but de démocratiser le Tennis de Table en le proposant au plus grand nombre dans un
                  endroit où
                  tout le monde peut accéder, à savoir « devant chez soi ».<br/>Le "Street Ping" est une pratique
                  consistant à
                  transposer le Tennis de Table dans un nouvel environnement : la rue.</p>
                <p>Cette pratique est reconnu scientifiquement pour le bien-être des pratiquants, aussi bien en
                  loisir, qu'en
                  compétition, et surtout à tout âge.</p>
                <p>Saint Marceau Orléans Tennis de Table propose cette action au niveau de la Croix Saint Marceau,
                  début
                  Septembre de chaque année.</p>
                <p>L'occasion de décourvrir de nouveaux sports comme le "Headis", tout à fait Urbain, qui mélange le
                  football
                  sur une table de ping uniquement avec la tête.</p>
                <p>C’est aussi l’occasion de visiter l’Eglise fleurie pour la St Fiacre, et le marché devant
                  l’Eglise.</p>
                <h4>Venez nous rejoindre</h4>
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
                <p class="white--text">1er weekend de Septembre</p>
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
export default class UrbanPing extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
