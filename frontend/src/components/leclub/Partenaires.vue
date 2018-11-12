<template>
  <div class="nos-partenaires">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>

      <v-layout row column>
        <v-flex xs12 sm6>
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Faites confiance à nos partenaires</v-toolbar-title>
          </v-toolbar>
        </v-flex>
        <v-container fluid grid-list-md>
          <v-layout row wrap>
            <v-flex d-flex v-for="(item, i) in partenaires" :key="i"
                    v-bind="{ [`xs${item.taille}`]: true }">
              <vue-flip :active-hover="true" width="100%" height="250px" transition="0.7s">
                <div slot="front" style="width:100%; height:250px;">
                  <img v-bind:src="'/img/galerie/partenaires/' + item.image" class="img_fit"/>
                </div>
                <div slot="back">
                  <div v-html="item.contenu"/>
                  <v-btn color="success" :href="item.lien" target="_blank">Voir le site</v-btn>
                </div>
              </vue-flip>
            </v-flex>
          </v-layout>
        </v-container>
      </v-layout>

      <v-layout row column>
        <v-flex xs12 sm6>
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Les Associations</v-toolbar-title>
          </v-toolbar>
        </v-flex>
        <v-container fluid grid-list-md>
          <v-layout row wrap>
            <v-flex d-flex v-for="(item, i) in assos" :key="i" v-bind="{ [`xs${item.taille}`]: true }">
              <vue-flip :active-hover="true" width="100%" height="250px" transition="0.7s">
                <div slot="front" style="width:100%; height:250px;">
                  <img v-bind:src="'/img/galerie/partenaires/' + item.image" class="img_fit"/>
                </div>
                <div slot="back">
                  <div v-html="item.contenu"/>
                  <v-btn color="success" :href="item.lien" target="_blank">Voir le site</v-btn>
                </div>
              </vue-flip>
            </v-flex>
          </v-layout>
        </v-container>
      </v-layout>

      <v-layout row column>
        <v-flex xs12 sm6>
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>LES FÉDÉRATIONS</v-toolbar-title>
          </v-toolbar>
        </v-flex>
        <v-container fluid grid-list-md>
          <v-layout row wrap>
            <v-flex d-flex v-for="(item, i) in fede" :key="i" v-bind="{ [`xs${item.taille}`]: true }">
              <vue-flip :active-hover="true" width="100%" height="250px" transition="0.7s">
                <div slot="front" style="width:100%; height:250px;">
                  <img v-bind:src="'/img/galerie/partenaires/' + item.image" class="img_fit"/>
                </div>
                <div slot="back">
                  <div v-html="item.contenu"/>
                  <v-btn color="success" :href="item.lien" target="_blank">Voir le site</v-btn>
                </div>
              </vue-flip>
            </v-flex>
          </v-layout>
        </v-container>
      </v-layout>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Inject, Vue } from 'vue-property-decorator'
import PartenaireModel from '@/api/model/partenaire'
import PartenaireResource from '@/api/resources/partenaire'
import ApiService from '@/services/api'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import VueFlip from 'vue-flip'

@Component({ components: { Banner, VueFlip } })
export default class NosPartenaires extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @Inject()
  partenaireResource: PartenaireResource

  @Inject()
  api: ApiService

  partenaires: PartenaireModel[] = []
  assos: PartenaireModel[] = []
  fede: PartenaireModel[] = []

  async beforeMount () {
    // this.partenaires = await this.partenaireResource.partenaire(5)
    this.partenaires = await this.partenaireResource.category(5)
    this.assos = await this.partenaireResource.category(8)
    this.fede = await this.partenaireResource.category(6)
  }
}
</script>

<style lang="scss" scoped>
.img_fit {
  border-style: none;
  background-size: cover;
  width: 100%;
  height: 250px;
  margin: 0;
  padding: 0;
  -webkit-background-size: cover;
  background-size: cover;
}

/deep/ .flip-container .flipper {
  white-space: normal;
  font-size: 48px;
  line-height: 48px;
  font-weight: 400;
  transition: none;
  letter-spacing: 2px;
  text-shadow: black 0.1em 0.1em 0.2em;
}

/deep/ .flip-container .flipper .front {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  background-color: #fff;
  color: white;
}

/deep/ .flip-container .flipper .back {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  background-color: #FF3434;
  color: white;
  text-align: center;
}
</style>
