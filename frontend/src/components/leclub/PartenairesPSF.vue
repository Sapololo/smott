<template>
  <div class="ping-sans-frontieres">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout row pb-2>
        <v-flex xs12>
          <v-card>
            <v-img v-bind:src="'/img/galerie/partenaires/PSF-logo-et-slogan-2015.png'"
                   height="200px" href="http://www.pingsansfrontieres.org/" contain/>
            <v-toolbar flat dense color="primary">
              <v-toolbar-title>class="white--text">La vocation de PING SANS FRONTIERES</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
              <p>Ping Sans Frontières agit en faveur du développement du tennis de table en tant
                que support éducatif dans les pays en voie de développement et sur le territoire
                national.</p>
              <p>Dans ce cadre, nous souhaitons créer une véritable chaîne de solidarité
                internationale en impliquant les pongistes, les clubs et les fédérations nationales dans
                nos
                projets.</p>
              <p>En outre, nous accompagnons et responsabilisons sur le long terme les
                associations locales dans leur développement et leur structuration.</p>
              <h3 class="headline blue--text darken-4">NOTRE ACTION SUR LE TERRAIN</h3>
              <p>Ping sans Frontières effectue au cours de ses missions les actions suivantes :
              </p>
              <ul>
                <li>L’éducation des publics prioritaires à l’aide de la pratique pongiste ;</li>
                <li>L’acheminement et la distribution encadrée de matériel pongiste, sportif et éducatif
                  ;
                </li>
                <li>La formation d’éducateurs et d’artisans à la construction de tables artisanales</li>
              </ul>
              <h3 class="headline blue--text darken-4">NOS PUBLICS PRIORITAIRES</h3>
              <p>Nos programmes visent en priorité les personnes n’ayant pas accès à la pratique
                du tennis de table du fait de leur situation personnelle ou de leur environnement.</p>
              <p>Nous orientons donc en priorité nos interventions en faveur des publics suivants
                :
              </p>
              <ul>
                <li>La jeunesse défavorisée ;&nbsp;</li>
                <li>Les personnes en situation d’handicap physique ;</li>
                <li>Les femmes en difficulté ;</li>
              </ul>
            </v-card-text>

          </v-card>
        </v-flex>
      </v-layout>
      <v-layout row>
        <v-flex xs6 pr-1>
          <iframe style="border:none; background:transparent; overflow:hidden; width:100%;" height="400"
                  src="https://www.youtube.com/embed/arcueXWt8Hk" allowfullscreen=""></iframe>
        </v-flex>
        <v-flex xs6 pl-1>
          <iframe style="border:none; background:transparent; overflow:hidden; width:100%;" height="400"
                  src="https://www.youtube.com/embed/jfimGlpUK_g" allowfullscreen=""></iframe>
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
export default class PingSansFrontieres extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
