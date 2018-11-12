<template>
  <div class="modifier-mot-de-passe">
    <div class="row main-wrapper"
         :class="$vuetify.breakpoint.smAndDown ? 'main-wrapper-mobile' : 'main-wrapper-desktop'">
      <v-layout row justify-center>
        <v-flex xs12 sm6>
          <v-card class="elevation-5">
            <v-form @submit.prevent="submit" v-model="valid" ref="form" lazy-validation>
              <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin primary py-4"><h1>Réinitialisation du mot de passe</h1></span>
              </v-card-title>
              <v-card-text :class="{'pt-0 pb-0': $vuetify.breakpoint.smAndDown }">
                <v-text-field
                    label="Nouveau mot de passe"
                    v-model="password"
                    required
                    :rules="[dialogPassword => !!dialogPassword || 'Veuillez saisir votre mot de passe']"
                    :append-icon="dialogPassword ? 'visibility' : 'visibility_off'"
                    :append-icon-cb="() => (dialogPassword = !dialogPassword)"
                    :type="dialogPassword ? 'password' : 'text'"
                ></v-text-field>
                <v-text-field
                    label="Confirmation du mot de passe"
                    v-model="passwordConfirmation"
                    required
                    :rules="[checkPasswordConf]"
                    :append-icon="dialogPasswordConfirmation ? 'visibility' : 'visibility_off'"
                    :append-icon-cb="() => (dialogPasswordConfirmation = !dialogPasswordConfirmation)"
                    :type="dialogPasswordConfirmation ? 'password' : 'text'"
                ></v-text-field>
              </v-card-text>
              <v-card-actions :class="{'pt-0': $vuetify.breakpoint.smAndDown }">

                <v-btn type="submit" :disabled="!valid" block color="primary">
                  Enregistrer
                </v-btn>
              </v-card-actions>
            </v-form>
          </v-card>
        </v-flex>
      </v-layout>
      <v-layout row justify-center>
        <v-flex xs12 sm6 lg3>
          <v-progress-linear v-if="waiting" :indeterminate="true"></v-progress-linear>
        </v-flex>
      </v-layout>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Inject, Vue } from 'vue-property-decorator'
import { GetterAuth, Payload, StateAuth } from '@/store/auth'
import ApiService from '@/services/api'
import { RawLocation } from 'vue-router'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import UserResource from '@/api/resources/user'

@Component
export default class ModifierMotDePasse extends Vue {
  @Inject()
  userResource: UserResource

  @Inject()
  api: ApiService

  @GetterAuth
  authenticated: boolean

  @StateAuth
  payload: Payload | Payload

  waiting: boolean = false
  passwordConfirmation: string = ''
  password: string = ''
  oldpassword: string = ''
  dialogPassword: boolean = true
  dialogPasswordConfirmation: boolean = true
  valid: boolean = false

  @MutationSnackbar
  setSnackbarEntry: (entry: SnackbarEntry) => void

  async submit () {
    if ((this.$refs.form as any).validate()) {
      this.valid = false
      this.waiting = true
      console.log(this.password)
      await this.userResource.saveUserPassword(this.password)

      this.setSnackbarEntry({
        color: 'success',
        message: 'Le mot passe a été mis à jour.'
      })
      //  Ecriture de message de réussite
      this.waiting = false
      this.$router.push({ name: 'Home' })
    }
  }

  checkPasswordConf (v: string) {
    return v === this.password || 'Le mot passe et la confirmation ne sont pas identiques'
  }

  created () {
    const token = (this.$route.params as any).token
    if ((this.$route.params as any).token) {
      try {
        this.api.setTokens(token)
      } catch (err) {
        // TODO: Afficher un message token non reconnu
      }
    }
  }

  async mounted () {
    if (!this.authenticated || (this.$route.params as any).token === undefined) {
      this.setSnackbarEntry({
        color: 'error',
        message: 'Vous pouvez pas accéder à cette page !'
      })
      this.$router.push({ name: 'Home' } as RawLocation)
    }
  }
}
</script>

<style scoped>
h1 {
  text-transform: uppercase;
  -webkit-box-flex: 1;
  -ms-flex: 1 1 auto;
  flex: 1 1 auto;
}

.modifier-mot-de-passe > #app {
  background-color: #212121 !important;
}

.modifier-mot-de-passe > #app::before {
  content: '';
  background-size: cover;
  background: url('../../assets/oison-login-bg.jpg') no-repeat center center;
  position: absolute;
  left: 0;
  top: 0;
  height: 100vh;
  width: 100vw;
  opacity: .5;
}
</style>
