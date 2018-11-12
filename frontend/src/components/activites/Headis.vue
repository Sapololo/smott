<template>
  <div class="headis">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout row mb-2>
        <v-card width="100%">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>HEADIS FAIT PARTI DES ACTIVITÉS DE TENNIS DE TABLE. AUSSI APPELÉ AU ETAT-UNIS : SOCCER-PING !</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <img v-bind:src="require('@/assets/img/headis-logo.jpg')" border="0" width="250" height="169"
                 style="float: left; margin-right: 25px;"/>
            <h1>OÙ COMMENT JOUER AU TENNIS DE TABLE AVEC SA TÊTE.</h1>
            <p>Les règles sont similaires à celle du ping-pong avec quelques exceptions. La balle fait 17.78
              cm et pèse environ 100 grammes. Elle est faite en caoutchouc ce qui lui donne des
              caractéristiques
              rebondissante particulière, le contact avec la table est autorisé ce qui permet de reprendre
              la balle de
              volée. Ce sport a été inventé en 2006 par Rene Wegner, un étudiant Allemand de l'université
              de la
              Sarre.</p>
          </v-card-text>
        </v-card>
      </v-layout>
      <v-layout row mb-2>
        <v-card width="100%">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>les videos !</v-toolbar-title>
          </v-toolbar>
          <v-card-text>

          </v-card-text>
        </v-card>
      </v-layout>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class Headis extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
