<template>
  <div class="les-cotisations">
    <div class="main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout row justify-center>
        <v-flex xs12 md4 class="text-xs-center mr-1">
          <v-card class="text-xs-center" height="100%">
            <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin blue lighten-1 py-4"><h1>FORMULE DE BASE</h1></span>
            </v-card-title>
            <v-card-text>
              <h1>120
                <v-icon large>mdi-currency-eur</v-icon>
              </h1>
            </v-card-text>
            <v-card-text class="no-padding">
              <v-divider color="white"></v-divider>
              <h2 class="blue-grey lighten-5 py-3">Accéder à la salle aux horaires d'ouverture</h2>
              <v-divider color="white"></v-divider>
              <h2 class="blue-grey lighten-5 py-3">Ping pour tous</h2>
              <v-divider color="white"></v-divider>
              <h2 class="blue-grey lighten-5 py-3">Participer aux événements du Club</h2>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 md4 class="text-xs-center mx-1">
          <v-card height="100%">
            <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin cyan lighten-1 py-4"><h1>AVEC COMPETITIONS</h1></span>
            </v-card-title>
            <v-card-text>
              <h1>
                <v-icon large>mdi-plus</v-icon>
                30
                <v-icon large>mdi-currency-eur</v-icon>
              </h1>
            </v-card-text>
            <v-card-text class="no-padding">
              <v-divider color="white"></v-divider>
              <h2 class="blue-grey lighten-5 py-3">Compétitions par équipes</h2>
              <v-divider color="white"></v-divider>
              <h2 class="blue-grey lighten-5 py-3">Tournoi Jeunes du Loiret</h2>
              <v-divider color="white"></v-divider>
              <h2 class="blue-grey lighten-5 py-3">Open Butterfly ...</h2>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 md4 class="text-xs-center ml-1">
          <v-card height="100%">
            <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin teal lighten-1 py-4"><h1>CRITERIUM FEDERAL</h1></span>
            </v-card-title>
            <v-card-text>
              <h1>
                <v-icon large>mdi-plus</v-icon>
                40
                <v-icon large>mdi-currency-eur</v-icon>
              </h1>
            </v-card-text>
            <v-card-text class="no-padding">
              <v-divider color="white"></v-divider>
              <h2 class="blue-grey lighten-5 py-3">Inscription au Critérium Fédéral</h2>
              <v-divider color="white"></v-divider>
              <h2 class="blue-grey lighten-5 py-3">4 Journées + Finales</h2>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>

      <v-layout row my-2>
        <v-flex xs12 class="text-xs-center">
          <v-card height="100%">
            <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin amber lighten-1 py-4"><h1>Étudiants externes</h1></span>
            </v-card-title>
            <v-card-text>
              <h1>75
                <v-icon large>mdi-currency-eur</v-icon>
              </h1>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>

      <v-layout row>

        <v-flex xs12>
          <v-toolbar flat dense color="primary">
            <v-toolbar-title class="white--text">
              RENSEIGNEMENTS complémentaires
            </v-toolbar-title>
          </v-toolbar>
          <v-card>
            <v-container>
              <h4 style="font-size: 22px;">A partir de deux personnes licenciées de la même famille (père,
                mère, enfants
                à
                charge), les suivants de la famille auront droit à une réduction de 35 € sur
                l'adhésion.</h4>
              <h2 style="font-size: 32px;">Les avantages et les réductions financières</h2>
              <p style="font-size: 15px;"><span class="glyphicon glyphicon-ok"></span> Les chèques
                vacances (ANCV) sont
                acceptés.
              </p>
              <p style="font-size: 15px;"><span class="glyphicon glyphicon-ok"></span> Des avantages
                seront accordés aux
                adhérents qui amèneront des sponsors.</p>
            </v-container>
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
export default class LesCotisations extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: boolean = true

  metaInfo: any = {

    title: 'Les cotisations',
    meta: [{
      vmid: 'description',
      name: 'description',
      content: 'Retrouvez les cotisations de la saison 2018-2019 du Club de Saint Marceau Orléans Tennis de Table.'
    }]
  }

  mounted () {
    // document.title = 'Les cotisations - Saint Marceau Orléans Tennis de Table | stmarceautt.fr'
    // if (document.querySelector('meta') !== null) {
    //   document.querySelector('meta[itemprop="name"]').setAttribute('content', 'Les cotisations - Saint Marceau Orléans Tennis de Table | stmarceautt.fr')
    // }
    // document.querySelector('meta[itemprop="description"]').setAttribute('content', 'Retrouvez les cotisations de la saison 2018-2019 du Club de Saint Marceau Orléans Tennis de Table.')
  }
}
</script>

<style lang="scss" scoped>
h1 {
  -webkit-box-flex: 1;
  -ms-flex: 1 1 auto;
  flex: 1 1 auto;
}
</style>
