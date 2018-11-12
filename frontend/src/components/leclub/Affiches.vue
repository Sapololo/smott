<template>
  <div class="affiches">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout column>
        <div fluid grid-list-md>
          <v-layout row wrap>
            <v-flex xs12 sm6 md4 pa-1
                v-for="item in items"
                :key="item.title"
            >
              <v-card>
                <v-img v-bind:src="item.src" height="540px"/>
              </v-card>
            </v-flex>
          </v-layout>
        </div>
      </v-layout>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class Affiches extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  items: any[] = [
    {
      href: '',
      src: '/img/galerie/affiches/2018_Ping_tour_400.jpg',
      title: 'Ping Tour 2018',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2018_Affiche_Challenge-inter-ecoles_400.jpg',
      title: 'Challenge inter-écoles 2018',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2017_Changeons-de-regard_400.jpg',
      title: 'Changeons de regard 2017',
      flex: 4
    },
    { href: '', src: '/img/galerie/affiches/2017_Urban_ping.jpg', title: 'Urban Ping 2017', flex: 4 },
    {
      href: '',
      src: '/img/galerie/affiches/2017_AG_400.jpg',
      title: 'Assemblée Générale 2017',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2017_Affiche_Challenge-inter-ecoles_400.jpg',
      title: 'Challenge inter-écoles 2017',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2017-Dark-ping_400.jpg',
      title: 'Dark Ping 2017',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2016_changeons-de-regard.jpg',
      title: 'Changeons de regard 2016',
      flex: 4
    },
    { href: '', src: '/img/galerie/affiches/2016_Urban_ping.jpg', title: 'Urban Ping 2016', flex: 4 },
    {
      href: '',
      src: '/img/galerie/affiches/2016_AG_400.jpg',
      title: 'Assemblée Générale 2016',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2016_Affiche_Challenge-inter-ecoles_400.jpg',
      title: 'Challenge inter-écoles 2016',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2016-Dark-Ping_400.jpg',
      title: 'Dark Ping 2016',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2015_Affiche_Telethon_400.jpg',
      title: 'Téléthon - Tournoi pour tous',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2015-Changeons-de-regard_400.jpg',
      title: 'Changeons de regard 2015',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2015_Affiche_Quartier_400.jpg',
      title: 'Orléans Dynamique 2015',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2015_Urban_Ping_400.jpg',
      title: 'Urban Ping 2015',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2015-AG_400.jpg',
      title: 'Assemblée Générale 2015',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2015_Affiche_Challenge-inter-ecoles_400.jpg',
      title: 'Challenge Inter Ecoles 2015',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2014_Affiche_Téléthon_400.jpg',
      title: 'Téléthon',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2014_Affiche_Quartier_400.jpg',
      title: 'Orléans Dynamique 2014',
      flex: 4
    }
  ]
}
</script>
