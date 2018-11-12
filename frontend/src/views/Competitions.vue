<template>
  <div class="competitions">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-container fluid grid-list-md>
        <v-layout row wrap>
          <v-flex d-flex xs12 sm6 lg3 px2 v-for="(item, i) in itemVignettes" :key="i">
            <vue-flip :active-hover="true" width="100%" height="250px" transition="0.7s">
              <div slot="front">
                <v-icon style="font-size: 110px">{{ item.icon }}</v-icon>
                <div v-html="item.title"/>
              </div>
              <div slot="back">
                <div v-html="item.text"/>
                <v-btn color="success" @click="link(item.name, item.params)">En savoir plus</v-btn>
              </div>
            </vue-flip>
          </v-flex>
        </v-layout>
      </v-container>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../components/Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import VueFlip from 'vue-flip'

@Component({ components: { Banner, VueFlip } })
export default class Competitions extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  link (link: string, parametres?: any) {
    this.$router.push({ name: link, params: parametres })
  }

  created () {
    this.setDrawer(true)
  }

  itemVignettes: any = [
    {
      icon: 'mdi-account-search blue--text',
      title: 'Recherche',
      name: 'Recherche',
      text: 'Vous recherchez un joueur, un club ... nous le trouvons pour vous!'
    },
    {
      icon: 'mdi-chart-bar',
      title: 'Les licenciés du club',
      name: 'LesLicencesDuClub',
      params: { clubId: '04450026' },
      text: 'Liste des licenciés du club, et encore plus si vous êtes adhérents!'
    },
    {
      icon: 'mdi-account-multiple',
      title: 'Les équipes',
      name: 'Equipe',
      params: { clubId: '04450026', num: 1 },
      text: 'Tous les résultats du club'
    },
    {
      icon: 'mdi-fire amber--text',
      title: 'Brûlages',
      name: 'Brulages',
      text: 'Liste de joueurs brûlés dans tous les clubs'
    },
    {
      icon: 'mdi-whistle bue--text',
      title: 'Arbitres et Juge-arbitres',
      name: 'ArbitresEtJugeArbitres'
    },
    {
      icon: 'mdi-image-filter-frames',
      title: 'Cadres',
      name: 'Cadres'
    },
    {
      icon: 'mdi-newspaper',
      title: 'Actualités FFTT',
      name: 'Actualites'
    },
    {
      icon: 'mdi-human-handsup',
      title: 'Individuel',
      name: 'Individuel'
    },
    {
      icon: 'mdi-thumb-up blue--text',
      title: 'PRENATIONALE',
      name: 'Equipe',
      params: { num: 1 }
    },
    {
      icon: 'mdi-thumb-up blue--text',
      title: 'REGIONALE 1',
      name: 'Equipe',
      params: { num: 2 }
    },
    {
      icon: 'mdi-thumb-up blue--text',
      title: 'REGIONALE 3',
      name: 'Equipe',
      params: { num: 3 }
    },
    {
      icon: 'mdi-thumb-up blue--text',
      title: 'REGIONALE 3',
      name: 'Equipe',
      params: { num: 4 }
    },
    {
      icon: 'mdi-thumb-up blue--text',
      title: 'DEPART. 3 Eq5',
      name: 'Equipe',
      params: { num: 5 }
    },
    {
      icon: 'mdi-thumb-up blue--text',
      title: 'DEPART. 3 Eq6',
      name: 'Equipe',
      params: { num: 6 }
    },
    {
      icon: 'mdi-thumb-up blue--text',
      title: 'DEPART. 5',
      name: 'Equipe',
      params: { num: 7 }
    },
    {
      icon: 'mdi-thumb-up blue--text',
      title: 'DEPART. 6',
      name: 'Equipe',
      params: { num: 8 }
    },
    {
      icon: 'mdi-thumb-up blue--text',
      title: 'D1 VETERANS',
      name: 'Equipe',
      params: { num: 10 }
    },
    {
      icon: 'mdi-thumb-up blue--text',
      title: 'D1 VETERANS',
      name: 'Equipe',
      params: { num: 11 }
    },
    {
      icon: 'mdi-thumb-up blue--text',
      title: 'D3 VETERANS',
      name: 'Equipe',
      params: { num: 12 }
    },
    {
      icon: 'mdi-thumb-up green--text',
      title: 'Equipe 1',
      name: 'Equipe',
      params: { num: 13 },
      roles: ['ROLE_USER']
    },
    {
      icon: 'mdi-thumb-up green--text',
      title: 'Equipe 2',
      name: 'Equipe',
      params: { num: 14 },
      roles: ['ROLE_USER']
    },
    {
      icon: 'mdi-thumb-up green--text',
      title: 'Equipe 3',
      name: 'Equipe',
      params: { num: 15 },
      roles: ['ROLE_USER']
    }]
}
</script>
