<template>
  <div class="mon-profil">
    <div class="row main-wrapper"
         :class="$vuetify.breakpoint.smAndDown ? 'main-wrapper-mobile' : 'main-wrapper-desktop'">
      <Banner/>
      <v-layout row>
        <v-flex xs12 :class="$vuetify.breakpoint.smAndDown ? 'pb-2' : 'pa-2'" v-if="loading">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Mon Profil</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-tooltip bottom>
              <v-btn v-show="!changePassword" icon @click="changePassword=true; editForm=true"
                     slot="activator">
                <v-icon color="white">mdi-key-variant</v-icon>
              </v-btn>
              <span>Changer du mot de passe</span>
            </v-tooltip>
            <v-tooltip bottom>
              <v-btn v-show="!editForm" icon @click="editForm=true;" slot="activator">
                <v-icon color="white">mdi-pencil</v-icon>
              </v-btn>
              <span>Modifier</span>
            </v-tooltip>
            <v-tooltip bottom>
              <v-btn v-show="editForm" icon @click="editForm=false; changePassword=false"
                     slot="activator">
                <v-icon color="blue">mdi-eye</v-icon>
              </v-btn>
              <span>Annuler les modifications</span>
            </v-tooltip>
          </v-toolbar>
          <v-card class="elevation-5">
            <v-form @submit.prevent="submit" v-model="valid" ref="form" lazy-validation>
              <v-card-text v-if="changePassword" :class="{'pt-0 pb-0': $vuetify.breakpoint.smAndDown }">
                <v-layout row wrap>
                  <v-flex xs12 sm3 mr-1>
                    <v-text-field
                        label="Mot de passe actuel"
                        v-model="oldpassword"
                        :rules="[dialogoldpassword => !!dialogoldpassword || 'Veuillez saisir votre mot de passe actuel']"
                        required
                        :append-icon="dialogoldpassword ? 'visibility' : 'visibility_off'"
                        :append-icon-cb="() => (dialogoldpassword = !dialogoldpassword)"
                        :type="dialogoldpassword ? 'password' : 'text'"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm3 mx-1>
                    <v-text-field
                        label="Nouveau mot de passe"
                        v-model="password"
                        required
                        :rules="[checkPasswordOld, dialogpassword => !!dialogpassword || 'Veuillez saisir votre mot de passe']"
                        :append-icon="dialogpassword ? 'visibility' : 'visibility_off'"
                        :append-icon-cb="() => (dialogpassword = !dialogpassword)"
                        :type="dialogpassword ? 'password' : 'text'"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm3 ml-1>
                    <v-text-field
                        label="Confirmation du mot de passe"
                        v-model="confpassword"
                        required
                        :rules="[checkPasswordConf]"
                        :append-icon="dialogconfpassword ? 'visibility' : 'visibility_off'"
                        :append-icon-cb="() => (dialogconfpassword = !dialogconfpassword)"
                        :type="dialogconfpassword ? 'password' : 'text'"
                    ></v-text-field>
                  </v-flex>
                </v-layout>
              </v-card-text>

              <v-card-text v-if="!editForm" :class="{'pt-0 pb-0': $vuetify.breakpoint.smAndDown }">
                <v-layout row wrap>
                  <v-flex xs12 sm3 pr-1>
                    <v-text-field
                        label="Pseudo"
                        v-model="user.username"
                        readonly disabled
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm3 pl-1>
                    <v-text-field
                        label="Email"
                        v-model="user.email"
                        readonly disabled
                    ></v-text-field>
                  </v-flex>
                </v-layout>
              </v-card-text>
              <v-card-text v-if="editForm" :class="{'pt-0 pb-0': $vuetify.breakpoint.smAndDown }">
                <v-layout row wrap>
                  <v-flex xs12 sm3 mr-1>
                    <v-text-field
                        label="Pseudo"
                        v-model="formUser.username"
                        :counter="180"
                        :rules="[v => !!v || 'Le pseudo est obligatoire']"
                        required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm3 ml-1>
                    <v-text-field
                        label="Email"
                        v-model="formUser.email"
                        :rules="[v => !!v || 'Email est obligatoire', v => /^.+\@\S+\.\S+$/.test(v) || 'E-mail doit être valide']"
                        required
                    ></v-text-field>
                  </v-flex>
                </v-layout>
              </v-card-text>
              <v-layout row justify-center>
                <v-flex xs12 sm6 lg3>
                  <v-progress-circular v-if="waiting" :indeterminate="true"></v-progress-circular>
                </v-flex>
              </v-layout>
              <v-card-actions v-if="editForm" :class="{'pt-0': $vuetify.breakpoint.smAndDown }">
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat="flat"
                       @click="onCancel()">
                  Annuler
                </v-btn>
                <v-btn type="submit" :disabled="!valid" block color="primary">
                  Enregistrer
                </v-btn>

              </v-card-actions>
            </v-form>

          </v-card>
        </v-flex>
      </v-layout>
      <JoueurDetail :licenceId="this.payload.licenceId" v-if="this.payload.licenceId"/>

    </div>
  </div>

