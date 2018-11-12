<template>
  <div class="arbitres-et-juge-arbitres">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout column>
        <v-container fluid grid-list-md>
          <v-layout row wrap v-if="loading">
            <v-flex md4 sm6 v-for="(item, i) in listeJoueurs" :key="i" v-if="item.arb">
              <v-card color="primary">
                <v-card-text>
                  <h1 class="headline white--text" v-html="item.nom +' '+ item.prenom"/>
                  <p class="back--text" v-html="item.arb" v-if="item.arb"/>
                  <p class="back--text" v-html="item.ja" v-if="item.ja"/>
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
import { Component, Inject, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import ApiService from '@/services/api'
import FfttResource from '@/api/resources/fftt'
import ClubDetailModel from '@/api/model/clubDetail'
import JoueurDetailModel from '@/api/model/joueurDetail'
import forEach from 'lodash/forEach'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class ArbitresEtJugeArbitres extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @Inject()
  ffttResource: FfttResource

  @Inject()
  api: ApiService

  loading: boolean = true
  clubId: string = ''
  clubDetail: ClubDetailModel | null = null
  listeJoueurs: JoueurDetailModel[] | null = null

  async mounted () {
    this.clubId = '04450026'
    this.clubDetail = await this.ffttResource.clubdetail(this.clubId)
    this.listeJoueurs = await this.ffttResource.joueursDetailsByClub(this.clubId)
    forEach(this.listeJoueurs, (joueur, key) => {
      if (joueur.arb === '' && joueur.ja === '' && this.listeJoueurs !== null) {
        this.listeJoueurs.splice(key, 1)
      }
    })
    this.loading = false
  }
}
</script>
