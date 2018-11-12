<template>
  <div class="revue-de-presse">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <v-layout column>
        <div fluid grid-list-md>
          <v-layout row wrap>
            <v-flex xs12 sm6 md4 pa-1
                    v-for="item in articles"
                    :key="item.id"
            >
              <v-card>
                <v-img :src="getImgUrl(item.image)" height="235px" />
                <v-card-title class="secondary">
                  <a :href="item.lien" class="white--text font-weight-bold mb-0"
                     target="_blank">{{ item.titre
                    }}</a>
                </v-card-title>
                <v-card-text>{{ item.contenu | truncate(80, '...') }}</v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn icon color="blue" dark
                         target="_blank"
                         @click="articleLink(item.id)">
                    <v-icon>mdi-eye</v-icon>
                  </v-btn>
                  <v-btn icon color="facebook" dark
                         :href="'https://www.facebook.com/sharer/sharer.php?u=' + item.lien"
                         target="_blank"
                         onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=400');">
                    <v-icon>mdi-facebook</v-icon>
                  </v-btn>
                  <v-btn icon color="twitter" dark
                         :href="'https://twitter.com/intent/tweet?url=' + item.lien + '&text=' + item.titre"
                         target="_blank"
                         onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=400');">
                    <v-icon>mdi-twitter</v-icon>
                  </v-btn>
                  <v-btn icon color="google-plus" dark
                         :href="'https://plus.google.com/share?url=' + item.lien"
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
        </div>
      </v-layout>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue, Inject } from 'vue-property-decorator'
import ArticleModel from '@/api/model/article'
import ArticleResource from '@/api/resources/article'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import ApiService from '@/services/api'

@Component
export default class RevueDePresse extends Vue {
  @Inject()
  articleResource: ArticleResource

  @Inject()
  api: ApiService

  articles: ArticleModel[] = []

  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  async beforeMount () {
    this.articles = await this.articleResource.articles()
  }

  getImgUrl (img: string) {
    return '/img/galerie/presse/773x408_' + img
  }

  articleLink (id: number) {
    this.$router.push({ name: 'Article', params: { id: '' + id } })
  }

  created () {
    this.setDrawer(true)
  }
}
</script>

<style lang="scss" scoped>
a {
  text-decoration: none;
}
</style>
