<template>
  <div class="adherents">
    <v-dialog v-model="dialog" max-width="1000px"
              :fullscreen="$vuetify.breakpoint.smAndDown"
              :transition="$vuetify.breakpoint.smAndDown ? 'dialog-bottom-transition' : 'dialog-transition'"
              @keydown.esc="cancelDialog()" :persistent="true">
      <v-toolbar flat color="primary">
        <v-toolbar-title style="width: 100%">
          <v-icon dark class="pr-2">mdi-account-plus</v-icon>
          <span class="headline white--text">{{ dialogAdherentTitle }}</span><br/>
          <span class="subheading white--text">{{ dialogAdherent.nom }}, {{ dialogAdherent.prenom }} - {{ dialogAdherent.licenceId }}</span>
        </v-toolbar-title>
        <v-spacer/>
        <v-btn icon @click="cancelDialog()">
          <v-icon color="white">mdi-close</v-icon>
        </v-btn>
      </v-toolbar>
      <v-card>
        <v-form @submit.prevent="submit" v-model="valid" ref="form" lazy-validation>
          <v-card-text>
            <v-layout>
              <v-flex xs4>
                <v-container fluid>
                  <v-text-field v-if="dialogEditAdherent"
                                label="Numéro"
                                v-model="dialogAdherent.numero"
                  ></v-text-field>
                  <v-text-field v-if="dialogEditAdherent"
                                label="Type voie"
                                v-model="dialogAdherent.voie"
                  ></v-text-field>
                  <v-text-field v-if="dialogEditAdherent"
                                label="Nom voie"
                                v-model="dialogAdherent.rue"
                  ></v-text-field>
                  <v-autocomplete
                      :items="villes"
                      label="Ville"
                      item-text="ville"
                      return-object
                      v-model="dialogAdherent.ville"
                      single-line
                      autocomplete
                      auto
                      :clearable="true"
                      hide-details
                  ></v-autocomplete>
                </v-container>
              </v-flex>
              <v-flex xs4>
                <v-container fluid>
                  <v-text-field v-if="dialogEditAdherent"
                                label="Personnel"
                                v-model="dialogAdherent.perso"
                  ></v-text-field>
                  <v-text-field v-if="dialogEditAdherent"
                                label="Portable"
                                v-model="dialogAdherent.portable"
                  ></v-text-field>
                  <v-text-field v-if="dialogEditAdherent"
                                label="Professionnel"
                                v-model="dialogAdherent.prof"
                  ></v-text-field>
                  <v-text-field v-if="dialogEditAdherent"
                                label="Responsable"
                                v-model="dialogAdherent.resp"
                  ></v-text-field>
                </v-container>
              </v-flex>
              <v-flex xs4>
                <v-container fluid>
                  <v-switch label="Stage" color="primary" v-model="dialogAdherent.stage"></v-switch>
                  <v-switch label="Tjl" color="primary" v-model="dialogAdherent.tjl"></v-switch>
                </v-container>
              </v-flex>
            </v-layout>

            <small>*champs obligatoires</small>
          </v-card-text>

          <v-card-actions>
            <v-btn color="blue darken-1" flat="flat"
                   @click="cancelDialog()">
              Fermer
            </v-btn>
            <v-btn type="submit" :disabled="!valid" block color="primary">Sauvegarder</v-btn>
            <v-flex xs12 sm6 lg3>
              <v-progress-linear v-if="loading" :indeterminate="true"></v-progress-linear>
            </v-flex>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>

      <v-toolbar flat dense color="primary">
        <v-toolbar-title>Liste des adhérents</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-tooltip bottom>
          <v-btn slot="activator" icon dark @click="initVirtualPointAdherents()">
            <v-icon>mdi-animation-play</v-icon>
          </v-btn>
          <span>Mise à jour des points virtuels</span>
        </v-tooltip>
      </v-toolbar>

      <v-card>
        <v-data-table
            :headers="headers"
            :items="adherents"
            hide-actions
            :loading="loading"
            no-data-text="Chargement en cours"
            class="elevation-1 white administrer-utilisateur"
        >
          <!-- <template slot="headers" scope="props">

              <tr>
                  <th v-for="header in props.headers">
                      <v-text-field flat
                                    append-icon="search"
                                    :label="header.text"
                                    single-line
                                    hide-details
                                    :v-model="header.search"
                                    hide-headers
                      ></v-text-field>
                  </th>
              </tr>
          </template> -->
          <template slot="items" slot-scope="props">
            <tr @click="props.expanded = !props.expanded">
              <td class="transform-name">{{ props.item.nom }}</td>
              <td class="transform-firstname">{{ props.item.prenom }}</td>
              <td class="text-xs-center transform-firstname">{{ props.item.type }}</td>
              <td class="text-xs-center">{{ props.item.licenceId }}</td>
              <td class="text-xs-center">
                <v-icon color="blue" v-if="props.item.isHomme">mdi-gender-male</v-icon>
                <v-icon color="pink" v-if="!props.item.isHomme">mdi-gender-female</v-icon>
              </td>
              <td class="text-xs-center">
                <v-icon color="green" v-if="props.item.stage">mdi-checkbox-marked-circle-outline</v-icon>
              </td>
              <td class="text-xs-center">
                <v-icon color="green" v-if="props.item.tjl">mdi-checkbox-marked-circle-outline</v-icon>
              </td>
              <td class="justify-center">
                <v-layout justify-end>

                  <v-tooltip bottom>
                    <v-btn icon v-if="props.item.adherentname != payload.adherentname" right
                           @click="deleteAdherent(props.item)"
                           slot="activator">
                      <v-icon color="red">mdi-account-off</v-icon>
                    </v-btn>
                    <span>Suppression de "{{ props.item.nom }}, {{ props.item.prenom }}"</span>
                  </v-tooltip>
                  <v-tooltip bottom>
                    <v-btn icon
                           @click="dialogAdherentPassword=true;editAdherenteditAdherent(props.index, props.item)"
                           right
                           slot="activator">
                      <v-icon color="blue">mdi-lock-reset</v-icon>
                    </v-btn>
                    <span>Réinitialisation du mot de passe de "{{ props.item.nom }}, {{ props.item.prenom }}"</span>
                  </v-tooltip>
                  <v-tooltip bottom>
                    <v-btn icon
                           @click="dialogEditAdherent=true;editAdherent(props.index, props.item)"
                           right
                           slot="activator">
                      <v-icon color="teal">mdi-account-edit</v-icon>
                    </v-btn>
                    <span>Modifier "{{ props.item.nom }}, {{ props.item.prenom }}"</span>
                  </v-tooltip>
                </v-layout>
              </td>
            </tr>
          </template>
          <template slot="expand" slot-scope="props">
            <v-card flat>
              <v-card flat="flat" color="grey lighten-4">
                <v-container fill-height grid-list-xl>
                  <v-layout row wrap>
                    <v-flex xs9 style="padding: 0" class="text-xs-left">
                      <v-icon color="blue">mdi-map-marker</v-icon>
                      {{ props.item.numero }} {{ props.item.typeVoie }} {{ props.item.nomVoie }}
                      {{ props.item.ville.id }} {{ props.item.ville.ville }}
                    </v-flex>
                    <v-flex xs3 style="padding: 0" class="text-xs-left">
                      <v-icon
                          color="blue">mdi-at
                      </v-icon>
                      {{ props.item.user.email }}
                    </v-flex>
                    <v-flex xs3 style="padding: 0" class="text-xs-left"><span
                        v-if="props.item.telPerso"><v-icon
                        color="blue">mdi-phone</v-icon> {{ props.item.telPerso }}</span>
                    </v-flex>
                    <v-flex xs3 style="padding: 0" class="text-xs-left"><span
                        v-if="props.item.telPortable"><v-icon
                        color="blue">mdi-cellphone</v-icon> {{ props.item.telPortable }}</span>
                    </v-flex>
                    <v-flex xs3 style="padding: 0" class="text-xs-left"><span
                        v-if="props.item.telProf"><v-icon
                        color="blue">mdi-phone-log</v-icon> {{ props.item.telProf }}</span>
                    </v-flex>
                    <v-flex xs3 style="padding: 0" class="text-xs-left"><span
                        v-if="props.item.telResp"><v-icon
                        color="blue">mdi-phone-plus</v-icon> {{ props.item.telResp }}</span>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card>
            </v-card>
          </template>
          <v-alert slot="no-results" value="true" color="error" icon="warning">
            Votre recherche ne donne aucun résultat.
          </v-alert>
        </v-data-table>
      </v-card>

    </div>
  </div>
