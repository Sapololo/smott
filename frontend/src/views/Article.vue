<template>
  <div class="article">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <v-container fluid>
        <v-layout row wrap>
          <v-flex xs12 sm8>
            <v-card v-if="article">
              <v-img><img v-bind:src="'/img/galerie/presse/' + article.image" width="100%"/>
              </v-img>
              <v-toolbar color="primary">
                <v-toolbar-title><span
                    class="white--text headline" v-html="article.titre"/>
                </v-toolbar-title>
              </v-toolbar>
              <v-card-text v-html="article.contenu"/>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn icon color="facebook" dark
                       :href="'https://www.facebook.com/sharer/sharer.php?u=' + article.lien"
                       target="_blank"
                       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=400');">
                  <v-icon>mdi-facebook</v-icon>
                </v-btn>
                <v-btn icon color="twitter" dark
                       :href="'https://twitter.com/intent/tweet?url=' + article.lien + '&text=' + article.titre"
                       target="_blank"
                       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=400');">
                  <v-icon>mdi-twitter</v-icon>
                </v-btn>
                <v-btn icon color="google-plus" dark
                       :href="'https://plus.google.com/share?url=' + article.lien"
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
            <v-container fluid grid-list-xl>
              <v-layout row justify-space-between>
                <v-flex xs2>
                  <v-btn color="primary" dark @click="articleLink(item.id - 1)">
                    <v-icon>mdi-chevron-left</v-icon>
                    Article précédent
                  </v-btn>
                </v-flex>
                <v-flex xs2>
                  <v-btn color="primary" dark @click="articleLink(item.id + 1)">
                    Article suivant
                    <v-icon>mdi-chevron-right</v-icon>
                  </v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-flex>
          <v-flex sm4>
            <v-list>
              <v-list-tile
                  v-for="(item, i) in articles"
                  :key="item.id"
                  @click="articleLink(item.id)"
                  v-if="i < 10"
              >
                <v-list-tile-content>
                  <v-list-tile-title>{{ item.titre }}</v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list>
          </v-flex>
        </v-layout>
      </v-container>
    </div>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Inject } from 'vue-property-decorator'
import ArticleModel, { ArticleDetailModel } from '../api/model/article'
import ArticleResource from '../api/resources/article'
import ApiService from '../services/api'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component
export default class Article extends Vue {
  @Inject()
  articleResource: ArticleResource

  @Inject()
  api: ApiService

  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  article: ArticleDetailModel | null = null
  articles: ArticleModel[] = []

  async mounted () {
    this.article = await this.articleResource.article('' + this.$route.params.id)
    document.title = this.article.titre + ' - Saint Marceau Orléans Tennis de Table - stmarceautt.fr'
    this.articles = await this.articleResource.articles()
  }

  async articleLink (id: string) {
    this.article = await this.articleResource.article(id)
    if (this.article) {
      document.title = this.article.titre + ' - Saint Marceau Orléans Tennis de Table - stmarceautt.fr'
    }
  }

  created () {
    this.setDrawer(true)
  }
}
</script>
