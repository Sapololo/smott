<template>
  <div class="soiree-entreprise">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-toolbar flat dense color="primary" class="mb-2">
        <v-toolbar-title>Le club organise pour votre entreprise des soirées originales</v-toolbar-title>
      </v-toolbar>

      <v-layout row pb-2 align-center>
        <v-flex xs12 md8 mr-2>
          <v-card color="brown lighten-5">
            <v-card-title><h1>Plongez dans le monde du sport entre pratique estivale et amateur</h1></v-card-title>
            <v-card-text>
              <p>Exemple de programme pour votre soirée entreprise originale :
                - Accueil sur le lieu de votre soirée entreprise originale
                - Apéritif
                - cocktail dinatoire
                - Animation ...
                - Remise des trophées aux gagnants</p>
              <p> VALEUR AJOUTÉE
                - Une soirée entreprise originale et fun
                - Des défis et une animation wii participatifs
                - Des challenges accessibles à tous</p>
              <p>L'OFFRE COMPREND
                - Le lieu de votre soirée entreprise originale
                - Les paris sportifs : défis fous, course hippique, animation wii, animateur,
                matériel,...
                - L'apéritif
                - Le diner assis ou le cocktail dinatoire
                - Les récompenses pour les gagnants</p>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 md4 text-xs-center align-center>
          <v-card color="blue darken-3">
            <v-card-text>
              <h2 class="white--text">Nombre de participants</h2>
              <p class="white--text">
                <v-icon class="mdi mdi-clock white--text">mdi-human-child</v-icon>
                10 à 120 personnes
              </p>
              <v-divider color="white"></v-divider>
              <h2 class="white--text">Période</h2>
              <p class="white--text">Toute l'année</p>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>


      <v-layout row justify-center>
        <v-flex xs12 sm3 class="text-xs-center mr-1">
          <v-card class="text-xs-center" height="100%">
            <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin green lighten-1 py-4"><h1>FORMULE 1</h1></span>
            </v-card-title>
            <v-card-text>
              <h1>500
                <v-icon large>mdi-currency-eur</v-icon>
              </h1>
            </v-card-text>
            <v-card-text class="no-padding">
              <v-divider color="white"></v-divider>
              <h2 class="blue-grey lighten-5 py-3">Mise à disposition de la salle<br/>avec un responsable Club</h2>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 sm3 class="text-xs-center mx-1">
          <v-card class="text-xs-center" height="100%">
            <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin teal lighten-1 py-4"><h1>FORMULE 2</h1></span>
            </v-card-title>
            <v-card-text>
              <h1>800
                <v-icon large>mdi-currency-eur</v-icon>
              </h1>
            </v-card-text>
            <v-card-text class="no-padding">
              <v-divider color="white"></v-divider>
              <h2 class="blue-grey lighten-5 py-3">FORMULE 1<br>
                <v-icon>mdi-plus</v-icon>
                <br>Organisation d'un tournoi Convivial (matériel, animateur du tournoi, recompenses)
              </h2>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 sm3 class="text-xs-center mx-1">
          <v-card class="text-xs-center" height="100%">
            <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin cyan lighten-1 py-4"><h1>FORMULE 3</h1></span>
            </v-card-title>
            <v-card-text>
              <h1>900
                <v-icon large>mdi-currency-eur</v-icon>
              </h1>
            </v-card-text>
            <v-card-text class="no-padding">
              <v-divider color="white"></v-divider>
              <h2 class="blue-grey lighten-5 py-3">FORMULE 2<br>
                <v-icon>mdi-plus</v-icon>
                <br>Cocktail Dînatoire<br/>+15€/personne
              </h2>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 sm3 class="text-xs-center ml-1">
          <v-card class="text-xs-center" height="100%">
            <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin deep-purple lighten-1 py-4"><h1>DARK PING</h1></span>
            </v-card-title>
            <v-card-text>
              <h1><v-icon>mdi-plus</v-icon> 500
                <v-icon large>mdi-currency-eur</v-icon>
              </h1>
            </v-card-text>
            <v-card-text class="no-padding">
              <v-divider color="white"></v-divider>
              <h2 class="blue-grey lighten-5 py-3">FORMULE 1, 2 ou 3<br>
                <v-icon>mdi-plus</v-icon>
                  <br>Dark Ping<br>(lumières et accesoires fluo)
              </h2>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '../../store/drawer'

@Component({ components: { Banner } })
export default class SoireeEntreprise extends Vue {
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