</template>

<script lang="ts">
import { Component, Inject, Vue } from 'vue-property-decorator'
import { GetterAuth, Payload, StateAuth } from '@/store/auth'
import AdherentModel from '@/api/model/adherent'
import AdherentResource from '@/api/resources/adherent'
import VilleModel from '@/api/model/ville'
import VilleResource from '@/api/resources/ville'
import cloneDeep from 'lodash/cloneDeep'
import ApiService from '@/services/api'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import { RawLocation } from 'vue-router'

@Component({ components: { Banner } })
export default class Adherents extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @Inject()
  adherentResource: AdherentResource

  @Inject()
  villeResource: VilleResource

  @Inject()
  api: ApiService

  @GetterAuth
  authenticated: boolean

  @StateAuth
  payload: Payload | Payload

  @MutationSnackbar
  setSnackbarEntry: (entry: SnackbarEntry) => void

  adherents: AdherentModel[] = []
  adherent: AdherentModel

  //  Variables de la table
  loading: boolean = true
  headers: any[] = [
    { text: 'Nom', align: 'left', value: 'nom', sortable: true },
    { text: 'Prénom', align: 'left', value: 'prénom', sortable: true },
    { text: 'Type', align: 'center', value: 'type', sortable: false },
    { text: 'Licence', align: 'center', value: 'licenceId', sortable: false },
    { text: 'Sexe', align: 'center', value: 'isHomme', sortable: true },
    { text: 'Stage', align: 'center', value: 'stage', sortable: true },
    { text: 'Tjl', align: 'center', value: 'tjl', sortable: true },
    { text: 'Action', align: 'center', sortable: false }
  ]
  dialog: boolean = false
  dialogEditAdherent: boolean = false
  // dialogAdherentPassword: boolean = false
  // dialogpassword: boolean = true
  // dialogEyepassword: boolean = false
  dialogAdherentIcon: string = ''
  dialogAdherentTitle: string = ''
  dialogIndex: number = -1
  titleDelete: string = 'Suppression utilisateur'
  messageDelete: string = ''
  listeRoles: any[] = [
    // { value: 'ROLE_USER', text: 'Utilisateur' },
    { value: 'ROLE_BUREAU', text: 'Bureau' },
    { value: 'ROLE_ADMIN', text: 'Administrateur' }
  ]
  dialogEnabled: any[] = [
    { value: true, text: 'Actif' },
    { value: false, text: 'Inactif' }]

  //  Variables d'ajout utilisateur
  dialogAdherent: AdherentModel = new AdherentModel()
  valid: boolean = false
  fAdherent: boolean = false
  fAdherentName: string = ''
  fAdherentNameRules: string = ''
  fEmail: string = ''
  fEmailRules: string = ''
  villes: VilleModel[] = []

  // Gestion des erreurs
  failed: boolean = false
  statusText: string = ''
  messageText: string = ''
  titleText: string = ''
  status: number | null = null

  async submit () {
    if ((this.$refs.form as any).validate()) {
      try {
        this.loading = true
        const data = this.adherents
        // Vérification si c'est une création ou édition, ou password
        // if (this.dialogIndex < 0) {
        // this.dialogAdherent.adherentname = this.dialogAdherent.email
        // await this.adherentResource.createAdherent(this.dialogAdherent)
        // this.setSnackbarEntry({
        //   color: 'success',
        //   icon: 'mdi-account-plus',
        //   message: `Création de l'utilisateur ${this.dialogAdherent.firstName} ${this.dialogAdherent.name} effectuée`
        //   })
        //   data.push(this.dialogAdherent)
        // }
        // else if (this.dialogAdherentPassword) {
        //   this.adherent = await this.adherentResource.changePassword(this.dialogAdherent.adherentname, this.dialogAdherent.password)
        //   this.setSnackbarEntry({
        //     color: 'success',
        //     icon: 'mdi-lock-reset',
        //     message: `Le mot de passe de ${this.dialogAdherent.firstName} ${this.dialogAdherent.lastName} a été modifié`
        //   })
        //       } else {
        await this.adherentResource.saveAdherent(this.dialogAdherent)
        //         this.setSnackbarEntry({
        //           color: 'success',
        //           icon: 'mdi-update',
        //           message: `Mise(s) à jour de l'utilisateur ${this.dialogAdherent.firstName} ${this.dialogAdherent.lastName} effectuée(s)`
        //         })
        //         const index = data.findIndex(i => i.adherentname === this.dialogAdherent.adherentname)
        //         console.log(index)
        //         data.splice(index, 1, this.dialogAdherent)
        // }
      } finally {
        this.dialog = false
        this.dialogEditAdherent = false
        // this.dialogAdherentPassword = false
        this.dialogIndex = -1
        // this.dialogAdherent = new AdherentWithPasswordModel()
        this.loading = false
      }
    }
  }

  getLabelRole (value: any): string | undefined {
    let row = this.listeRoles.findIndex(i => i.value === value)
    if (row >= 0) {
      return this.listeRoles[row].text
    } else {
      return undefined
    }
  }

  editAdherent (index: number, adherent?: AdherentModel) {
    // Gestion des l'index de la ligne
    // if (index !== undefined && index >= 0) {
    this.dialogIndex = index
    // } else {
    //   this.dialogIndex = -1
    // }

    // Gestion du titre création si bouton ajouter
    if (this.dialogIndex === -1) {
      this.dialogAdherentTitle = 'Création Utilisateur'
      this.dialogAdherent = new AdherentModel()
    } else {
      adherent = cloneDeep(adherent)
      if (adherent !== undefined) {
        this.dialogAdherent = adherent
      }
      // if (this.dialogAdherentPassword) {
      //   this.dialogAdherentTitle = 'Modification du mot de passe'
      // } else {
      this.dialogAdherentTitle = 'Modification Utilisateur'
      // }
    }
    this.dialog = true
  }

  async mounted () {
    if (!this.authenticated) {
      this.$router.push({ name: 'Home' } as RawLocation)
      Vue.nextTick(() => {
        this.setSnackbarEntry({
          color: 'error',
          icon: 'mdi-alert-decagram',
          message: `Vous devez être connecté pour accéder à cette page !`
        })
      })
    } else {
      return this.loadAdherents()
    }
  }

  async loadAdherents () {
    this.loading = true
    this.adherents = await this.adherentResource.adherents()
    this.loading = false
    //  Récupération de la liste des villes
    this.villes = await this.villeResource.villes()
  }

  cancelDialog () {
    this.dialog = false
    // this.dialogEditAdherent = false
    // this.dialogAdherentPassword = false
    // this.dialogAdherent = new AdherentWithPasswordModel()
    // this.dialogpassword = true
  }

  async initVirtualPointAdherents () {
    let result = ''
    try {
      result = await this.adherentResource.initVirtualPointAdherents()
      result = await this.adherentResource.updateAdherents()
    } catch (err) {
      result = await this.adherentResource.updateAdherents()
    }
  }
}
</script>
