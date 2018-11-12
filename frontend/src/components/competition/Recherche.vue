<template>
  <div class="qui-fait-quoi">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout v-if="!this.authenticated">
        <v-flex xs12>Cette page est uniquement accessible aux adhérents du club !</v-flex>
      </v-layout>
      <v-layout row wrap class="pb-2">
        <v-flex xs12 sm6 class="px-2">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Joueur</v-toolbar-title>
          </v-toolbar>
          <v-card>
            <v-form v-model="valid"
                    ref="form"
                    lazy-validation>
            </v-form>
            <v-card-text :class="{'pt-0 pb-0': $vuetify.breakpoint.smAndDown }">
              <v-text-field
                  label="N° licence"
                  v-model="licence"
                  :clearable="true"
                  :change="licenceId=false"
              ></v-text-field>
              <v-text-field
                  label="Nom"
                  v-model="nomJoueur"
                  :clearable="true"
              ></v-text-field>
              <v-text-field
                  label="Prénom"
                  v-model="prenomJoueur"
                  :clearable="true"
              ></v-text-field>
            </v-card-text>
            <v-card-actions :class="{'pt-0': $vuetify.breakpoint.smAndDown }">

              <v-btn type="submit" :disabled="!valid" @click="submit" block color="primary">
                Rechercher
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
        <v-flex xs12 sm6 class="px-2">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Club</v-toolbar-title>
          </v-toolbar>
          <v-card>
            <v-form v-model="validClub"
                    ref="formClub"
                    lazy-validation></v-form>
            <v-card-text :class="{'pt-0 pb-0': $vuetify.breakpoint.smAndDown }">
              <v-select
                  v-model="zone"
                  :items="listeOrganismesZone"
                  item-text="libelle"
                  item-value="code"
                  label="Zone"
                  return-object
                  single-line
              ></v-select>
              <v-select
                  v-model="ligue"
                  :items="listeOrganismesLigue"
                  item-text="libelle"
                  item-value="code"
                  label="Ligue"
                  return-object
                  single-line
              ></v-select>
              <v-select
                  v-model="departement"
                  :items="listeOrganismesDepartement"
                  item-text="libelle"
                  item-value="code"
                  label="Département"
                  return-object
                  single-line
              ></v-select>
              <v-text-field
                  label="Numero"
                  v-model="clubId"
                  :clearable="true"
              ></v-text-field>
            </v-card-text>
            <v-card-actions :class="{'pt-0': $vuetify.breakpoint.smAndDown }">

              <v-btn type="submit" :disabled="!validClub" @click="submitClub" block color="primary">
                Rechercher
              </v-btn>
            </v-card-actions>

          </v-card>
        </v-flex>
      </v-layout>

      <v-layout row v-if="loadingListeJoueurs">
        <v-flex xs12 class="secondary pa-3"><h1 class="text-xs-center white--text text-uppercase">
          Chargement de la liste des joueurs</h1>
          <v-progress-linear :indeterminate="true" color="error"
                             height="10"
                             value="75"></v-progress-linear>
        </v-flex>
      </v-layout>

      <v-layout wrap class="pb-2" v-if="listeJoueurs">
        <v-flex xs12 v-if="clubDetail" :class="$vuetify.breakpoint.smAndDown ? 'pb-2' : 'pa-2'">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>{{ clubDetail.nom }}</v-toolbar-title>
          </v-toolbar>
          <v-card>
            <v-card-text>{{ clubDetail.siteWeb }}</v-card-text>
          </v-card>
        </v-flex>

        <v-flex xs12 :class="$vuetify.breakpoint.smAndDown ? 'pb-2' : 'pa-2'">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Liste des joueurs</v-toolbar-title>
          </v-toolbar>
          <v-card>
            <v-card-text style="padding: 0;">
              <v-data-table
                  :headers="headersListeJoueurs"
                  :items="listeJoueurs"
                  hide-actions
                  no-data-text="Chargement en cours"
                  class="elevation-1 white"
                  style="width: 100%;"
              >
                <template slot="items" slot-scope="props">
                  <td class="text-xs-left">{{props.item.nom}}</td>
                  <td class="text-xs-left">{{props.item.prenom}}</td>
                  <td class="text-xs-center">{{props.item.licence}}</td>
                  <td class="text-xs-center">{{props.item.points}}</td>
                  <td class="text-xs-left">{{props.item.club}}</td>
                  <td class="text-xs-center">
                    <v-btn @click="selectTr(props.item.licence)"
                           slot="activator">
                      <v-icon color="blue">mdi-eye</v-icon>
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

      <JoueurDetail :licenceId="licence" v-if="licenceId"/>

      <v-layout row v-if="loadingListeClubs">
        <v-flex xs12 class="secondary pa-3"><h1 class="text-xs-center white--text text-uppercase">
          Chargement du ou des clubs</h1>
          <v-progress-linear :indeterminate="true" color="error"
                             height="10"
                             value="75"></v-progress-linear>
        </v-flex>
      </v-layout>

      <v-layout wrap class="pb-2" v-if="listeClubs">
        <v-flex xs12 :class="$vuetify.breakpoint.smAndDown ? 'pb-2' : 'pa-2'">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Liste des Clubs</v-toolbar-title>
          </v-toolbar>
          <v-card>
            <v-card-text style="padding: 0;">
              <v-data-table
                  :headers="headersListeClubs"
                  :items="listeClubs"
                  hide-actions
                  no-data-text="Chargement en cours"
                  class="elevation-1 white"
                  style="width: 100%;"
              >
                <template slot="items" slot-scope="props">
                  <td class="text-xs-left">{{props.item.nom}}</td>
                  <td class="text-xs-left">{{props.item.numero}}</td>
                  <td class="text-xs-left">
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
                    </v-layout></td>
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
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import ApiService from '@/services/api'
import OrganismeModel from '@/api/model/organisme'
import ClubModel from '@/api/model/club'
import ClubDetailModel from '@/api/model/clubDetail'
import JoueurDetailModel from '@/api/model/joueurDetail'
import RechercheByNomModel from '@/api/model/rechercheByNom'
import FfttResource from '@/api/resources/fftt'
import { GetterAuth } from '@/store/auth'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import JoueurDetail from '@/components/competition/JoueurDetail.vue'
import { RawLocation } from 'vue-router'