</template>

<script lang="ts">
import { Component, Inject, Vue } from 'vue-property-decorator'
import { RawLocation } from 'vue-router'
import UserModel, { UserPassword } from '@/api/model/user'
import UserResource from '@/api/resources/user'
import ApiService from '@/services/api'
import { GetterAuth, Payload, StateAuth } from '@/store/auth'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import errorHandler from '@/errorHandler'
import Banner from '../Banner.vue'
import cloneDeep from 'lodash/cloneDeep'
import JoueurDetail from '@/components/competition/JoueurDetail.vue'

@Component({ components: { Banner, JoueurDetail } })
export default class MonProfil extends Vue {
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

  loading: boolean = false
  user: UserModel = new UserModel()
  formUser: UserModel = new UserModel()

  changePassword: boolean = false
  editForm: boolean = false
  valid: boolean = false
  waiting: boolean = false
  confpassword: string = ''
  password: string = ''
  oldpassword: string = ''
  UserPassword: UserPassword
  dialogpassword: boolean = true
  dialogoldpassword: boolean = true
  dialogconfpassword: boolean = true

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
      // this.user = await this.profilUtilisateurResource.getUser()
      this.user = this.payload
      this.loading = true
      this.formUser = cloneDeep(this.user)
      return this.user
    }
  }

  async submit () {
    try {
      if ((this.$refs.form as any).validate()) {
        this.valid = false
        this.waiting = true
        // Mise en forme de name et firstName
        await this.userResource.saveUser(this.formUser)
        this.user = this.formUser
        if (this.changePassword) {
          await this.userResource.savePassword(this.password, this.oldpassword)
          this.setSnackbarEntry({
            color: 'success',
            icon: 'mdi-alert-decagram',
            message: `Le mot passe a été mis à jour.`
          })
        } else {
          this.setSnackbarEntry({
            color: 'success',
            icon: 'mdi-alert-decagram',
            message: `Mise(s) à jour de votre profil effectuée(s).`
          })
        }
        this.editForm = false
        this.changePassword = false
        this.password = ''
        this.confpassword = ''
        this.api.renewToken().catch((err) => {
          errorHandler(err)
          throw err
        })
      }
    } catch (err) {
      errorHandler(err)
      throw err
    } finally {
      this.waiting = false
    }
  }

  checkPasswordConf (v: string) {
    return v === this.password || 'Le mot passe et la confirmation ne sont pas identiques'
  }

  checkPasswordOld (v: string) {
    return v === this.password || 'Le mot passe et la confirmation ne sont pas identiques'
  }

  onCancel () {
    this.editForm = false
    this.changePassword = false
    this.password = ''
    this.confpassword = ''
  }
}
</script>

<style lang="scss" scoped>
.main-wrapper-desktop {
  padding: 30px 30px 30px 30px !important;
}

.main-wrapper-mobile {
  padding: 30px 0px 30px 0px !important;
}

</style>
