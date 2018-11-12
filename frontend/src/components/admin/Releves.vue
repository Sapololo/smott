<template>
  <div class="releves">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>

      <v-toolbar flat dense color="primary">
        <v-toolbar-title>Relevès Banquaire</v-toolbar-title>
      </v-toolbar>

      <v-card>
        <v-data-table
            :headers="headers"
            :items="releves"
            hide-actions
            :loading="loading"
            no-data-text="Chargement en cours"
            class="elevation-1 white"
        >
          <template slot="items" slot-scope="props">
            <td class="justify-center">
              <v-layout justify-center>{{ props.item.dtoperation.date | moment('DD/MM/YYYY') }}</v-layout>
            </td>
            <td class="justify-center">
              <v-layout justify-center>{{ props.item.dtvaleur.date | moment('DD/MM/YYYY') }}</v-layout>
            </td>
            <td class="justify-left">
              <v-layout justify-left>{{ props.item.libelle }}</v-layout>
            </td>
            <td class="text-xs-center subheading red--text">
              <v-layout justify-center v-if="props.item.debit <0">{{ props.item.debit }}€</v-layout>
            </td>
            <td class="text-xs-center subheading blue--text">
              <v-layout justify-center v-if="props.item.credit >0">{{ props.item.credit }}€</v-layout>
            </td>
            <td class="text-xs-center subheading green--text">
              <v-layout justify-center>{{ props.item.solde }}€</v-layout>
            </td>
            <td class="text-xs-center subheading">
              <router-link v-if="!props.item.libelle.indexOf('REM CHQ N',0)"
                           :to="{ name: 'Remises', params: { dt: props.item.dtvaleur.date.split(' ')[0] }}">
                <v-btn>
                  <v-icon class="blue--text">mdi-bank-transfer-in</v-icon>
                </v-btn>
              </router-link>
              <v-layout justify-center>{{ props.item.ecritureId }}</v-layout>
            </td>
            <!--<td class="justify-center">-->
            <!--<v-layout justify-center>-->
            <!--<v-tooltip bottom v-if="props.item.rapprochement === '1'">-->
            <!--<v-icon color="green">mdi-chevron-down-box</v-icon>-->
            <!--<span>Actif</span>-->
            <!--</v-tooltip>-->
            <!--<v-tooltip bottom v-else>-->
            <!--<v-btn color="blue">mdi-chevron-down-box</v-btn>-->
            <!--<span>Inactif</span>-->
            <!--</v-tooltip>-->
            <!--</v-layout>-->
            <!--</td>-->
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
import BanqueModel from '@/api/model/banque'
import BanqueResource from '@/api/resources/banque'
import ApiService from '@/services/api'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import { RawLocation } from 'vue-router'
// import moment from 'moment'

@Component({ components: { Banner } })
export default class Releves extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @Inject()
  banqueResource: BanqueResource

  @Inject()
  api: ApiService

  @GetterAuth
  authenticated: boolean

  @StateAuth
  payload: Payload | Payload

  @MutationSnackbar
  setSnackbarEntry: (entry: SnackbarEntry) => void

  releves: BanqueModel[] = []

  //  Variables de la table
  loading: boolean = true
  headers: any[] = [
    { text: 'DATE OPERATION', align: 'center', value: 'dtoperation', sortable: false },
    { text: 'DATE VALEUR', align: 'center', value: 'dtvaleur', sortable: false },
    { text: 'LIBELLE', align: 'center', value: 'libelle', sortable: false },
    { text: 'DEBIT', align: 'center', value: 'debit', sortable: false },
    { text: 'CREDIT', align: 'center', value: 'credit', sortable: false },
    { text: 'SOLDE', align: 'center', value: 'solde', sortable: false },
    { text: 'RAPPRO.', align: 'center', value: 'ecritureId', sortable: false }
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
      return this.loadReleves()
    }
  }

  async loadReleves () {
    this.loading = true
    this.releves = await this.banqueResource.releves()
    this.loading = false
  }
}
</script>
