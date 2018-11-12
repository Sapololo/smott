<template>
  <div class="actualites">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout row v-if="!actualites">
        <v-flex xs12 class="secondary pa-3"><h1 class="text-xs-center white--text text-uppercase">
          Chargement des actualité FFTT</h1>
          <v-progress-linear :indeterminate="true" color="error"
                             height="10"
                             value="75"></v-progress-linear>
        </v-flex>
      </v-layout>
      <v-layout column v-else>
        <v-container fluid grid-list-md>
          <v-layout row wrap>
            <v-flex xs12 sm6 md4
                    v-for="item in actualites"
                    :key="item.id"
            >
              <v-card>
                <v-img :src="item.photo" height="235px">
                  ...
                </v-img>
                <v-card-title class="secondary">
                  <a :href="item.url" class="white--text font-weight-bold mb-0"
                     target="_blank">{{ item.titre
                    }}</a>
                </v-card-title>
                <v-card-text>{{ item.description }}</v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn icon color="facebook" dark
                         :href="'https://www.facebook.com/sharer/sharer.php?u=' + item.url"
                         target="_blank"
                         onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=400');">
                    <v-icon>mdi-facebook</v-icon>
                  </v-btn>
                  <v-btn icon color="twitter" dark
                         :href="'https://twitter.com/intent/tweet?url=' + item.url + '&text=' + item.titre"
                         target="_blank"
                         onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=400');">
                    <v-icon>mdi-twitter</v-icon>
                  </v-btn>
                  <v-btn icon color="google-plus" dark
                         :href="'https://plus.google.com/share?url=' + item.url"
                         target="_blank"
                         onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=400');">
                    <v-icon>mdi-google-plus</v-icon>
                  </v-btn>
                  <v-btn icon color="secondary" dark>
                    <v-icon>mdi-email</v-icon>
                  </v-btn>
                  <v-btn icon color="primary" dark>
                    <v-icon>share</v-icon>
                  </v-btn>
                </v-card-actions>
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
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import ApiService from '@/services/api'
import ActualiteModel from '@/api/model/actualite'
import FfttResource from '@/api/resources/fftt'

@Component({ components: { Banner } })
export default class Actualites extends Vue {
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

  actualites: ActualiteModel[] | null = null

  async beforeMount () {
    this.actualites = await this.ffttResource.actualite()
  }
}
</script>

<style lang="scss" scoped>
a {
  text-decoration: none;
}
</style>
