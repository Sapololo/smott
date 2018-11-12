<template>
  <div class="joueur_detail">
    <v-layout wrap v-if="joueurDetail" class="pb-2">
      <v-flex xs12 md4
              :class="{'pb-2' : $vuetify.breakpoint.smAndDown, 'pa-2' : $vuetify.breakpoint.mdAndUp}">
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>{{ joueurDetail.nom}} {{ joueurDetail.prenom}}</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-tooltip bottom v-if="classement">
            <span slot="activator" class="white--text">{{ classement.classement}}</span>
            <span>Pts Officiels : {{ classement.pointsOfficiels }}</span>
          </v-tooltip>
        </v-toolbar>
        <v-card>
          <v-card-text>
            <div fluid grid-list-xl>
              <v-layout row wrap justify-space-between>
                <v-flex xs12 class="text-xs-center" height="100%">
                  <v-list-tile>
                    <v-list-tile-content><span class="primary--text">Nationalité</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="joueurDetail">{{ joueurDetail.natio }}</span>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-content><span class="primary--text">Catégorie d'âge</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="joueurDetail">{{ joueurDetail.categorie }}</span>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-content><span class="primary--text">Point officiel</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="joueurDetail">{{ joueurDetail.pointsLicence }}</span>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-content><span class="primary--text">Licence n°</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="joueurDetail">{{ joueurDetail.licence }}</span>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-content><span class="primary--text">Date validation</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="joueurDetail && joueurDetail.validation">{{ joueurDetail.validation.substring(0,10) }}</span>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-content><span class="primary--text">Certif. médical</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="joueurDetail">{{ joueurDetail.certif }}</span>
                    </v-list-tile-content>
                  </v-list-tile>
                  <p>
                    <router-link
                        :to="{ name: 'Statistiques', params: { clubId: joueurDetail.numClub }}"><span
                        class="title">{{ joueurDetail.nomClub}} -
                      (N°{{
                      joueurDetail.numClub}})</span>
                    </router-link>
                  </p>
                  <p v-if="joueurDetail.arb || joueurDetail.ja || joueurDetail.tech"><span
                      class="title font-weight-black">{{ joueurDetail.arb}}</span><span
                      class="title font-weight-black" v-if="joueurDetail.ja"> - {{ joueurDetail.ja}}</span><span
                      class="title font-weight-black" v-if="joueurDetail.tech"> - {{
                      joueurDetail.tech}}</span></p>
                </v-flex>
              </v-layout>
            </div>
          </v-card-text>
        </v-card>
      </v-flex>

      <v-flex xs12 md8
              :class="{'pb-2' : $vuetify.breakpoint.smAndDown, 'pa-2' : $vuetify.breakpoint.mdAndUp}">
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>Statistiques</v-toolbar-title>
        </v-toolbar>
        <v-card>
          <v-card-text>
            <div fluid grid-list-xl>
              <v-layout row wrap justify-space-between>
                <v-flex xs12 sm6>
                  <v-list-tile>
                    <v-list-tile-content><span class="primary--text">Rang Départemental</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="classement">{{ classement.rangDepartemental}}</span>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-content><span class="primary--text">Rang Régional</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="classement">{{ classement.rangRegional}}</span>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-content><span class="primary--text">Rang National</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="classement">{{ classement.rangNational}}</span>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-content><span class="primary--text">Début saison</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="classement">{{ classement.pointsInitials}} pts</span>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-content><span class="primary--text">Progression Annuelle</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="classement">{{ classement.pointsOfficiels - classement.pointsInitials}} pts</span>
                    </v-list-tile-content>
                  </v-list-tile>
                </v-flex>
                <v-flex xs12 sm6>
                  <v-list-tile>
                    <v-list-tile-content><span class="primary--text">Points off. en cours</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="classement">{{ joueurDetail.pointsLicence }} pts</span>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-content><span class="primary--text">Points mensuels</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="classement">{{ joueurDetail.pointsMensuel }} pts</span>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-content><span
                        class="primary--text">Progression mensuelle</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="classement">{{ Math.round(joueurDetail.pointsMensuel - joueurDetail.pointsMensuelAnciens) }} pts</span>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-content><span class="primary--text">Points Virtuels</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="classement">{{ Math.round(joueurDetail.pointsMensuel + pointvirt) }} pts</span>
                    </v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-content><span
                        class="primary--text">Progression Virtuelle</span>
                    </v-list-tile-content>
                    <v-list-tile-content class="align-end"><span class="title font-weight-black"
                                                                 v-if="pointvirt">{{ pointvirt }} pts</span>
                      <v-progress-circular
                          indeterminate
                          color="red" v-else
                      ></v-progress-circular>
                    </v-list-tile-content>
                  </v-list-tile>
                </v-flex>
              </v-layout>
            </div>
          </v-card-text>
        </v-card>
      </v-flex>

      <v-flex xs12 md4 :class="$vuetify.breakpoint.smAndDown ? 'pb-2' : 'pa-2'" v-if="loadingParties">
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>{{this.nbvictoire}} Victoires / {{this.nbdefaite}} Défaites</v-toolbar-title>
        </v-toolbar>
        <v-card>
          <v-card-text style="padding: 0;">
            <highcharts :options="optionsVictoireDefaite"></highcharts>
          </v-card-text>
        </v-card>
      </v-flex>

      <v-flex xs12 md4 :class="$vuetify.breakpoint.smAndDown ? 'pb-2' : 'pa-2'" v-if="loadingParties">
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>{{this.nbperf}} Perf. / {{this.nbcontre}} Contres</v-toolbar-title>
        </v-toolbar>
        <v-card>
          <v-card-text style="padding: 0;">
            <highcharts :options="optionsVictoireDefaiteDetail"></highcharts>
          </v-card-text>
        </v-card>
      </v-flex>

      <v-flex xs12 md4 :class="$vuetify.breakpoint.smAndDown ? 'pb-2' : 'pa-2'" v-if="historique">
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>Evolution du classement<br/>
          </v-toolbar-title>
        </v-toolbar>
        <v-card>
          <v-card-text style="padding: 0;">
            <highcharts :options="optionsHistorique"></highcharts>
            <v-icon color="yellow">mdi-star</v-icon>&nbsp;
            <span class="black--text">Votre meilleur classement était en {{ bestMonth}} {{ bestYear}} avec {{ bestPoints}} pts</span>
          </v-card-text>
        </v-card>
      </v-flex>

      <v-flex xs12 md6 :class="$vuetify.breakpoint.smAndDown ? 'pb-2' : 'pa-2'" v-if="loadingUnvalidatedParties">
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>Détail des parties Non validées</v-toolbar-title>
        </v-toolbar>
        <v-card>
          <v-card-text style="padding: 0;">
            <v-data-table
                :headers="headersUnvalidatedParties"
                :items="unvalidatedParties"
                hide-actions
                :loading="!loadingUnvalidatedParties"
                no-data-text="Chargement en cours"
                class="elevation-1 white"
                style="width: 100%;"
            >
              <template slot="items" slot-scope="props">
                <td class="text-xs-left">{{fromISO(props.item.date.date)}}</td>
                <td class="text-xs-center">
                  <div v-if="props.item.isVictoire"><span class="title blue--text">V</span></div>
                  <div v-else><span class="title red--text">D</span></div>
                </td>
                <td class="text-xs-left">{{ props.item.adversairePrenom }} {{
                  props.item.adversaireNom }}
                </td>
                <td class="text-xs-center"><span
                    class="title black--text">{{ props.item.adversaireClassement }}</span></td>
                <td class="text-xs-center">
                  <div v-if="props.item.isVictoire"><span
                      class="title blue--text">{{ props.item.point }} pts</span></div>
                  <div v-else><span class="title red--text">{{ props.item.point }} pts</span>
                  </div>
                </td>
                <td class="text-xs-center"><span
                    class="title black--text">{{ props.item.epreuve }}</span></td>
              </template>
              <v-alert slot="no-results" value="true" color="error" icon="warning">
                Votre recherche ne donne aucun résultat.
              </v-alert>
            </v-data-table>
          </v-card-text>
        </v-card>
      </v-flex>

      <v-flex xs12 md6 :class="$vuetify.breakpoint.smAndDown ? 'pb-2' : 'pa-2'" v-if="loadingParties">
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>Détail des parties validées</v-toolbar-title>
        </v-toolbar>
        <v-card>
          <v-card-text style="padding: 0;">
            <v-data-table
                :headers="headersParties"
                :items="parties"
                hide-actions
                :loading="!loadingParties"
                no-data-text="Chargement en cours"
                class="elevation-1 white"
                style="width: 100%;"
            >
              <template slot="items" slot-scope="props">
                <td class="text-xs-left">{{fromISO(props.item.date.date)}}</td>
                <td class="text-xs-center">
                  <div v-if="props.item.isVictoire"><span class="title blue--text">V</span></div>
                  <div v-else><span class="title red--text">D</span></div>
                </td>
                <td class="text-xs-left">{{ props.item.adversairePrenom }} {{
                  props.item.adversaireNom }}
                </td>
                <td class="text-xs-center"><span
                    class="title black--text">{{ props.item.adversaireClassement }}</span></td>
                <td class="text-xs-center">
                  <div v-if="props.item.isVictoire"><span
                      class="title blue--text">{{ props.item.pointsObtenus }} pts</span></div>
                  <div v-else><span
                      class="title red--text">{{ props.item.pointsObtenus }} pts</span></div>
                </td>
                <td class="text-xs-center"><span class="title black--text">{{ props.item.coefficient }}</span>
                </td>
                <td class="text-xs-center"><span
                    class="title black--text">{{ props.item.journee }}</span></td>
              </template>
              <v-alert slot="no-results" value="true" color="error" icon="warning">
                Votre recherche ne donne aucun résultat.
              </v-alert>
            </v-data-table>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Inject, Prop } from 'vue-property-decorator'
