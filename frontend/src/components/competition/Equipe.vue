<template>
  <div class="equipe">
    <rencontre :dialogDisplay="rencontreDisplayed" :detailsRencontre="detailsRencontre"></rencontre>
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout column>

        <v-container fluid grid-list-md :class="[$vuetify.breakpoint.mdAndUp ? 'px-2': 'pb-1']">
          <v-layout row wrap>
            <v-flex xs12 sm4
                    v-for="item in equipesM"
                    :key="item.id"
            >
              <v-card>
                <v-card-title class="secondary" @click.native="doSomething()">
                  <a @click="rechercheEquipePoule(item.lienDivision, item.division)"
                     class="white--text font-weight-bold mb-0"
                     v-html="item.libelle"/>
                </v-card-title>
                <v-card-text>{{ item.division }}</v-card-text>
              </v-card>
            </v-flex>
            <v-flex xs12 sm4
                    v-for="item in equipesA"
                    :key="item.id"
            >
              <v-card>
                <v-card-title :class="[item.division.indexOf('POULES JEUNES') === 0 ? 'jeune': 'veteran']" @click.native="doSomething()">
                  <a @click="rechercheEquipePoule(item.lienDivision, item.division)"
                     class="white--text font-weight-bold mb-0"
                     v-html="item.libelle"/>
                </v-card-title>
                <v-card-text>{{ item.division }}</v-card-text>
              </v-card>
            </v-flex>

          </v-layout>
        </v-container>

        <v-flex :class="[$vuetify.breakpoint.mdAndUp ? 'md6 px-2': 'xs12 pb-1']" v-if="displayEquipePoule">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Classement de la poule</v-toolbar-title>
          </v-toolbar>
          <v-card>
            <v-card-title><h2>{{ titleEquipePoule }}</h2></v-card-title>
            <v-card-text style="padding: 0;">
              <v-data-table
                  :headers="headersPoule"
                  :items="equipePoule"
                  hide-actions
                  :loading="loadingEquipePoule"
                  no-data-text="Chargement en cours"
                  class="elevation-1 white"
                  style="width: 100%;"
              >
                <template slot="items" slot-scope="props">
                  <td class="text-xs-center">{{props.item.classement}}</td>
                  <td class="text-xs-left">
                    <div v-if="props.item.numero == '04450026'" class="blue--text subheading">
                      {{props.item.nomEquipe}}
                    </div>
                    <div v-else>{{props.item.nomEquipe}}</div>
                  </td>
                  <td class="text-xs-center">
                    <v-layout>
                      <v-flex xs6>
                        <div v-if="!authenticated">
                          <v-tooltip bottom color="red">
                            <span slot="activator"><v-icon color="blue">mdi-finance</v-icon></span>
                            <span>Vous devez être connecté<br/>pour voir les statistiques de ce club !</span>
                          </v-tooltip>
                        </div>
                        <div v-else>
                          <v-tooltip bottom>
                            <v-btn slot="activator" icon>
                              <v-icon color="blue"
                                      @click="statistiqueClubId(props.item.numero)">
                                mdi-finance
                              </v-icon>
                            </v-btn>
                            <span>Les Statistiques</span>
                          </v-tooltip>
                        </div>
                      </v-flex>
                      <v-flex xs6 v-if="props.item.numero != '04450026'">
                        <div v-if="!authenticated">
                          <v-tooltip bottom color="red">
                                                        <span slot="activator"><v-icon
                                                            color="blue">mdi-account-multiple</v-icon></span>
                            <span>Vous devez être connecté<br/>pour voir les équipes de ce club !</span>
                          </v-tooltip>
                        </div>
                        <div v-else>
                          <v-tooltip bottom>
                            <v-btn slot="activator" icon>
                              <v-icon color="blue"
                                      @click="equipeClubId(props.item.numero)">
                                mdi-account-multiple
                              </v-icon>
                            </v-btn>
                            <span>Les Equipes</span>
                          </v-tooltip>
                        </div>
                      </v-flex>
                    </v-layout>
                  </td>
                  <td class="text-xs-center"><span
                      class="title black--text">{{ props.item.points }}</span></td>
                  <td class="text-xs-center"><span class="title black--text">{{ props.item.matchJouees }}</span>
                  </td>
                  <td class="text-xs-center"><span
                      class="title bleu--text">{{ props.item.victoires }}</span></td>
                  <td class="text-xs-center"><span
                      class="title red--text">{{ props.item.defaites }}</span></td>
                </template>
                <v-alert slot="no-results" value="true" color="error" icon="warning">
                  Votre recherche ne donne aucun résultat.
                </v-alert>
              </v-data-table>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex :class="[$vuetify.breakpoint.mdAndUp ? 'md6 px-2': 'xs12 pb-1']" v-if="displayRencontrePoule">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>RÉSULTATS PAR JOURNÉE de la poule</v-toolbar-title>
          </v-toolbar>
          <v-card>
            <v-card-text style="padding: 0;">
              <v-data-table
                  :headers="headersRencontre"
                  :items="journee"
                  hide-actions
                  :loading="loadingRencontrePoule"
                  no-data-text="Chargement en cours"
                  class="elevation-1 white"
                  style="width: 100%;"
              >
                <template slot="items" slot-scope="props">
                  <td class="text-xs-left secondary white--text subheading" v-if="props.item.journee"
                      colspan="5"
                      style="padding: 0 24px;">Tour n°{{
                    props.item.journee }} le {{fromISO(props.item.datePrevue.date)}}
                  </td>
                  <td class="text-xs-right" v-if="!props.item.journee">
                    {{props.item.nomEquipeA}}
                  </td>
                  <td class="text-xs-center" v-if="props.item.scoreA > 0 || props.item.scoreB > 0">
                    {{props.item.scoreA}}
                  </td>
                  <td class="text-xs-center" v-else></td>
                  <td class="text-xs-center" v-if="props.item.scoreA > 0 || props.item.scoreB > 0">
                    {{props.item.scoreB}}
                  </td>
                  <td class="text-xs-center" v-else></td>
                  <td class="text-xs-left" v-if="!props.item.journee">{{ props.item.nomEquipeB }}</td>
                  <td class="center" v-if="!props.item.journee">
                    <v-btn fab light small slot="activator"
                           @click="rechercheRencontre(props.item.lien, props.item.clubEquipeA, props.item.clubEquipeB)"
                           v-if="props.item.scoreA > 0 || props.item.scoreB > 0">
                      <v-icon color="secondary">mdi-poll</v-icon>
                    </v-btn>
                  </td>
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
  </div>

