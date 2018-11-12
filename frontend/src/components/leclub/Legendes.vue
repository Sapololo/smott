<template>
  <div class="legendes">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout row wrap pb-2>
        <v-toolbar flat dense color="primary" class="white--text" pb-2>
          <v-toolbar-title>Nos anciens président</v-toolbar-title>
        </v-toolbar>
        <v-flex xs2>
          <v-card>
            <v-img height="250px" contain>
              <img v-bind:src="'/img/galerie/legendes/maurice_jaloux.jpg'"
                   style="background-size: cover;"/>
              <v-container fill-height fluid>
                <v-layout fill-height>
                  <v-flex xs12 align-end flexbox>
                    <span class="headline white--text">Maurice JALOUX</span>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-img>
          </v-card>
        </v-flex>
      </v-layout>

      <v-layout row wrap>
        <v-toolbar flat dense color="primary" class="white--text" pb-2>
          <v-toolbar-title>Nos anciens membres</v-toolbar-title>
        </v-toolbar>
        <v-flex xs2>
          <v-card>
            <v-img height="250px" contain>
              <img v-bind:src="'/img/galerie/presse/20160922_accueil.jpg'"
                   style="background-size: cover;"/>
              <v-container fill-height fluid>
                <v-layout fill-height>
                  <v-flex xs12 align-end flexbox>
                    <span class="headline white--text">Jean MALARD</span>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-img>
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

@Component({ components: { Banner } })
export default class Legendes extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
