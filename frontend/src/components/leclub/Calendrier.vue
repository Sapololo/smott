<template>
  <div class="events">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <slot v-if="events.length === 0" transition="fade" name="loading-content">
        <v-flex xs12 class="secondary pa-3"><h1 class="text-xs-center white--text text-uppercase">
          Chargement des prochaines dates</h1>
          <v-progress-linear :indeterminate="true" color="error"
                             height="10"
                             value="75"></v-progress-linear>
        </v-flex>
      </slot>
      <slot v-else transition="fade">
        <v-layout column>
          <div grid-list-md fluid fill-height>
            <v-layout wrap>
              <v-flex xs12 sm6 md4 pa-1
                      v-for="item in events"
                      :key="item.id"
              >
                <v-card height="100%">
                  <v-img :src="item.image+'_378x270.jpg'" height="235px" />
                  <v-card-title class="secondary">
                    <a @click="eventLink(item.id)" class="white--text font-weight-bold mb-0">{{
                      item.titre
                      }}</a>
                  </v-card-title>
                  <v-card-text>
                    <p>
                      <v-icon>mdi-calendar-clock</v-icon>&nbsp;{{ item.dtdebut.date | moment('DD/MM/YYYY')
                      }} à {{ item.dtdebut.date | moment('H:mm') }}<br/>
                      {{ item.contenu | truncate(80, '...') }}
                    </p>
                    <p v-if="item.carte.length != 0 && item.carte.id > 2">
                      <v-tooltip bottom>
                        <span slot="activator"><v-icon color="blue"
                                                       dark>mdi-map-marker</v-icon> {{ item.carte.nom}}</span>
                        <span>{{ item.carte.adressesalle1 }}, {{ item.carte.codepsalle }} {{ item.carte.villesalle }}</span>
                      </v-tooltip>
                    <p v-if="item.carte.length != 0 && item.carte.id < 3">
                      <v-icon color="red">mdi-map-marker</v-icon>
                      {{ item.carte.nom}}
                    </p>
                  </v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn icon color="blue" dark
                           target="_blank"
                           @click="eventLink(item.id)">
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
      </slot>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue, Inject } from 'vue-property-decorator'
import EventModel from '@/api/model/event'
import EventResource from '@/api/resources/event'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import ApiService from '@/services/api'

@Component
export default class Evenements extends Vue {
  @Inject()
  eventResource: EventResource

  @Inject()
  api: ApiService

  events: EventModel[] = []

  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  async beforeMount () {
    this.events = await this.eventResource.events()
  }

  eventLink (id: number) {
    this.$router.push({ name: 'Evenement', params: { id: '' + id } })
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
