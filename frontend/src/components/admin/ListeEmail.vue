<template>
  <div class="liste-email">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>

      <v-toolbar flat dense color="primary">
        <v-toolbar-title>Liste des emails</v-toolbar-title>
      </v-toolbar>

      <slot v-if="loading" transition="fade" name="loading-content">
        <v-flex xs12 class="secondary pa-3">
          <h1 class="text-xs-center white--text text-uppercase">Chargement des emails</h1>
          <v-progress-linear :indeterminate="true" color="error"
                             height="10"
                             value="75"></v-progress-linear>
        </v-flex>
      </slot>
      <v-card v-else>
        <v-card-text>
          <v-form @submit.prevent="submit" v-model="valid" ref="form" lazy-validation>
            <v-layout row>
              <v-flex xs4>
                <v-container fluid>
                  <v-select
                      :items="types"
                      v-model="type"
                      item-text="text"
                      menu-props="auto"
                      hide-details
                      label="Recherche"
                      return-object
                      single-line></v-select>
                </v-container>
              </v-flex>
              <v-flex skrink>
                <v-btn type="submit" :disabled="!valid" block color="secondary">Lister</v-btn>
              </v-flex>
            </v-layout>

          </v-form>
          <span shrink :key="i"
                v-for="(item,i) in users">"{{ item.firstName }} {{ item.lastName }}" {{ item.email }}, </span>
        </v-card-text>
      </v-card>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Inject, Vue } from 'vue-property-decorator'
import { GetterAuth, Payload, StateAuth } from '@/store/auth'
import UserModel from '@/api/model/user'
import UserResource from '@/api/resources/user'
import ApiService from '@/services/api'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import { RawLocation } from 'vue-router'

@Component({ components: { Banner } })
export default class ListeEmail extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @Inject()
  userResource: UserResource

  @Inject()
  api: ApiService

  @GetterAuth
  authenticated: boolean

  @StateAuth
  payload: Payload | Payload

  @MutationSnackbar
  setSnackbarEntry: (entry: SnackbarEntry) => void

  users: UserModel[] = []
  valid: boolean = false
  types: any[] = [
    { id: 1, text: 'TOUT' },
    { id: 2, text: 'TJL' },
    { id: 3, text: 'STAGE' },
    { id: 4, text: 'FEMME' },
    { id: 5, text: 'HOMME' },
    { id: 6, text: 'PROMO' },
    { id: 7, text: 'TRADI' }
  ]
  type: any = { id: 1, text: 'TOUT' }

  //  Variables
  loading: boolean = true

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
      return this.loadUsers()
    }
  }

  async submit () {
    if ((this.$refs.form as any).validate()) {
      return this.loadUsers()
    }
  }

  async loadUsers () {
    this.loading = true
    this.users = await this.userResource.usersBy(this.type.id)
    this.loading = false
  }
}
</script>