import { RawLocation } from 'vue-router'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import { MutationDrawer, GetterDrawer } from '@/store/drawer'
import { GetterAuth } from '@/store/auth'
import ApiService from '@/services/api'
import JoueurDetailModel from '@/api/model/joueurDetail'
import ClassementModel from '@/api/model/classement'
import PartieModel from '@/api/model/partie'
import UnValidatedPartieModel from '@/api/model/unvalidatedPartie'
import HistoriqueModel from '@/api/model/historique'
import FfttResource from '@/api/resources/fftt'
import forEach from 'lodash/forEach'

@Component
export default class JoueurDetail extends Vue {
  @Inject()
  ffttResource: FfttResource

  @Inject()
  api: ApiService

  @MutationSnackbar
  setSnackbarEntry: (entry: SnackbarEntry) => void

  @GetterAuth
  authenticated: boolean

  @Prop({ type: String, default: null })
  licenceId: string | null

  @GetterDrawer
  Drawer: {
    (Drawer: boolean): void
  }

  joueurDetail: JoueurDetailModel | null = null
  classement: ClassementModel | null = null
  unvalidatedParties: UnValidatedPartieModel[] | null = null
  parties: PartieModel[] | null = null
  pointvirt: number = 0
  nbvictoire: number = 0
  nbdefaite?: number = 0
  nbperf?: number = 0
  nbcontre?: number = 0
  nbvnormal?: number = 0
  nbdnormal?: number = 0
  adversaire: [
    { '5': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '6': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '7': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '8': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '9': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '10': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '11': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '12': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '13': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '14': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '15': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '16': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '17': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '18': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '19': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { '20': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] },
    { 'N°': [{ 'v': 0 }, { 'd': 0 }, { 't': 0 }] }]

