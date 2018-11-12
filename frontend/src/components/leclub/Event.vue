<template>
  <div class="event">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <v-container fluid>
        <v-layout row wrap>
          <v-flex xs12 sm8>
            <v-card v-if="event">
              <v-img><img v-bind:src="event.image + '_378x270.jpg'" width="100%"/>
              </v-img>
              <v-toolbar flat dense color="primary">
                <v-toolbar-title><span
                    class="white--text" v-html="event.titre"/>
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <span class="white--text text-capitalize">{{ event.dtdebut.date | moment('dddd D MMMM YYYY') }} à {{ event.dtdebut.date | moment('H:mm') }}</span>
              </v-toolbar>
              <v-card-text v-html="event.contenu"/>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn icon color="facebook" dark
                       :href="'https://www.facebook.com/sharer/sharer.php?u=' + event.lien"
                       target="_blank"
                       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=400');">
                  <v-icon>mdi-facebook</v-icon>
                </v-btn>
                <v-btn icon color="twitter" dark
                       :href="'https://twitter.com/intent/tweet?url=' + event.lien + '&text=' + event.titre"
                       target="_blank"
                       onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=400');">
                  <v-icon>mdi-twitter</v-icon>
                </v-btn>
                <v-btn icon color="google-plus" dark
                       :href="'https://plus.google.com/share?url=' + event.lien"
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
            <v-container fluid grid-list-md :class="[$vuetify.breakpoint.mdAndUp ? 'px-2': 'pb-1']"
                         v-if="equipes">
              <v-layout row wrap>
                <v-flex xs12 sm4
                        v-if="equipes"
                        v-for="item in lstRencontres"
                        :key="item.id"
                >
                  <v-card>
                    <v-card-title class="secondary" @click.native="doSomething()"
                                  v-if="item.nomEquipeA.substring(0, 10) === 'ST MARCEAU'">
                      <a @click="rechercheEquipePoule(item.lienDivision, item.division)"
                         class="white--text font-weight-bold mb-0">
                        <b>{{ item.nomEquipeA }}</b>
                      </a>
                      <v-spacer></v-spacer>
                      <v-tooltip bottom v-if="$permission.isRole(['ROLE_ADMIN'])">
                        <v-btn slot="activator" icon @click.native="onRecoit(item)">
                          <v-icon class="white--text">mdi-email</v-icon>
                        </v-btn>
                        <span class="text-xs-center">Envoyer mail pour signaler<br/>que le gymnase ouvre à 20h</span>
                      </v-tooltip>
                    </v-card-title>
                    <v-card-title class="third" @click.native="doSomething()"
                                  v-if="item.nomEquipeB.substring(0, 10) === 'ST MARCEAU'">
                      <a @click="rechercheEquipePoule(item.lienDivision, item.division)"
                         class="white--text font-weight-bold mb-0">
                        {{ item.nomEquipeB }}
                      </a>
                    </v-card-title>
                    <v-card-text>
                      <v-flex xs12>{{ item.libelle }}</v-flex>
                      <v-flex xs12 v-if="item.nomEquipeA.substring(0, 10) === 'ST MARCEAU'">Reçois
                        {{ item.nomEquipeB }}
                      </v-flex>
                      <v-flex xs12 v-if="item.nomEquipeB.substring(0, 10) === 'ST MARCEAU'">Se
                        déplace {{
                        item.nomEquipeA }}
                      </v-flex>
                    </v-card-text>
                  </v-card>
                </v-flex>
              </v-layout>
            </v-container>
            <v-container fluid grid-list-xl>
              <v-layout row justify-space-between>
                <v-flex xs6>
                  <v-btn color="primary" dark @click="eventLink(item.id - 1)">
                    <v-icon>mdi-chevron-left</v-icon>
                    <div v-if="$vuetify.breakpoint.mdAndUp">Event précédent</div>
                  </v-btn>
                </v-flex>
                <v-flex xs6 class="text-xs-right">
                  <v-btn color="primary" dark @click="eventLink(item.id + 1)">
                    <div v-if="$vuetify.breakpoint.mdAndUp">Event suivant</div>
                    <v-icon>mdi-chevron-right</v-icon>
                  </v-btn>
                </v-flex>
              </v-layout>
            </v-container>
          </v-flex>
          <v-flex sm4>
            <v-list>
              <v-list-tile
                  v-for="(item, i) in events"
                  :key="item.id"
                  @click="eventLink(item.id)"
                  v-if="i < 10"
              >
                <v-list-tile-content>
                  <v-list-tile-title>{{ item.debutdate }} - {{ item.titre }}</v-list-tile-title>
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
import EventModel, { EventDetailModel } from '@/api/model/event'
import EventResource from '@/api/resources/event'
import FfttResource from '@/api/resources/fftt'
import EquipeModel from '@/api/model/equipe'
import RencontreModel from '@/api/model/rencontre'
import ApiService from '@/services/api'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import forEach from 'lodash/forEach'
import find from 'lodash/find'
import moment from 'moment'
import EmailResource from '@/api/resources/email'
import EmailModel from '@/api/model/email'
import CarteResource from '@/api/resources/carte'
import CarteModel from '@/api/model/carte'

