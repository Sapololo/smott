<template>
  <div class="les-licences-du-club">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-flex xs12>
        <v-toolbar flat color="primary">
          <v-toolbar-title>
            <div v-if="clubDetail"><span
                class="headline white--text">{{ clubId }} - {{ clubDetail.nom }}</span> - <span
                v-if="loadingJoueursDetails"
                class="headline white--text">{{ joueursDetails.length }} Licenciés</span>
              <span
                  v-if="loadingAdherents"
                  class="headline white--text">{{ adherents.length }} Licenciés</span>
            </div>
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items v-if="clubId">
            <div class="text-xs-center">
              <v-tooltip bottom>
                <v-btn slot="activator" icon>
                  <v-icon color="white" @click="statistiqueClubId(clubId)">mdi-finance</v-icon>
                </v-btn>
                <span>Statistiques</span>
              </v-tooltip>
            </div>
          </v-toolbar-items>
        </v-toolbar>
        <v-flex xs12 class="secondary pa-3" v-if="!loadingAdherents && !loadingJoueursDetails"><h1
            class="text-xs-center white--text text-uppercase">Chargement des joueurs en cours</h1>
          <v-progress-linear :indeterminate="true" color="error"
                             height="10"
                             value="75"></v-progress-linear>
        </v-flex>
        <template v-if="!authenticated && loadingJoueursDetails">
          <v-data-table
              :headers="headersJoueur"
              :items="joueursDetails"
              hide-actions
              no-data-text="Chargement en cours"
              class="elevation-1"
              :loading="loadingJoueursDetails"
          >
            <template slot="items" slot-scope="props">
              <td class="text-xs-center">
                <router-link :to="{ name: 'Joueur', params: { licenceId: props.item.licence }}"><span
                    class="title">{{ props.item.licence}}</span>
                </router-link>
              </td>
              <td class="text-xs-left">{{ props.item.nom }}</td>
              <td class="text-xs-left">{{ props.item.prenom }}</td>
              <td class="text-xs-center">{{ props.item.pointDebutSaison }}</td>
              <td class="text-xs-center">{{ props.item.pointsMensuel }}</td>
              <td class="text-xs-center">{{ props.item.categorie }}</td>
            </template>
          </v-data-table>
        </template>
        <template v-if="authenticated && loadingAdherents">
          <v-data-table
              :headers="headersAdherent"
              :items="adherents"
              hide-actions
              no-data-text="Chargement en cours"
              class="elevation-1"
              v-if="loadingAdherents"
          >
            <template slot="items" slot-scope="props">
              <td class="text-xs-center">
                <router-link :to="{ name: 'Joueur', params: { licenceId: props.item.licence }}"><span
                    class="title">{{ props.item.licence}}</span>
                </router-link>
              </td>
              <td class="text-xs-left">{{ props.item.nom }}</td>
              <td class="text-xs-left">{{ props.item.prenom }}</td>
              <td class="text-xs-center">
                <v-icon color="blue" v-if="props.item.isHomme">mdi-gender-male</v-icon>
                <v-icon color="pink" v-if="!props.item.isHomme">mdi-gender-female</v-icon>
              </td>
              <td class="text-xs-center">
                <div v-if="props.item.type === 'Promotionnelle'">Promo.</div>
                <div color="pink" v-else>Tradi.</div>
              </td>
              <td class="text-xs-center">{{ props.item.pointsLicence }}</td>
              <td class="text-xs-center">{{ props.item.pointsMensuel }}</td>
              <td class="text-xs-center">
                <div v-if="props.item.pointsVirtuel != 0">
                  <v-chip color="green" text-color="white" v-if="props.item.pointsVirtuel >= 0">{{
                    props.item.pointsVirtuel }}
                  </v-chip>
                  <v-chip color="red" text-color="white" v-else>{{ props.item.pointsVirtuel }}
                  </v-chip>
                </div>
              </td>
              <td class="text-xs-center"><span v-if="props.item.pointsVirtuel != 0">{{ props.item.classVirtuel }}</span>
              </td>
              <td class="text-xs-center">
                <div v-if="props.item.progression != 0">
                  <v-chip color="green" text-color="white" v-if="props.item.pointsVirtuel >= 0">
                    <v-icon color="white">mdi-arrow-top-right</v-icon>
                    {{ props.item.progression }}
                  </v-chip>
                  <v-chip color="red" text-color="white" v-else>
                    <v-icon color="white">mdi-arrow-bottom-right</v-icon>
                    {{ props.item.progression }}
                  </v-chip>
                </div>
              </td>
            </template>
            <v-alert slot="no-results" value="true" color="error" icon="warning">
              Votre recherche ne donne aucun résultat.
            </v-alert>
          </v-data-table>
        </template>
      </v-flex>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue, Inject } from 'vue-property-decorator'
