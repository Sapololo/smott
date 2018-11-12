<template>
  <div class="ecritures">
    <v-dialog v-model="dialog" max-width="100%"
              :fullscreen="$vuetify.breakpoint.smAndDown"
              :transition="$vuetify.breakpoint.smAndDown ? 'dialog-bottom-transition' : 'dialog-transition'"
              @keydown.esc="cancelDialog()" :persistent="true">
      <v-card>
        <v-card-title class="primary elevation-1">
          <v-icon dark class="pr-2">mdi-account-plus</v-icon>
          <span class="headline white--text">{{ dialogEcrTitle }}</span>
        </v-card-title>
        <v-form @submit.prevent="submit" v-model="valid" ref="form" lazy-validation>
          <v-card-text>
            <v-container fluid grid-list-md>
              <v-layout row>
                <v-flex xs3>
                  <v-date-picker v-model="dtecr" format="DD-MM-YYYY" locale="fr-FR"></v-date-picker>
                </v-flex>
                <v-flex xs3>
                  <v-radio-group v-model="row" row>
                    <v-radio label="Débit" value="debit"></v-radio>
                    <v-radio label="Crédit" value="credit"></v-radio>
                  </v-radio-group>
                  <hr>
                  <v-autocomplete
                      :items="filteredRubriques()"
                      label="Rubriques"
                      item-text="titre"
                      return-object
                      v-model="dialogEcr.rubrique"
                      single-line
                      :clearable="true"
                      hide-details
                  ></v-autocomplete>
                  <v-autocomplete
                      :items="typePaiement"
                      label="Type paiement"
                      item-text="description"
                      return-object
                      v-model="dialogEcr.type"
                      single-line
                      :clearable="true"
                      hide-details
                  ></v-autocomplete>

                  <v-text-field
                      label="N° Pièce"
                      v-model="dialogEcr.pieceId"
                  ></v-text-field>
                  <v-text-field label="Montant"
                                v-model="dialogEcr.montant"
                  ></v-text-field>
                </v-flex>
                <v-flex xs6>
                  <v-text-field
                      label="Désignation"
                      v-model="dialogEcr.designation"
                      required
                  ></v-text-field>
                  <v-text-field
                      label="Commentaire"
                      v-model="dialogEcr.commentaire"
                      required
                  ></v-text-field>
                  <v-text-field v-if="dialogEcr.type && dialogEcr.type.id === 1"
                                label="Numéro Chéque"
                                v-model="dialogEcr.numChq"
                  ></v-text-field>
                  <v-text-field v-if="dialogEcr.type && dialogEcr.type.id === 1 && row === 'credit'"
                                label="Titulaire"
                                v-model="dialogEcr.titulaire"
                  ></v-text-field>
                  <v-text-field v-if="dialogEcr.type && dialogEcr.type.id === 1 && row === 'credit'"
                                label="Banque"
                                v-model="dialogEcr.titulaireBanque"
                  ></v-text-field>
                </v-flex>
              </v-layout>
            </v-container>
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
        <v-toolbar-title>Ecritures Banquaire</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items>
          <div class="text-xs-center">
            <v-tooltip bottom>
              <v-btn slot="activator" icon>
                <v-icon color="white" @click="dialogEditEcr=true;editEcriture(-1)">mdi-plus</v-icon>
              </v-btn>
              <span>Ajout Ecriture</span>
            </v-tooltip>
          </div>
        </v-toolbar-items>
      </v-toolbar>

      <v-card>
        <v-data-table
            :headers="headers"
            :items="ecrituresCalcul"
            hide-actions
            :loading="loading"
            no-data-text="Chargement en cours"
            class="elevation-1 white"
        >
          <template slot="items" slot-scope="props">
            <td>
              <v-layout justify-center>{{ props.item.dtecr | moment('DD/MM/YYYY') }}</v-layout>
            </td>
            <td>
              <v-layout justify-left>{{ props.item.rubrique.code }} - {{ props.item.rubrique.titre }}
              </v-layout>
            </td>
            <td class="text-xs-left">
              <span v-if="props.item.designation"
                    class="body-2 text-capitalize">{{ props.item.designation }}</span>
              <span v-if="!props.item.user.isArray && props.item.user.length != 0"
                    class="body-2 text-capitalize"> - {{ props.item.user.lastname }} {{ props.item.user.firstname }}</span><br/>
              <span v-if="props.item.commentaire" class="caption">{{ props.item.commentaire }}</span>
              <span v-if="props.item.type.id === 1" class="caption">CHEQUE {{ props.item.titulaireBanque }} {{ props.item.numChq }} - {{ props.item.titulaire }}</span>
            </td>
            <td>
              <v-layout justify-left v-if="props.item.pieceId !== 0">{{ props.item.pieceId }}</v-layout>
            </td>
            <td>
              <v-layout justify-center class="red--text subheading" v-if="props.item.debit">{{
                props.item.debit }}€
              </v-layout>
            </td>
            <td>
              <v-layout justify-center class="blue--text subheading" v-if="props.item.credit">{{
                props.item.credit }}€
              </v-layout>
            </td>
            <td>
              <v-layout justify-center class="subheading" v-if="props.item.banque">{{
                props.item.banque.toFixed(2) }}€
              </v-layout>
            </td>
            <td>
              <v-layout justify-center class="subheading" v-if="props.item.espece">{{
                props.item.espece.toFixed(2) }}€
              </v-layout>
            </td>
            <td class="justify-center">
              <v-layout justify-end>
                <v-tooltip bottom>
                  <v-btn icon @click="editEcriture(props.index)" right
                         slot="activator">
                    <v-icon color="teal">mdi-pencil</v-icon>
                  </v-btn>
                  <span>Modifier écriture</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-btn icon @click="copyEcriture(props.index)" right
                         slot="activator">
                    <v-icon color="orange">mdi-content-copy</v-icon>
                  </v-btn>
                  <span>Dupliquer écriture</span>
                </v-tooltip>
              </v-layout>
            </td>
          </template>
          <!--<template slot="no-data">-->
          <!--<v-btn color="primary" @click="initialize">Rafraîchir</v-btn>-->
          <!--</template>-->
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
import EcritureModel, { EcritureCalculModel } from '@/api/model/ecriture'
import ecrRubriqueModel from '@/api/model/ecrRubrique'
import ecrTypeModel from '@/api/model/ecrType'
import EcritureResource from '@/api/resources/ecriture'
import ApiService from '@/services/api'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import { RawLocation } from 'vue-router'
import cloneDeep from 'lodash/cloneDeep'
import forEach from 'lodash/forEach'