@Component
export default class Event extends Vue {
  @Inject()
  eventResource: EventResource

  @Inject()
  ffttResource: FfttResource

  @Inject()
  api: ApiService

  @Inject()
  emailResource: EmailResource

  @Inject()
  carteResource: CarteResource

  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @MutationSnackbar
  setSnackbarEntry: (entry: SnackbarEntry) => void

  event: EventDetailModel | null = null
  events: EventModel[] = []
  club: string = '04450026'
  equipes: EquipeModel[] | null = null
  rencontres: RencontreModel[] | null = null
  lstRencontres: any = []
  email: EmailModel | null = null
  cartes: CarteModel[] | null = null

  async mounted () {
    // console.log('permission:' + this.$permission.isRole(['ROLE_ADMIN']))
    if (this.$route.params.id) {
      this.event = await this.eventResource.eventById('' + this.$route.params.id)
      if (this.event) {
        document.title = this.event.titre + ' - Saint Marceau Orléans Tennis de Table - stmarceautt.fr'
        this.events = await this.eventResource.events()
        // if (this.event.badge !== undefined && this.event.badge != null && this.event.badge.id === 7 && this.event.debutdate != null) {
        // Equipes Senior
        if (this.event.categorie !== null && this.event.categorie.id === 7) {
          if (this.event.badge !== null && this.event.badge.id === 6) {
            this.equipes = await this.ffttResource.lesequipes(this.club, 'M')
          }
          // Equipes Vétéran
          if (this.event.badge !== null && this.event.badge.id === 7) {
            this.equipes = await this.ffttResource.lesequipes(this.club)
          }
        }
        forEach(this.equipes, async (item, key) => {
          if (item.lienDivision !== null) {
            this.rencontres = await this.ffttResource.rencontrePoule(item.lienDivision)
            let journeeRencontre: string = ''
            forEach(this.rencontres, (r, key) => {
              if (r.datePrevue !== null && r.datePrevue !== undefined && this.event !== null && this.event.slug !== null && this.event.slug !== undefined) {
                journeeRencontre = r.libelle.substring(18, 19)
                // this.datePrevue = r.datePrevue.getDay() + '/' + r.datePrevue.getMonth() + '/' + r.datePrevue.getFullYear()
                // this.datePrevue = r.libelle.substring(r.libelle.length - 8)
                // this.datePrevue = this.datePrevue.substring(0, 6) + '20' + r.libelle.substring(r.libelle.length - 2)
                // this.datePrevue = moment(r.datePrevue).format('DD/MM/Y')
                // console.log('journee:' + journeeRencontre + 'Date:' + this.event.slug.substring(8,9))
                // console.log('Date:' +new Date(r.datePrevue.date) + '-' + moment(this.event.dtdebut) + ' index:' + key + ' A:' + r.nomEquipeA.substring(0, 10) + ' B:' + r.nomEquipeB.substring(0, 10))
                // if ((r.nomEquipeA.substring(0, 10) === 'ST MARCEAU' || r.nomEquipeB.substring(0, 10) === 'ST MARCEAU') && moment(r.datePrevue).format('DD/MM/Y') === this.event.debutdate) {
                if ((r.nomEquipeA.substring(0, 10) === 'ST MARCEAU' || r.nomEquipeB.substring(0, 10) === 'ST MARCEAU')) {
                  // console.log('Date :' + this.datePrevue + '-' + this.event.debutdate + ' index:' + key + ' A:' + r.nomEquipeA.substring(0, 10) + ' B:' + r.nomEquipeB.substring(0, 10))
                  if (journeeRencontre === this.event.slug.substring(8, 9)) {
                    // console.log('Ecris')
                    this.lstRencontres.push(r)
                  }
                }
              }
            })
          }
        })
        if (this.event.categorie !== null && this.event.categorie.id === 7) {
          //  On charge les cartes pour retrouver les emails des clubs
          this.cartes = await this.carteResource.cartes()
        }
        // }
      } else {
        Vue.nextTick(() => {
          this.setSnackbarEntry({
            color: 'error',
            icon: 'mdi-alert-decagram',
            message: `Aucun événement ne correspond à votre demande !`
          })
        })
      }
    } else {
      Vue.nextTick(() => {
        this.setSnackbarEntry({
          color: 'error',
          icon: 'mdi-alert-decagram',
          message: `Votre demande ne correspond à aucun événement !`
        })
      })
    }
  }