</template>

<script lang="ts">
import { Component, Inject, Vue } from 'vue-property-decorator'
import { RawLocation } from 'vue-router'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import { GetterAuth } from '@/store/auth'
import ApiService from '@/services/api'
import ClubDetailModel from '@/api/model/clubDetail'
import EquipeModel from '@/api/model/equipe'
import EquipePouleModel from '@/api/model/equipePoule'
import RencontreModel from '@/api/model/rencontre'
import RencontreDetailModel from '@/api/model/rencontreDetail'
import FfttResource from '@/api/resources/fftt'
import CarteModel from '@/api/model/carte'
import CarteResource from '@/api/resources/carte'
import forEach from 'lodash/forEach'
import find from 'lodash/find'
import Rencontre from '@/components/competition/Rencontre.vue'

@Component({ components: { Banner, Rencontre } })
export default class Equipe extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @Inject()
  ffttResource: FfttResource

  @Inject()
  carteResource: CarteResource

  @Inject()
  api: ApiService

  @MutationSnackbar
  setSnackbarEntry: (entry: SnackbarEntry) => void

  @GetterAuth
  authenticated: boolean

  club: string = '04450026'
  equipesM: EquipeModel[] | null = null
  equipesF: EquipeModel[] | null = null
  equipesA: EquipeModel[] | null = null
  equipePoule: EquipePouleModel[] = []
  carte: CarteModel | null = null
  headersPoule: any[] = [
    { text: '#', align: 'center', value: 'classement', sortable: false, width: '5%' },
    { text: 'Équipe', align: 'left', value: 'nomEquipe', sortable: false, width: '53%' },
    { text: '', align: 'center', value: 'action', sortable: false, width: '10%' },
    { text: 'Pts', align: 'center', value: 'points', sortable: false, width: '8%', style: 'padding: 0 0px;' },
    {
      text: 'Jou.',
      align: 'center',
      value: 'matchJouees',
      sortable: false,
      width: '8%',
      style: 'padding: 0 0px;'
    },
    { text: 'Vic.', align: 'center', value: 'victoires', sortable: false, width: '8%', style: 'padding: 0 0px;' },
    { text: 'Def.', align: 'center', value: 'defaites', sortable: false, width: '8%', style: 'padding: 0 0px;' }
  ]
  rencontre: RencontreModel[] | null = null
  headersRencontre: any[] = [
    { text: 'Équipe', align: 'center', value: 'nomEquipeA', sortable: false, width: '40%' },
    { text: 'Dom.', align: 'center', value: 'scoreEquipeA', sortable: false, width: '5%' },
    { text: 'Ext.', align: 'center', value: 'scoreEquipeB', sortable: false, width: '5%' },
    { text: 'Équipe.', align: 'center', value: 'nomEquipeA', sortable: false, width: '40%' },
    { text: '', align: 'center', sortable: false, width: '10%' }
  ]
  journee: any[] = [{
    journee: '',
    titre: '',
    datePrevue: '',
    nomEquipeA: '',
    scoreA: '',
    scoreB: '',
    clubEquipeB: ''
  }]

  clubDetail: ClubDetailModel | null = null
  displayEquipePoule: boolean = false
  loadingEquipePoule: boolean = false
  displayRencontrePoule: boolean = false
  loadingRencontrePoule: boolean = false
  titleEquipePoule: string = ''

  detailsRencontre: RencontreDetailModel[] = []
  rencontreDisplayed: boolean = false

  async beforeMount () {
    const num = Number(this.$route.params.num)
    console.log(num)
    if (num && num <= 15) {
      await this.rechercheEquipe('04450026')
      if (num === 1) {
        await this.rechercheEquipePoule('cx_poule=6240&D1=3658&organisme_pere=1004', 'PRENATIONALE MESSIEURS Poule A')
      } else if (num === 2) {
        await this.rechercheEquipePoule('cx_poule=6242&D1=3659&organisme_pere=1004', 'REGIONALE 1 MESSIEURS Poule A')
      } else if (num === 3) {
        await this.rechercheEquipePoule('cx_poule=6258&D1=3662&organisme_pere=1004', 'REGIONALE 3 MESSIEURS Poule F')
      } else if (num === 4) {
        await this.rechercheEquipePoule('cx_poule=6256&D1=3662&organisme_pere=1004', 'REGIONALE 3 MESSIEURS Poule D')
      } else if (num === 5) {
        await this.rechercheEquipePoule('cx_poule=950743&D1=37887&organisme_pere=45', 'DEPARTEMENTALE 3 Poule C')
      } else if (num === 6) {
        await this.rechercheEquipePoule('cx_poule=950742&D1=37887&organisme_pere=45', 'DEPARTEMENTALE 3 Poule B')
      } else if (num === 7) {
        await this.rechercheEquipePoule('cx_poule=950753&D1=37889&organisme_pere=45', 'DEPARTEMENTALE 5 Poule D')
      } else if (num === 8) {
        await this.rechercheEquipePoule('cx_poule=1292923&D1=37890&organisme_pere=45', 'DEPARTEMENTALE 6 Poule E')
      } else if (num === 10) {
        await this.rechercheEquipePoule('cx_poule=698098&D1=4664&organisme_pere=45', 'D1 VETERANS')
      } else if (num === 11) {
        await this.rechercheEquipePoule('cx_poule=16346&D1=4664&organisme_pere=45', 'D1 VETERANS')
      } else if (num === 12) {
        await this.rechercheEquipePoule('cx_poule=194587&D1=16450&organisme_pere=45', 'D3 VETERANS')
      } else if (num === 13) {
        await this.rechercheEquipePoule('cx_poule=1131437&D1=42542&organisme_pere=45', 'JEUNES 1')
      } else if (num === 14) {
        await this.rechercheEquipePoule('cx_poule=1131438&D1=42542&organisme_pere=45', 'JEUNES 2')
      } else if (num === 15) {
        await this.rechercheEquipePoule('cx_poule=1131439&D1=42542&organisme_pere=45', 'JEUNES 3')
      }
    } else if (num) {
      await this.rechercheEquipe(num)
    }
  }

  async rechercheEquipe (num: any) {
    if (!this.authenticated && !num) {
      Vue.nextTick(() => {
        this.setSnackbarEntry({
          color: 'error',
          icon: 'mdi-alert-decagram',
          message: `Aucun numéro d'équipe n'est renseigné !`
        })
      })
      this.$router.push({ name: 'Home' } as RawLocation)
    } else {
      this.equipesM = null
      this.equipesF = null
      this.equipesA = null
      this.equipesM = await this.ffttResource.lesequipes(this.club, 'M')
      this.equipesA = await this.ffttResource.lesequipes(this.club)
      // try {
      //   this.equipesF = await this.ffttResource.lesequipes(this.club, 'F')
      // } catch {
      //   Vue.nextTick(() => {
      //     this.setSnackbarEntry({
      //       color: 'error',
      //       icon: 'mdi-alert-decagram',
      //       message: `Vous devez être connecté pour voir le détail de ce joueur !`
      //     })
      //   })
      // }
    }
  }

  async rechercheEquipePoule (lienDivision: string, division: string) {
    this.titleEquipePoule = division
    this.journee = []
    this.displayEquipePoule = true
    this.loadingEquipePoule = true
    this.equipePoule = await this.ffttResource.equipeClassementPoule(lienDivision)
    this.loadingEquipePoule = false
    this.displayRencontrePoule = true
    this.loadingRencontrePoule = true
    this.rencontre = await this.ffttResource.rencontrePoule(lienDivision)
    let journee = 0
    let titre = ''
    let dernierLibelle = ''
    // let rencontreArray = []
    let counter = 0
    let clubEquipeA = ''
    let clubEquipeB = ''
    forEach(this.rencontre, (item, key) => {
      counter++
      if (item.libelle && item.libelle !== dernierLibelle) {
        journee++
        titre = item.libelle
        dernierLibelle = item.libelle
        this.journee.push({
          journee: journee,
          titre: titre,
          datePrevue: item.datePrevue
        })
      }

      const clubA = find(this.equipePoule, (o) => o.nomEquipe === item.nomEquipeA)
      clubEquipeA = clubA !== undefined ? clubA.numero : clubEquipeA = ''
      const clubB = find(this.equipePoule, (o) => o.nomEquipe === item.nomEquipeB)
      clubEquipeB = clubB !== undefined ? clubB.numero : clubEquipeB = ''

      this.journee.push({
        datePrevue: item.datePrevue,
        journee: '',
        lien: item.lien,
        clubEquipeA: clubEquipeA,
        nomEquipeA: item.nomEquipeA,
        scoreA: '' + item.scoreEquipeA,
        scoreB: '' + item.scoreEquipeB,
        nomEquipeB: item.nomEquipeB,
        clubEquipeB: clubEquipeB,
        titre: titre
      })
    })
    this.loadingRencontrePoule = false
    //  Chargement des données complémentaire du club : nom et localisation
    // forEach(this.equipePoule, (item, key) => {
    //   if (item.numero !== '04450026') {
    //     this.carte = this.carteResource.carte(item.numero)
    //     console.log(this.carte)
    //     if (this.carte !== null) {
    //       item.nom = this.carte.nom
    //       item.latitude = this.carte.latitude
    //       item.longitude = this.carte.longitude
    //       console.log(item)
    //       this.equipePoule.splice(key, 1, item)
    //     }
    //   }
    // })
  }

  async rechercheRencontre (lien: string, clubEquipeA: string, clubEquipeB: string) {

    try {
      this.rencontreDisplayed = true
      this.detailsRencontre = []
      this.detailsRencontre = await this.ffttResource.detailsRencontre(lien, clubEquipeA, clubEquipeB)
    } catch ($e) {
      this.rencontreDisplayed = false
    }
  }

  statistiqueClubId (clubId: any) {
    this.$router.push({ name: 'Statistiques', params: { clubId: clubId } } as RawLocation)
  }

  equipeClubId (clubId: any) {
    this.$router.push({ name: 'Equipe', params: { clubId: clubId } } as RawLocation)
  }

  fromISO (date: any) {
    const d = new Date(date)
    return d ? d.toLocaleDateString('fr-FR') : ''
  }
}
</script>

<style lang="scss" scoped>
a {
  text-decoration: none;
}

/deep/ table.v-table {
  table-layout: fixed;
}

/deep/ th {
  background-color: #fff; /* just for LIGHT THEME, change it to #474747 for DARK */
  position: sticky;
  top: 0;
  z-index: 1;
}

/deep/ tr.datatable__progress th {
  top: 56px;
}

/deep/ .table__overflow {
  overflow: auto;
  height: 100%;
}

.veteran {
  background-color: #1E88E5 !important;
  border-color: #1E88E5 !important;
}

.jeune {
  background-color: #4caf50 !important;
  border-color: #4caf50 !important;
}
</style>
