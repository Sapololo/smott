<template>
  <div class="dark-ping">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout row mb-2>
        <v-flex xs12>
          <v-card>
            <v-toolbar flat dense color="primary" class="white--text mb-2">
              <v-toolbar-title>Le Dark Ping arrive dans votre club!</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
              <h3 class="headline">Samedi 7 janvier 2017 à 20h, salle Harismendy à Orléans, une soirée
                animations
                et FLUO.</h3>
              <p>Nous profitons d'une trêve dans le championnat pour organiser pour la première
                fois dans le département, une soirée festive autour du "Ping".</p>
              <p>Rythmée par une ambiance musicale, notre salle spécifique de ping sera
                entièrement plongée dans le noir et en grande majorité éclairée par de la lumière UV (ou
                lumière
                noire).Les tables et les raquettes seront, comme l'ambiance, véritablement FLUO !!! Le
                bar sera
                également ouvert (petite restauration prévue).</p>
              <p>Entrée à 5€,
                <small>inclus 1 ticket de boissons</small>
                .
              </p>
              <p>Vous pouvez venir déguisé, avec des accessoires fluo, mais surtout en blanc pour
                l'ambiance.Les inscriptions au tournoi (gratuites et dans la limite des places
                disponibles) se font sur
                place entre 20h et 20h30 uniquement. En plus d’un tournoi amical, pour lequel des
                raquettes et les
                balles
                seront à disposition, Vous pourrez jouer et/ou découvrir le « Bière Pong ». Si, si, il
                existe une <a
                    href="http://beerpongfrance.com/fr/" target="_blank"
                    title="Link: http://beerpongfrance.com/fr/">fédération
                  Française</a>, vous pouvez aller sur leur site. Une table sera à disposition dans le
                couloir, pour
                jouer
                sérieusement au bière pong.</p>
              <p>Ouvert à tous.</p>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>

      <v-layout row wrap mb-2 v-for="(album, i) in items" :key="i">
        <v-toolbar flat dense color="primary" class="white--text mb-2">
          <v-toolbar-title>{{ album.title }}</v-toolbar-title>
        </v-toolbar>
        <v-flex
            v-for="item in album.children"
            v-bind="{ [`xs${item.flex}`]: true }"
            v-bind:key="item.title" mb-1 pr-1
        >
          <v-card>
            <v-img v-bind:src="item.src" height="300px" contain>
              <img v-bind:src="item.src"
                   style="background-size: cover;"/></v-img>
          </v-card>
        </v-flex>
      </v-layout>

      <v-layout row wrap>
        <v-toolbar flat dense color="primary" class="white--text mb-2">
          <v-toolbar-title>Le beer pong</v-toolbar-title>
        </v-toolbar>
        <v-flex xs12>
          <v-card>
            <v-img height="300px" contain>
              <img src="/img/galerie/2016/dark-ping/beer_pong_in_the_dark.jpg"
                   style="background-size: cover;"/></v-img>
          </v-card>
        </v-flex>
      </v-layout>

    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

export interface AlbumItem {
  title: string
  children: any[]
}

@Component({ components: { Banner } })
export default class DarkPing extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  items: AlbumItem[] = [{
    title: 'La Salle',
    children: [
      { src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_01.jpg', flex: 4 },
      { src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_02.jpg', flex: 4 },
      { src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_03.jpg', flex: 2 },
      { src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_04.jpg', flex: 2 }]
  }, {
    title: 'Les Participants',
    children: [
      {
        src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_10.jpg',
        flex: 2
      },
      {
        src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_11.jpg',
        flex: 2
      },
      {
        src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_12.jpg',
        flex: 2
      },
      {
        src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_13.jpg',
        flex: 2
      },
      {
        src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_14.jpg',
        flex: 2
      },
      {
        src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_15.jpg',
        flex: 2
      },
      {
        src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_16.jpg',
        flex: 2
      },
      {
        src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_17.jpg',
        flex: 2
      }]
  }, {
    title: 'La Foule',
    children: [
      {
        src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_20.jpg',
        flex: 4
      },
      {
        src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_21.jpg',
        flex: 4
      },
      {
        src: '/img/galerie/2016/dark-ping/small/small_Dark_ping_22.jpg',
        flex: 4
      }]
  }]
}
</script>