  async eventLink (id: string) {
    this.event = await this.eventResource.eventById(id)
    if (this.event) {
      document.title = this.event.titre + ' - Saint Marceau Orléans Tennis de Table - stmarceautt.fr'
    }
  }

  created () {
    this.setDrawer(true)
  }

  async rechercheEquipePoule (lienDivision: string, division: string) {
    // this.titleEquipePoule = division
    // this.journee = []
    // this.displayEquipePoule = true
    // this.loadingEquipePoule = true
    // this.equipePoule = await this.ffttResource.equipeClassementPoule(lienDivision)
    // this.loadingEquipePoule = false
    // this.displayRencontrePoule = true
    // this.loadingRencontrePoule = true
    // this.rencontre = await this.ffttResource.rencontrePoule(lienDivision)
    // let journee = 0
    // let titre = ''
    // let dernierLibelle = ''
    // // let rencontreArray = []
    // let counter = 0
    // forEach(this.rencontre, (item, key) => {
    //   counter++
    //   if (item.libelle && item.libelle !== dernierLibelle) {
    //     journee++
    //     titre = item.libelle
    //     dernierLibelle = item.libelle
    //     this.journee.push({
    //       journee: journee,
    //       titre: titre,
    //       datePrevue: item.datePrevue
    //     })
    //   }
    //
    //   this.journee.push({
    //     nomEquipeA: item.nomEquipeA,
    //     scoreEquipeA: item.scoreEquipeA,
    //     scoreEquipeB: item.scoreEquipeB,
    //     nomEquipeB: item.nomEquipeB,
    //     lien: item.lien
    //   })
    // })
    // this.loadingRencontrePoule = false
  }

  async onRecoit (equipe: any) {
    this.email = new EmailModel()
    this.email.name = equipe.nomEquipeA
    // if (equipe.nomEquipeB !== undefined && equipe.nomEquipeB.length !== undefined) {
    //   this.email.email = find(this.cartes, (o) => o.slug === equipe.nomEquipeB.substr(0, equipe.nomEquipeB.length - 2)).email
    // }
    this.email.sujet = equipe.libelle
    this.email.message = ''
    console.log(this.email)
    await this.emailResource.emailRecoit(this.email)
  }
}
</script>

<style lang="scss" scoped>
.theme--light .v-list, .application .theme--light.v-list {
  background: rgba(0, 0, 0, 0.87);
  color: #fff;
}
</style>
