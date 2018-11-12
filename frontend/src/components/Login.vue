<template>
  <div class="login">
    <v-flex shrink>
      <v-layout row justify-center>
        <v-dialog v-model="dialogMdp" @keydown.esc="onCancel()" max-width="500px"
                  :fullscreen="$vuetify.breakpoint.smAndDown"
                  :transition="$vuetify.breakpoint.smAndDown ? 'dialog-bottom-transition' : 'dialog-transition'">
          <v-card class="elevation-5">
            <v-form @submit.prevent="resetPassword()"
                    v-model="validResetPassword"
                    ref="form"
                    lazy-validation>
              <v-card-title class="primary">
                <span class="headline white--text">Mot de passe oublié</span>
                <v-spacer></v-spacer>
                <v-btn icon dark @click="dialogMdp = false">
                  <v-icon>mdi-close</v-icon>
                </v-btn>
              </v-card-title>
              <v-card-text>
                <p>Entrez votre <strong>adresse email</strong> de connexion.</p>
                <p>Vous allez recevoir sur cette adresse un lien permettant de définir un nouveau mot de
                  passe.</p>
                <v-text-field
                    label="E-mail"
                    type="email"
                    v-model="dialogEmail"
                    :rules="emailRules"
                    required
                ></v-text-field>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn flat color="secondary" @click="onCancel()">
                  Annuler
                </v-btn>
                <v-btn color="primary" type="submit" :disabled="!validResetPassword">
                  Envoyer la demande
                </v-btn>
              </v-card-actions>
            </v-form>
          </v-card>
        </v-dialog>
        <v-dialog v-model="DialogAppLogin" @keydown.esc="setDialogAppLogin(false)"
                  scrollable
                  max-width="500px"
                  persistent
                  :fullscreen="$vuetify.breakpoint.smAndDown"
                  :transition="$vuetify.breakpoint.smAndDown ? 'dialog-bottom-transition' : 'dialog-transition'">
          <v-card class="elevation-5">
            <v-toolbar flat dense dark color="primary">
              <v-toolbar-title>
                <v-icon dark class="pr-2">mdi-login</v-icon>
                <span class="headline white--text">Connexion</span></v-toolbar-title>
              <v-spacer/>
              <v-btn icon @click="setDialogAppLogin(false)">
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </v-toolbar>

            <v-form @submit.prevent="submit"
                    v-model="valid"
                    ref="form"
                    lazy-validation>
              <v-card-text :class="{'pt-0 pb-0': $vuetify.breakpoint.smAndDown }">
                <v-text-field
                    label="Identifiant"
                    v-model="data.username"
                    required
                    type="text"
                ></v-text-field>
                <v-text-field
                    label="Mot de passe"
                    v-model="data.password"
                    required
                    :rules="[v => !!v || 'Veuillez saisir votre mot de passe']"
                    :append-icon="dialogPassword ? 'visibility' : 'visibility_off'"
                    @click:append="() => (dialogPassword = !dialogPassword)"
                    :type="dialogPassword ? 'password' : 'text'"
                ></v-text-field>
                <v-checkbox
                    label="Se souvenir de moi"
                    v-model="data.saveCredentials"
                    hide-details
                    color="primary"
                    class="mx-auto"
                ></v-checkbox>
                <v-layout wrap justify-end>
                  <v-flex class="no-grow" :class="{'pb-2': $vuetify.breakpoint.smAndDown}">
                    <a href @click.prevent="dialogMdp = true;setDialogAppLogin(false)">
                      <span class="text-xs-right text-password-forgotten">Mot de passe oublié</span>
                    </a>
                  </v-flex>
                </v-layout>
              </v-card-text>
              <v-card-actions :class="{'pt-0': $vuetify.breakpoint.smAndDown }">

                <v-btn type="submit" :disabled="!valid" block color="primary">
                  Connexion
                </v-btn>
              </v-card-actions>
            </v-form>
          </v-card>
        </v-dialog>
      </v-layout>
    </v-flex>
  </div>
</template>

<script lang="ts">
import { Component, Inject, Prop, Vue } from 'vue-property-decorator'
import AccessService from '../services/access'
import UserResource from '../api/resources/user'
import { UserEmail } from '@/api/model/user'
import { GetterAuth } from '../store/auth'
import { MutationSnackbar, SnackbarEntry } from '../store/snackbar'
import { GetterDialogApp, MutationDialogApp } from '@/store/dialogApp'

