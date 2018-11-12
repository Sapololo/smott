<template>
  <div class="coaching-personnalise">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-toolbar flat dense color="primary" class="mb-2">
        <v-toolbar-title>COMMENT PROGRESSER AU TENNIS DE TABLE</v-toolbar-title>
      </v-toolbar>

      <v-layout row>
        <v-flex xs12 md8 mr-2>
          <v-layout column justify-space-between fill-height>
            <v-card color="brown lighten-5" height="100%">
              <v-card-media><img src="/img/pages/coaching-personnalise.jpg"/></v-card-media>
              <v-card-text>
                <p>Le club propose un coaching personnalisé individuel ou en groupe avec un
                  entraîneur diplômé d’état 2nd degré ou joueur numéroté possible. Cet entraînement privé
                  permet de
                  progresser rapidement en améliorant tous ses points faibles et en progressant
                  techniquement et
                  physiquement. Si vous souhaitez progresser de votre côté, ces entraînements vous
                  donnerons quelques
                  pistes à mettre en place afin de progresser plus rapidement au tennis de table !</p>
                <p>Renseignement par mail ou auprès des membres du bureau.</p>
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
                  1 à 5 personnes
                </p>
                <v-divider color="white"></v-divider>
                <h2 class="white--text">Période</h2>
                <p class="white--text">Toute l'année</p>
                <v-divider color="white"></v-divider>
                <h2 class="white--text">Durée</h2>
                <p class="white--text">1 à 2h</p>
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
export default class CoachingPersonnalise extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
