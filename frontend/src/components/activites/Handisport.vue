<template>
  <div class="handisport">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>

      <v-toolbar flat dense color="primary">
        <v-toolbar-title>Handisport - Le tennis de table pour tous</v-toolbar-title>
      </v-toolbar>
      <v-layout row wrap>
        <v-flex d-flex xs12 md8>
          <v-card>
            <v-card-text>
              <p>Le Tennis de Table est un des 3 sports phares de la Fédération Française Handisport avec
                l’athlétisme et
                la natation.</p>
              <p>Le Tennis de Table est accessible aux personnes en situation de handicap (fauteuil,
                amputation,
                sourds…)</p>
              <p>10 classes permettent à toutes les personnes en situation de handicap de trouver une
                catégorie pour
                jouer.</p>
              <p>Les rencontres sportives permettent l’intégration, le respect et le dépassement entre valides
                et
                personnes en situation de Handicap</p>
              <p>Le Club de St Marceau Orléans Tennis de Table est ouvert à ces problématiques et accueille
                tous les
                publics.</p>
              <v-layout row>
                <v-flex xs6><img width="400" height="100%"
                                 title="Image: http://stmarceautt.fr/img/galerie/Pages/handisport_felix.jpg" src="/img/pages/handisport_felix.jpg">
                </v-flex>
                <v-flex xs3>
                  <img src="/img/pages/handisport_julien.jpg" alt="Handisport Julien"
                       title="Handisaport Julien"
                       border="0" width="200">
                </v-flex>
                <v-flex xs3>
                  <img src="/img/pages/handisport_julien_felix.jpg" alt="Handisport Julien et Félix"
                       title="Handisaport Julien et Félix" border="0" height="160"></v-flex>
              </v-layout>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex d-flex xs12 md4>
          <v-layout row wrap>
            <v-flex d-flex xs12 class="text-xs-center">
              <v-layout column justify-space-between fill-height>
                <v-card color="blue darken-3">
                  <v-card-text>
                    <h1 class="white--text">Séance dirigée</h1>
                    <h2 class="white--text">Lundi</h2>
                    <p class="white--text">
                      <v-icon class="mdi mdi-clock white--text">mdi-clock-outline</v-icon>
                      17h30 à 18h30
                    </p>
                    <v-divider color="white"></v-divider>
                    <h2 class="white--text">Nombre de personnes</h2>
                    <p class="white--text">
                      <v-icon class="mdi mdi-clock white--text">mdi-human-child</v-icon>
                      1 à 32 personnes
                    </p>
                    <v-divider color="white"></v-divider>
                    <h2 class="white--text">Tarif Annuel</h2>
                    <p class="white--text">120
                      <v-icon class="mdi mdi-clock white--text">mdi-currency-eur</v-icon>
                    </p>
                  </v-card-text>
                </v-card>
              </v-layout>
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
export default class Handisport extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