@Component({ components: { Banner } })
export default class Ecritures extends Vue {
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

  ecritures: EcritureModel[] = []
  ecrRubriques: ecrRubriqueModel[] = []
  ecrituresCalcul: EcritureCalculModel[] = []
  dateFormatted: any | null = null
  menu1: boolean = false
  typePaiement: ecrTypeModel[] = []
  // typePaiement: any[] = [
  //   { id: 1, titre: 'Chéque' },
  //   { id: 2, titre: 'Prélévement' },
  //   { id: 3, titre: 'Virement' },
  //   { id: 4, titre: 'Chéque Vacances' },
  //   { id: 5, titre: 'Espéce' },
  //   { id: 6, titre: 'CB' }
  // ]

  // Variables de la boite de dialog
  valid: boolean = false
  dialog: boolean = false
  dialogEditEcr: boolean = false
  dialogEcrTitle: string = ''
  dialogIndex: number = -1
  row: string = 'debit'
  datestring: string = ''

  //  Variables d'ajout écriture
  dialogEcr: EcritureModel = new EcritureModel()

  //  Variables de la table
  loading: boolean = true
  headers: any[] = [
    { text: 'DATE', align: 'center', value: 'dtecr', sortable: false },
    { text: 'CLASSE', align: 'center', value: 'code', sortable: false },
    { text: 'DESIGNATION / ADHERENT / COMMENTAIRE', align: 'center', value: '', sortable: false },
    { text: 'PIECE', align: 'center', value: 'pieceId', sortable: false },
    { text: 'DEBIT', align: 'center', value: 'debit', sortable: false },
    { text: 'CREDIT', align: 'center', value: 'credit', sortable: false },
    { text: 'BANQUE', align: 'center', value: 'banque', sortable: false },
    { text: 'ESPECE', align: 'center', value: 'espece', sortable: false },
    { text: 'ACTION', align: 'center', sortable: false }
  ]

