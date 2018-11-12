<template>
  <div class="ecritures-adherent">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-toolbar flat dense color="primary">
        <v-toolbar-title>Ecritures par adhérent</v-toolbar-title>
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
export default class EcrituresAdherent extends Vue {
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
      if (this.$route.params.licenceId) {
        this.ecritures = await this.ecritureResource.ecrituresAdherent(this.$route.params.licenceId)
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
}
</script>
