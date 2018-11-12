<template>
  <div class="baby-ping">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-toolbar flat dense color="primary">
        <v-toolbar-title>Dès 4 ans, on peut pratiquer !</v-toolbar-title>
      </v-toolbar>
      <v-layout row wrap>
        <v-flex d-flex xs12 md8>
          <v-card>
            <v-img src="/img/galerie/2013/Baby_Ping/Baby_Ping_04.jpg" height="235px"/>
            <v-card-text>
              <p>Le groupe babies concerne les enfants à partir de 4 ans. Une initiation sous forme de
                jeux leur est
                prodiguée afin de développer et d’améliorer les différentes qualités indispensables
                : habileté,
                coordination, équilibre…</p>
              <p>D'après une étude réalisée en Chine, le tennis de table est l'un des meilleurs sport
                d'éveil pour les
                enfants !</p>
              <p>L'activité est très ludique et ne présent aucun risque pour votre enfant.</p>
              <p>Sébastien réalisera l'encadrement de cette activité.&nbsp;</p>
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
                    <h2 class="white--text">Mercredi</h2>
                    <p class="white--text">
                      <v-icon class="mdi mdi-clock white--text">mdi-clock-outline</v-icon>
                      17h à 18h
                    </p>
                    <v-divider color="white"></v-divider>
                    <h2 class="white--text">Nombre d'enfants</h2>
                    <p class="white--text">
                      <v-icon class="mdi mdi-clock white--text">mdi-human-child</v-icon>
                      5 à 10 enfants
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
export default class BabyPing extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