import { RawLocation } from 'vue-router'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import { GetterAuth } from '@/store/auth'
import ApiService from '@/services/api'
import ClubDetailModel from '@/api/model/clubDetail'
import JoueurDetailModel from '@/api/model/joueurDetail'
import AdherentModel from '@/api/model/adherent'
import FfttResource from '@/api/resources/fftt'
import AdherentResource from '@/api/resources/adherent'

@Component({ components: { Banner } })
export default class LesLicencesDuClub extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @Inject()
  ffttResource: FfttResource

  @Inject()
  adherentResource: AdherentResource

  @Inject()
  api: ApiService

  @MutationSnackbar
  setSnackbarEntry: (entry: SnackbarEntry) => void

  @GetterAuth
  authenticated: boolean

  clubId: string = ''
  clubDetail: ClubDetailModel | null = null
  joueursDetails: JoueurDetailModel[] | null = null
  loadingJoueursDetails: boolean = false
  adherents: AdherentModel[] | null = null
  loadingAdherents: boolean = false
  headersJoueur: any[] = [
    { text: 'N° licence', align: 'center', value: 'licence', sortable: false },
    { text: 'Nom', align: 'left', value: 'nom', sortable: true },
    { text: 'Prénom', align: 'left', value: 'prenom', sortable: true },
    { text: 'Début Saison', align: 'center', value: 'pointDebutSaison', sortable: true },
    { text: 'Mensuel', align: 'center', value: 'pointsMensuel', sortable: true },
    { text: 'Catégorie', align: 'center', value: 'categorie', sortable: true }
  ]
  headersAdherent: any[] = [
    { text: 'N° licence', align: 'center', value: 'licence', sortable: false },
    { text: 'Nom', align: 'left', value: 'nom', sortable: true },
    { text: 'Prénom', align: 'left', value: 'prenom', sortable: true },
    { text: 'Sexe', align: 'center', value: 'isHomme', sortable: true },
    { text: 'Type', align: 'center', value: 'type', sortable: true },
    { text: 'Début Saison', align: 'center', value: 'pointsLicence', sortable: true },
    { text: 'Mensuel', align: 'center', value: 'pointsMensuel', sortable: true },
    { text: 'Virtuel', align: 'center', value: 'pointsVirtuel', sortable: true },
    { text: 'Class. Virtuel', align: 'center', value: 'classVirtuel', sortable: true },
    { text: 'Evol.', align: 'center', value: 'progression', sortable: true }
  ]

  async beforeMount () {
    if (this.$route.params.clubId) {
      this.clubId = this.$route.params.clubId
    } else {
      this.clubId = '04450026'
    }
    await this.rechercheClub(this.clubId)
  }

  async rechercheClub (clubId: any) {
    this.loadingJoueursDetails = false
    this.loadingAdherents = false
    if (!this.authenticated && this.clubId !== '04450026') {
      Vue.nextTick(() => {
        this.setSnackbarEntry({
          color: 'error',
          icon: 'mdi-alert-decagram',
          message: `Vous devez être connecté pour voir les statistiques de ce club !`
        })
      })
      this.$router.push({ name: 'Home' } as RawLocation)
    } else {
      if (this.authenticated && this.clubId === '04450026') {
        this.adherents = await this.adherentResource.adherents()
        // await this.adherentResource.updateAdherents()
        this.loadingAdherents = true
      } else {
        this.joueursDetails = await this.ffttResource.joueursDetailsByClub(this.clubId)
        this.loadingJoueursDetails = true
      }
      this.clubDetail = await this.ffttResource.clubdetail(this.clubId)
    }
  }

  statistiqueClubId (clubId: any) {
    this.$router.push({ name: 'Statistiques', params: { clubId: clubId } } as RawLocation)
  }
}
</script>
