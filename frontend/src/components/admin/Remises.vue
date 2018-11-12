<template>
  <div class="remises">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-container fluid>
        <v-layout row>
          <v-flex xs2>
            <v-autocomplete
                :items="data"
                label="Date de la remise"
                item-text="text"
                return-object
                v-model="dateRemise"
                single-line
                autocomplete
                :clearable="true"
                hide-details
            ></v-autocomplete>
          </v-flex>
          <v-flex xs2>
            <v-btn @click="voirRemise()" block color="primary">Rechercher</v-btn>
          </v-flex>
        </v-layout>
      </v-container>
      <v-card>
        <v-data-table
            :headers="headers"
            :items="ecritures"
            hide-actions
            :loading="loading"
            no-data-text="Chargement en cours"
            class="elevation-1 white"
            :total-items="totalItems"
        >
          <template slot="items" slot-scope="props">
            <td class="text-xs-left" v-if="props.item.dtecr">{{ props.item.dtecr.date | moment('DD/MM/YYYY') }}</td>
            <td class="text-xs-right title text-capitalize" colspan="2" v-else>{{ props.item.titulaire }}</td>
            <td class="text-xs-left" v-if="props.item.dtecr">
              <span v-if="props.item.designation"
                    class="body-2 text-capitalize">{{ props.item.designation }}<br/></span>
              <span v-if="props.item.commentaire" class="caption">{{ props.item.commentaire }}</span>
              <span v-if="props.item.paiementId === 1" class="caption">CHEQUE {{ props.item.titulaireBanque }} {{ props.item.numChq }} - {{ props.item.titulaire }}</span>
            </td>
            <td class="text-xs-right blue--text subheading" v-if="props.item.montant">{{
              props.item.montant.toFixed(2) }} €
            </td>
          </template>
        </v-data-table>
      </v-card>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Inject, Vue } from 'vue-property-decorator'
import { GetterAuth, Payload, StateAuth } from '@/store/auth'
import RemiseModel from '@/api/model/remise'
import EcritureResource from '@/api/resources/ecriture'
import ApiService from '@/services/api'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import { RawLocation } from 'vue-router'

@Component({ components: { Banner } })
export default class Remises extends Vue {
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

  data: any[] = [
    { id: '2018-06-18', text: '18/06/2018' },
    { id: '2018-07-14', text: '14/07/2018' },
    { id: '2018-09-02', text: '02/09/2018' },
    { id: '2018-09-22', text: '22/09/2018' },
    { id: '2018-10-15', text: '15/10/2018' },
    { id: '2018-10-27', text: '27/10/2018' }
  ]
  dateRemise: any | null = null
  ecritures: RemiseModel[] = []
  totalItems: number = 0

  //  Variables de la table
  loading: boolean = true
  headers: any[] = [
    { text: 'DATE', align: 'center', value: 'dtecr', sortable: false },
    { text: 'DESIGNATION / ADHERENT / COMMENTAIRE', align: 'center', value: '', sortable: false },
    { text: 'CREDIT', align: 'center', value: 'montant', sortable: false }
  ]

  async mounted () {
    if (!this.authenticated) {
      Vue.nextTick(() => {
        this.setSnackbarEntry({
          color: 'error',
          icon: 'mdi-alert-decagram',
          message: `Vous devez être connecté pour voir le détail de ce joueur ! Vous pouvez faire votre demande par mail à stmarceau.tt@free.fr`
        })
      })
      this.$router.push({ name: 'Home' } as RawLocation)
    } else {
      if (this.$route.params.dt) {
        this.dateRemise = this.data.find(o => o.id === this.$route.params.dt)
        return this.voirRemise()
      }
    }
  }

  async voirRemise () {
    this.loading = true
    this.ecritures = await this.ecritureResource.remises(this.dateRemise.id)
    this.loading = false
  }
}
</script>