  historique: HistoriqueModel[] | null = null

  //  Variables de la table
  loadingParties: boolean = false
  headersParties: any[] = [
    { text: 'Date', align: 'left', value: 'date', sortable: false },
    { text: 'V/D', align: 'center', value: 'isVictoire', sortable: false },
    { text: 'Adversaire', align: 'left', value: 'advnompre', sortable: false },
    { text: 'Class.', align: 'center', value: 'adversaireClassement', sortable: false },
    { text: 'Gain / Perte', align: 'center', value: 'pointsObtenus', sortable: false },
    { text: 'Coef.', align: 'center', value: 'coefficient', sortable: false },
    { text: 'N° Jour.', align: 'center', value: 'journee', sortable: false }
  ]

  loadingUnvalidatedParties: boolean = false
  headersUnvalidatedParties: any[] = [
    { text: 'Date', align: 'left', value: 'date', sortable: false },
    { text: 'V/D', align: 'center', value: 'isVictoire', sortable: false },
    { text: 'Adversaire', align: 'left', value: 'adversaireNom', sortable: false },
    { text: 'Class.', align: 'center', value: 'adversaireClassement', sortable: false },
    { text: 'Gain / Perte', align: 'center', value: 'point', sortable: false },
    { text: 'Epreuve', align: 'center', value: 'epreuve', sortable: false }
  ]

