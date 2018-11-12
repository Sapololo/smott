<template>
  <div class="compte_resultat">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout row wrap justify-space-between>
        <v-flex xs12 sm6 :class="$vuetify.breakpoint.smAndDown ? 'pb-2' : 'pa-2'" v-if="!loading">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Dépenses</v-toolbar-title>
            <v-spacer></v-spacer>
            <span class="white--text subheading">{{ totalDepenses.toFixed(2) }} €</span>
          </v-toolbar>
          <v-card>
            <v-card-text style="padding: 0;">
              <highcharts :options="optionsDepenses"></highcharts>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex xs12 sm6 :class="$vuetify.breakpoint.smAndDown ? 'pb-2' : 'pa-2'" v-if="!loading">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Recettes</v-toolbar-title>
            <v-spacer></v-spacer>
            <span class="white--text subheading">{{ totalRecettes.toFixed(2) }} €</span>
          </v-toolbar>
          <v-card>
            <v-card-text style="padding: 0;">
              <highcharts :options="optionsRecettes"></highcharts>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex xs12 :class="$vuetify.breakpoint.smAndDown ? 'pb-2' : 'pa-2'" v-if="!loading">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Résultat</v-toolbar-title>
            <v-spacer></v-spacer>
            <span class="white--text subheading">{{ total.toFixed(2) }} €</span>
          </v-toolbar>
        </v-flex>

        <v-flex xs12 sm6 :class="$vuetify.breakpoint.smAndDown ? 'pb-2' : 'pa-2'" v-if="!loading">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Dépenses</v-toolbar-title>
            <v-spacer></v-spacer>
            <span class="white--text subheading">{{ totalDepenses.toFixed(2) }} €</span>
          </v-toolbar>
          <v-expansion-panel focusable>
            <v-expansion-panel-content
                v-for="(item,i) in depenses"
                :key="i"
            >
              <div slot="header">{{ item.titre }}
                <v-spacer></v-spacer>
                {{ item.montant }} €
              </div>
              <v-card>
                <v-data-table
                    :headers="headers"
                    :items="item.data"
                    hide-actions
                    :loading="loading"
                    no-data-text="Chargement en cours"
                    class="elevation-1 white"
                >
                  <template slot="items" slot-scope="props">
                    <td class="justify-left">{{ props.item.titre }}
                    </td>
                    <td class="text-xs-right">
                      {{ props.item.montant.toFixed(2) }} €
                    </td>
                  </template>
                  <v-alert slot="no-results" value="true" color="error" icon="warning">
                    Votre recherche ne donne aucun résultat.
                  </v-alert>
                </v-data-table>
              </v-card>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-flex>

        <v-flex xs12 sm6 :class="$vuetify.breakpoint.smAndDown ? 'pb-2' : 'pa-2'" v-if="!loading">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Recettes</v-toolbar-title>
            <v-spacer></v-spacer>
            <span class="white--text subheading">{{ totalRecettes.toFixed(2) }} €</span>
          </v-toolbar>
          <v-expansion-panel focusable>
            <v-expansion-panel-content
                v-for="(item,i) in recettes"
                :key="i"
            >
              <div slot="header">{{ item.titre }}
                <v-spacer></v-spacer>
                {{ item.montant }} €
              </div>
              <v-card>
                <v-data-table
                    :headers="headers"
                    :items="item.data"
                    hide-actions
                    :loading="loading"
                    no-data-text="Chargement en cours"
                    class="elevation-1 white"
                >
                  <template slot="items" slot-scope="props">
                    <td class="justify-left">{{ props.item.titre }}
                    </td>
                    <td class="text-xs-right">
                      {{ props.item.montant.toFixed(2) }} €
                    </td>
                  </template>
                  <v-alert slot="no-results" value="true" color="error" icon="warning">
                    Votre recherche ne donne aucun résultat.
                  </v-alert>
                </v-data-table>
              </v-card>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-flex>
      </v-layout>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Inject, Vue } from 'vue-property-decorator'
import { GetterAuth, Payload, StateAuth } from '@/store/auth'
import CompteResultatModel from '@/api/model/compteResultat'
import EcritureResource from '@/api/resources/ecriture'
import ApiService from '@/services/api'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import forEach from 'lodash/forEach'

@Component({ components: { Banner } })
export default class CompteResultat extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @Inject()
  ecritureResource: EcritureResource

  @Inject()
  api: ApiService

  @GetterAuth
  authenticated: boolean

  @StateAuth
  payload: Payload | Payload

  @MutationSnackbar
  setSnackbarEntry: (entry: SnackbarEntry) => void

  recettes: CompteResultatModel[] = []
  depenses: CompteResultatModel[] = []

  //  Variables de la table
  loading: boolean = true
  optionsRecettes: any = {}
  dataRecettes: any[] = []
  totalRecettes: number = 0
  optionsDepenses: any = {}
  dataDepenses: any[] = []
  totalDepenses: number = 0
  total: number = 0
  headers: any[] = [
    { text: 'RUBRIQUE', align: 'left', value: 'titre', sortable: false },
    { text: 'MONTANT', align: 'right', value: 'montant', sortable: false }
  ]

  async mounted () {
    this.loading = true
    this.recettes = await this.ecritureResource.compteresultat(7)
    forEach(this.recettes, (item, key) => {
      if (item.niveau === 1) {
        // this.dataDepenses.push({ 'name': item.code, 'y': item.montant })
        this.dataRecettes.push({ name: item.titre, y: item.montant })
        if (item.montant !== null) {
          this.totalRecettes += item.montant
        }
      }
    })

    this.optionsRecettes = {
      recettes: {
        enabled: false
      },
      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
        options3d: {
          enabled: true,
          alpha: 45,
          beta: 0
        }
      },
      title: {
        text: null
      },
      tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
            enabled: true,
            format: '<b>{point.name}</b>: {point.y} €',
            style: {
              color: '#808080' || 'black'
            }
          }
        }
      },
      series: [{
        name: 'Recettes',
        data: this.dataRecettes
      }]
    }

    this.depenses = await this.ecritureResource.compteresultat(6)
    forEach(this.depenses, (item, key) => {
      if (item.niveau === 1) {
        // this.dataDepenses.push({ 'name': item.code, 'y': item.montant })
        this.dataDepenses.push({ name: item.titre, y: item.montant })
        if (item.montant !== null) {
          this.totalDepenses += item.montant
        }
      }
    })

    this.optionsDepenses = {
      recettes: {
        enabled: false
      },
      chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
        options3d: {
          enabled: true,
          alpha: 45,
          beta: 0
        }
      },
      title: {
        text: null
      },
      tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      plotOptions: {
        pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          dataLabels: {
            enabled: true,
            format: '<b>{point.name}</b>: {point.y} €',
            style: {
              color: '#808080' || 'black'
            }
          }
        }
      },
      series: [{
        name: 'Depenses',
        data: this.dataDepenses
      }]
    }
    this.total = this.totalRecettes - this.totalDepenses
    this.loading = false
  }
}
</script>