  async submit () {
    if ((this.$refs.form as any).validate()) {
      try {
        this.loading = true
        const data = this.ecritures
        // Vérification si c'est une création ou édition, ou password
        if (this.dialogIndex < 0) {
          await this.ecritureResource.createEcriture(this.dialogEcr)
          this.setSnackbarEntry({
            color: 'success',
            icon: 'mdi-account-plus',
            message: `Création de l'écriture a été effectuée !`
          })
          // data.push(this.dialogEcr)
        } else {
          if (this.dialogEcr.id !== null) {
            await this.ecritureResource.saveEcriture(this.dialogEcr)
            this.setSnackbarEntry({
              color: 'success',
              icon: 'mdi-update',
              message: `Mise(s) à jour de l'écriture effectuée(s)`
            })
            const index = data.findIndex(i => i.id === this.dialogEcr.id)
            data.splice(index, 1, this.dialogEcr)
          }
        }
      } finally {
        this.dialog = false
        this.dialogIndex = -1
        this.dialogEditEcr = false
        this.dialogEcr = new EcritureModel()
        this.loading = false
        // await this.loadEcritures()
      }
    }
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
      if (this.$route.params.rubrique) {
        this.ecritures = await this.ecritureResource.ecrituresRubrique(this.$route.params.rubrique)
      } else {
        this.ecritures = await this.ecritureResource.ecritures()
      }
      this.typePaiement = await this.ecritureResource.ecrTypes()
      this.ecrRubriques = await this.ecritureResource.ecrRubriques()
      return this.loadEcritures()
    }
  }

  async loadEcritures () {
    this.loading = true
    this.ecrituresCalcul = []
    let banque: number = 4423.21
    let espece: number = 92.24
    forEach(this.ecritures, (item, key) => {
      let row = new EcritureCalculModel()
      row = item
      if (item.montant) {
        console.log('banque' + banque + 'montant' + item.montant)
        if (item.rubrique && item.rubrique.id > 49) {
          row.debit = item.montant
          // if (item.type !== null && item.type !== 'undefined' && item.type.id !== 'undefined' && item.type.id === 5) {
          //   espece -= item.montant
          // } else {
          banque = (banque - item.montant)
          // }
        } else {
          row.credit = item.montant
          // if (item.type !== null && item.type !== 'undefined' && item.type.id !== 'undefined' && item.type.id === 5) {
          //   espece = (espece + item.montant)
          // } else {
          banque = (banque + item.montant)
          // }
        }
        // if (item.paiementId === 5) {
        //   row.espece = espece
        // } else {
        //   row.banque = banque
        // }
      }
      banque = Math.round(banque * 100) / 100
      row.banque = banque
      this.ecrituresCalcul.push(row)
    })
    this.loading = false
  }

  cancelDialog () {
    this.dialog = false
    this.dialogEditEcr = false
    this.dialogEcr = new EcritureModel()
  }

  editEcriture (index: number) {
    // Gestion des l'index de la ligne
    this.dialogIndex = index

    // Gestion du titre création si bouton ajouter
    if (this.dialogIndex === -1) {
      this.dialogEcrTitle = 'Création Ecriture'
      this.dialogEcr = new EcritureModel()
    } else {
      this.dialogEcr = cloneDeep(this.ecritures[index])
      // if (ecr !== undefined) {
      //   this.dialogEcr = ecr
      // }
      this.dialogEcrTitle = 'Modification Ecriture'
    }
    this.dialog = true
  }

  copyEcriture (index: number) {
    this.dialogEcr = cloneDeep(this.ecritures[index])
    this.dialogEcr.id = null
    this.dialogEcrTitle = 'Dupliquer Ecriture'
    this.dialog = true
  }

  get dtecr (): string | undefined {
    if (!this.dialogEcr.dtecr) return undefined
    return this.dialogEcr.dtecr.split(' ')[0]
  }

  set dtecr (value: string | undefined) {
    this.dialogEcr.dtecr = value
    // this.dialogEcr.dtecr = value ? value : undefined
  }

  filteredRubriques () {
    if (this.row === 'debit') {
      return this.ecrRubriques.filter(item => {
        return item.id >= 50
      })
    } else {
      return this.ecrRubriques.filter(item => {
        return item.id < 50
      })
    }
  }

  // round (value: number, decimals: number) {
  //   return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals)
  // }
}
</script>