class LoginData {
  username: string = ''
  password: string = ''
  saveCredentials: boolean = true
}

@Component
export default class Login extends Vue {
  @Prop({ default: false })
  dialogLogin: boolean

  @Inject()
  access: AccessService

  @Inject()
  userResource: UserResource

  @GetterAuth
  authenticated: boolean

  @MutationSnackbar
  setSnackbarEntry: (entry: SnackbarEntry) => void

  @MutationSnackbar
  clearSnackbarEntry: () => void

  @MutationDialogApp
  setDialogAppLogin: { (login: boolean): void }

  @GetterDialogApp
  DialogAppLogin: { (login: boolean): void }

  email: UserEmail
  data: LoginData = new LoginData()
  waiting: boolean = false
  valid: boolean = false
  validResetPassword: boolean = false
  dialogMdp: boolean = false
  dialogEmail: string = ''
  dialogPassword: boolean = true

  message: string = ''
  title: string = ''
  failed: boolean = false
  statusText: string = ''
  messageText: string = ''
  status: number | null = null

  async submit () {
    if ((this.$refs.form as any).validate()) {
      return this.login()
    }
  }

  mounted () {
    if (this.authenticated) {
      this.$router.push({ name: 'Home' })
    }
  }

  /**
   * Tente de se connecter.
   */
  async login () {
    this.waiting = true
    try {
      await this.access.login(this.data.username, this.data.password, this.data.saveCredentials)
      this.clearSnackbarEntry()
      this.$router.push({ name: 'Home' })
    } finally {
      this.waiting = false
      this.setDialogAppLogin(false)
    }
  }

  async resetPassword () {
    try {
      this.waiting = true
      this.valid = false
      this.dialogMdp = false
      // const loc = window.location
      // const appBaseUrl = loc.protocol + '//' + loc.hostname + (loc.port ? ':' + loc.port : '')
      // this.email = new UserEmail(email, appBaseUrl)
      // await this.userResource.resetPassword(this.email)
      await this.userResource.resetPassword(this.dialogEmail)
      this.$router.push({ name: 'Home' })
      this.setSnackbarEntry({
        color: 'success',
        message: 'Un message vous a été envoyé par courrier électronique pour vous expliquer comment réinitialiser votre mot de passe.'
      })
    } catch (err) {
      const response = err.response
      this.failed = true
      if (response) {
        err.__handled__ = true
        if (response) {
          // this.statusText = response.statusText
          // this.status = response.status
          // this.messageText = response.data.message
          // this.title = 'Email erroné'
          // if ((this.status === 422) && this.messageText.indexOf('non référencé !') > -1) {
          //   this.title = this.messageText
          //   this.message = 'Le mail que vous avez entré ne correspond pas à un utilisateur. Veuillez vérifier et réessayer.'
          // } else if ((this.status === 422) && this.messageText.indexOf('est désactivé !') > -1) {
          //   this.title = this.messageText
          //   this.message = 'Pour le réactiver, veuillez envoyer un mail à assistance.oison@afbiodiversite.fr. '
          // } else if (response.data && response.data.message) {
          //   this.message = translate(response.data.message)
          // } else if (this.failed) {
          //   this.message = 'Une erreur inconnue s\'est produite'
          // }
          this.setSnackbarEntry({
            icon: 'mdi-alert-circle',
            color: 'error',

            title: this.title,
            // message: 'Le mail que vous avez entré ne correspond pas à un utilisateur. Veuillez vérifier et réessayer. En cas de problème veuillez envoyer un mail à assistance.oison@afbiodiversite.fr.'
            message: this.message
          })
        }
      }
      throw err
    } finally {
      this.dialogEmail = ''
      this.waiting = false
      this.valid = true
      this.setDialogAppLogin(false)
    }
  }

  get emailRules () {
    return [
      (v: string | null) => !!v || 'Veuillez saisir votre E-mail',
      (v: string | null) => v && /^.+@\S+\.\S+$/.test(v) || 'Veuillez saisir un E-mail valide'
    ]
  }
}
</script>

<style lang="scss" scoped>
</style>
