<template>
  <div class="cadres-sportifs">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout column>
        <v-container fluid grid-list-md>
          <v-layout row wrap>
            <v-flex md4 sm6 v-for="(item, i) in items" :key="i">
              <v-card color="primary">
                <v-img :src="'/img/bureau/'+item.image" height="300px">
                </v-img>
                <v-card-text>
                  <h1 class="headline white--text" v-html="item.nom"/>
                  <h3 class="title purple--text" v-html="item.role"/>
                  <p class="back--text" v-html="item.titre"/>
                </v-card-text>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-layout>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class CadresSportifs extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  items = [
    {
      image: 'Seb.jpg',
      nom: 'Sébastien GUILBERT',
      role: 'Entraîneur principal (BEES 1)',
      titre: 'Salarié à temps plein, diplomé du Brevet d’Etat depuis de 2006.<br />Intervient lors du temps périscolaire au niveau des 4 écoles du quartier Saint Marceau.<br />Encadre toutes séances dirigées du club.<br />Il met en place les animations, ainsi qu’organise les manifestations.'
    },
    {
      image: 'Loic_Bureau.jpg',
      nom: 'Loïc VACQUET',
      role: 'Entraîneur Fédéral (EF)',
      titre: 'Diplômé d’entraîneur fédéral'
    },
    {
      image: 'christophe.jpg',
      nom: 'Christophe BOUSSIER',
      role: 'Entraîneur Fédéral (EF)',
      titre: 'Diplômé d’entraîneur fédéral'
    },
    {
      image: 'Mary_Bureau.jpg',
      nom: 'Marylène LABLEE',
      role: 'Entraîneur Fédéral (EF)',
      titre: 'Diplômé d’entraîneur fédéral'
    }]
}
</script>
