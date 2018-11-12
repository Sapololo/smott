<template>
  <div class="videos">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <v-layout row v-if="!videos">
        <v-flex xs12 class="secondary pa-3"><h1 class="text-xs-center white--text text-uppercase">
          Chargement des vidéos</h1>
          <v-progress-linear :indeterminate="true" color="error"
                             height="10"
                             value="75"></v-progress-linear>
        </v-flex>
      </v-layout>
      <v-layout column>
        <v-container fluid grid-list-md>
          <v-layout row wrap>
            <v-flex xs4
                    v-for="item in videos"
                    :key="item.id"
            >
              <v-card>
                <v-img>
                  <iframe style="border:none; background:transparent; overflow:hidden; width:100%;"
                          height="300" v-bind:src="item.lien" allowfullscreen/>
                </v-img>
                <v-card-title class="secondary">
                  <a :href="item.lien" class="white--text font-weight-bold mb-0"
                     target="_blank">{{ item.titre
                    }}</a>
                </v-card-title>
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
import VideoModel from '@/api/model/video'
import VideoResource from '@/api/resources/video'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import ApiService from '@/services/api'

@Component
export default class Videos extends Vue {
  @Inject()
  videoResource: VideoResource

  @Inject()
  api: ApiService

  videos: VideoModel[] = []

  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  async beforeMount () {
    this.videos = await this.videoResource.videos()
  }
}
</script>

<style lang="scss" scoped>
a {
  text-decoration: none;
}
</style>