@Component({ components: { Banner, JoueurDetail } })
export default class Recherche extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @Inject()
  ffttResource: FfttResource

  @Inject()
  api: ApiService

  @MutationSnackbar
  setSnackbarEntry: (entry: SnackbarEntry) => void

  @MutationSnackbar
  clearSnackbarEntry: () => void

  @GetterAuth
  authenticated: boolean

  listeJoueurs: JoueurDetailModel[] | null = null
  valid: boolean = true
  validClub: boolean = true
  licence: string = ''
  licenceId: boolean = false
  nomJoueur: string = ''
  prenomJoueur: string = ''
  rechercheByNom: RechercheByNomModel | null = null
  clubId: string = ''
  clubDetail: ClubDetailModel | null = null
  zone: any = { code: '', libelle: '' }
  ligue: any = { code: '', libelle: '' }
  departement: any = { code: '', libelle: '' }
  listeClubs: ClubModel[] | null = null
  listeOrganismesZone: OrganismeModel[] | null = null
  listeOrganismesLigue: OrganismeModel[] | null = null
  listeOrganismesDepartement: OrganismeModel[] | null = null

  //  Variables de la table
  loadingListeJoueurs: boolean = false
  headersListeJoueurs: any[] = [
    { text: 'Nom', align: 'left', value: 'nom', sortable: true },
    { text: 'Prénom', align: 'left', value: 'prenom', sortable: true },
    { text: 'Licence', align: 'center', value: 'licence', sortable: true },
    { text: 'Classemement', align: 'center', value: 'points', sortable: true },
    { text: 'Club', align: 'left', value: 'club', sortable: true },
    { text: 'Action', align: 'center', value: 'action', sortable: true }
  ]

  loadingListeClubs: boolean = false
  headersListeClubs: any[] = [
    { text: 'Nom', align: 'left', value: 'nom', sortable: true },
    { text: 'Numero', align: 'left', value: 'numero', sortable: true },
    { text: 'Action', align: 'left', value: '', sortable: false }
  ]

  async mounted () {
    if (!this.authenticated) {
      this.$router.push({ name: 'Home' })
    }
    if (this.$route.params.nomJoueur && this.$route.params.prenomJoueur) {
      this.nomJoueur = this.$route.params.nomJoueur
      this.prenomJoueur = this.$route.params.prenomJoueur
      await this.submit()
    }

    this.listeOrganismesZone = await this.ffttResource.Organismes('Z')
    this.listeOrganismesLigue = await this.ffttResource.Organismes('L')
    this.listeOrganismesDepartement = await this.ffttResource.Organismes('D')
  }

  async submit () {

    if ((this.$refs.form as any).validate()) {
      this.licenceId = false
      this.listeJoueurs = null
      if (this.licence !== '') {
        this.licenceId = true
      } else if (this.nomJoueur || this.prenomJoueur) {
        console.log('submit2')
        this.loadingListeJoueurs = true
        const tofind = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ'
        // const tofind = ['À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'à', 'á', 'â', 'ã', 'ä', 'å', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'È', 'É', 'Ê', 'Ë', 'è', 'é', 'ê', 'ë', 'Ç', 'ç', 'Ì', 'Í', 'Î', 'Ï', 'ì', 'í', 'î', 'ï', 'Ù', 'Ú', 'Û', 'Ü', 'ù', 'ú', 'û', 'ü', 'ÿ', 'Ñ', 'ñ']
        const replac = 'AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn'
        // const replac = ['A', 'A', 'A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a', 'a', 'O', 'O', 'O', 'O', 'O', 'O', 'o', 'o', 'o', 'o', 'o', 'o', 'E', 'E', 'E', 'E', 'e', 'e', 'e', 'e', 'C', 'c', 'I', 'I', 'I', 'I', 'i', 'i', 'i', 'i', 'U', 'U', 'U', 'U', 'u', 'u', 'u', 'u', 'y', 'N', 'n']
        // Convertir avant les accent
        this.rechercheByNom = new RechercheByNomModel()
        this.rechercheByNom.nom = this.nomJoueur.replace(tofind, replac)
        this.rechercheByNom.prenom = this.prenomJoueur.replace(tofind, replac)
        this.listeJoueurs = await this.ffttResource.joueursByNom(this.rechercheByNom)
        this.loadingListeJoueurs = false
      }

      if (this.listeJoueurs !== null && this.listeJoueurs.length === 1) {
        this.licence = '' + this.listeJoueurs[0]['licence']
      }
    }
  }

  async submitClub () {
    if (this.departement.code) {
      this.loadingListeClubs = true
      this.listeClubs = await this.ffttResource.ClubsByDepartement(this.departement.code)
      this.loadingListeClubs = false
    } else if (this.clubId) {
      this.clubDetail = await this.ffttResource.clubdetail(this.clubId)
      this.listeJoueurs = await this.ffttResource.joueursDetailsByClub(this.clubId)
    }
    this.loadingListeClubs = false
  }

  selectTr (licence: string) {
    console.log('selectTr' + this.licenceId + licence)
    this.licence = licence
    this.licenceId = true
    console.log('selectTr' + this.licenceId + this.licence)
  }

  statistiqueClubId (clubId: any) {
    this.$router.push({ name: 'Statistiques', params: { clubId: clubId } } as RawLocation)
  }

  equipeClubId (clubId: any) {
    this.$router.push({ name: 'Equipe', params: { clubId: clubId } } as RawLocation)
  }
}
</script>