  //  Variables du Chart Historique Classement
  categories: any[] = []
  dataPoints: any[] = []
  optionsHistorique = {
    credits: {
      enabled: false
    },
    title: {
      text: null
    },
    xAxis: {
      categories: this.categories
    },
    yAxis: {
      title: {
        text: 'Points'
      },
      plotLines: [{
        value: 0,
        width: 1,
        color: '#808080'
      }]
    },
    tooltip: {
      valueSuffix: ' points'
    },
    series: [{
      name: 'Points',
      data: this.dataPoints
    }]
  }
  bestPoints: number = 0
  bestMonth: String = ''
  bestYear: number = 0
  bestPhase: number = 0

  // Variables du Chart Victoire / Defaite
  optionsVictoireDefaite: any = {}

  // Variables du Chart Victoire / Defaite
  optionsVictoireDefaiteDetail: any = {}

  async mounted () {
    if (!this.authenticated) {
      Vue.nextTick(() => {
        this.setSnackbarEntry({
          color: 'error',
          icon: 'mdi-alert-decagram',
          message: `Vous devez être connecté pour voir le détail de ce joueur !`
        })
      })
      this.$router.push({ name: 'Home' } as RawLocation)
    } else if (this.licenceId && this.licenceId !== '' && this.licenceId !== 'undefined') {
      this.joueurDetail = await this.ffttResource.JoueurDetailsByLicence(this.licenceId)

      this.classement = await this.ffttResource.ClassementJoueurByLicence(this.licenceId)
      this.loadingUnvalidatedParties = false
      this.unvalidatedParties = await this.ffttResource.UnvalidatedPartiesJoueurByLicence(this.licenceId)
      if (this.unvalidatedParties) {
        this.pointvirt = 0
        forEach(this.unvalidatedParties, (item, key) => {
          this.pointvirt += item.point
        })
      }
      if (this.unvalidatedParties.length > 0) {
        this.loadingUnvalidatedParties = true
        forEach(this.unvalidatedParties, (item, key) => {
          if (item.isVictoire) {
            this.nbvictoire++
            if (item.point > 6 && this.nbperf !== undefined) {
              this.nbperf++
            } else {
              if (this.nbvnormal !== undefined) {
                this.nbvnormal++
              }
            }
          } else {
            if (this.nbdefaite !== undefined) {
              this.nbdefaite++
              if (item.point < -5 && this.nbcontre !== undefined) {
                this.nbcontre++
              } else {
                if (this.nbdnormal !== undefined) {
                  this.nbdnormal++
                }
              }
            }
          }
        })
      }
      this.loadingParties = false
      this.parties = await this.ffttResource.PartiesJoueurByLicence(this.licenceId)

      if (this.parties) {
        let cla: string | null = null
        let coef = 0
        forEach(this.parties, (item, key) => {
          // cla = substr(item.advclaof, 0, 1) == 'N' ? 'N°' : floor(item.adversaireClassement)
          coef = item.pointsObtenus / item.coefficient
          if (item.adversaireClassement !== undefined) {
            cla = item.adversaireClassement
          }
          // this.joueur['adversaire'][cla]['t']++
          if (item.isVictoire) {
            this.nbvictoire++
            // this.joueurPartie.adversaire[cla]['v']++
            if (coef > 6 && this.nbperf !== undefined) {
              this.nbperf++
            } else {
              if (this.nbvnormal !== undefined) {
                this.nbvnormal++
              }
            }
          } else {
            if (this.nbdefaite !== undefined) {
              this.nbdefaite++
              // this.joueurPartie['adversaire'][cla]['d']++
              if (coef < -5 && this.nbcontre !== undefined) {
                this.nbcontre++
              } else {
                if (this.nbdnormal !== undefined) {
                  this.nbdnormal++
                }
              }
            }
          }
        })
        this.optionsVictoireDefaite = {
          credits: {
            enabled: false
          },
          chart: {
            type: 'pie',
            options3d: {
              enabled: true,
              alpha: 75
            }
          },
          title: {
            text: null
          },
          tooltip: {
            pointFormat: '{series.name} <b>{point.percentage:.1f} %</b>'
          },
          plotOptions: {
            pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              innerSize: 100,
              depth: 45,
              dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                  fontWeight: 'bold',
                  color: 'white'
                }
              }
            }
          },
          series: [{
            name: ' ',
            colorByPoint: true,
            data: [{
              name: 'Victoires',
              y: this.nbvictoire,
              sliced: true,
              selected: true
            }, {
              name: 'Défaites',
              y: this.nbdefaite
            }]
          }]
        }
        this.optionsVictoireDefaiteDetail = {
          credits: {
            enabled: false
          },
          title: {
            text: null
          },
          plotOptions: {
            pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              innerSize: 100,
              depth: 45,
              dataLabels: {
                enabled: true,
                distance: -50,
                style: {
                  fontWeight: 'bold',
                  color: 'white'
                }
              }
            }
          },
          series: [{
            type: 'pie',
            name: null,
            data: [
              ['Victoires normales', this.nbvnormal, false],
              ['Perf.', this.nbperf, true, true],
              ['Contres', this.nbcontre, false],
              ['Défaites normales', this.nbdnormal, false]
            ],
            showInLegend: true
          }]
        }
      }

      if (this.parties.length !== 0) {
        this.loadingParties = true
      }
      this.historique = await this.ffttResource.HistoriqueJoueurByLicence(this.licenceId)
      if (this.historique) {
        forEach(this.historique, (item, key) => {
          if (item.points && item.points >= this.bestPoints) {
            this.bestPoints = item.points
            this.bestPhase = item.phase
            if (item.phase === 2 && item.anneeFin) {
              this.bestMonth = 'Septembre'
              this.bestYear = item.anneeFin
            }
            if (item.phase === 1 && item.anneeDebut) {
              this.bestMonth = 'Janvier'
              this.bestYear = item.anneeDebut
            }
          }
          if (item.phase === 2) {
            this.categories.push(item.anneeFin + ' Phase 1')
          }
          if (item.phase === 1) {
            this.categories.push(item.anneeDebut + ' Phase 2')
          }
          this.dataPoints.push(item.points)
        })
      }
    }
  }

  fromISO (date: any) {
    const d = new Date(date)
    return d ? d.toLocaleDateString('fr-FR') : ''
  }
}
</script>

<style lang="scss" scoped>
/deep/ table.v-table thead td:not(:nth-child(1)), table.v-table tbody td:not(:nth-child(1)), table.v-table thead th:not(:nth-child(1)), table.v-table tbody th:not(:nth-child(1)), table.v-table thead td:first-child, table.v-table tbody td:first-child, table.v-table thead th:first-child, table.v-table tbody th:first-child {
  padding: 0 5px;
}

.main-wrapper-desktop {
  padding: 30px 30px 30px 30px !important;
}

.main-wrapper-mobile {
  padding: 30px 0px 30px 0px !important;
}

</style>
