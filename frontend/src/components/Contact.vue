<template>
  <div class="contact">
    <v-dialog v-model="DialogAppContact" @keydown.esc="setDialogAppContact(false)"
              max-width="800px" persistent
              :fullscreen="$vuetify.breakpoint.smAndDown"
              :transition="$vuetify.breakpoint.smAndDown ? 'dialog-bottom-transition' : 'dialog-transition'">
      <v-card>
        <v-toolbar flat dense dark color="primary lighten-1">
          <v-toolbar-title>
            <v-icon dark class="pr-2">mdi-email-open</v-icon>
            <span class="headline white--text">CONTACTEZ NOUS !</span></v-toolbar-title>
          <v-spacer/>
          <v-btn icon @click="setDialogAppContact(false)">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-toolbar>
        <v-form @submit.prevent="submit" v-model="valid" ref="form" lazy-validation>
          <v-card-text>
            <v-container fluid>
              <v-text-field
                  label="Nom"
                  v-model="dialogName"
                  :rules="[v => !!v || 'Le nom est obligatoire']"
                  required
              />
              <v-text-field
                  label="E-mail"
                  type="email"
                  v-model="dialogEmail"
                  :rules="[v => !!v || 'Email est obligatoire', v => /^.+\@\S+\.\S+$/.test(v) || 'E-mail doit être valide']"
                  required
              />
              <v-text-field
                  label="Sujet"
                  v-model="dialogSujet"
              />
              <v-textarea
                  label="Message"
                  v-model="dialogMessage"
                  multi-line
              />
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-btn color="blue darken-1" flat="flat"
                   @click="setDialogAppContact(false)">
              Fermer
            </v-btn>
            <v-btn type="submit" :disabled="!valid" block color="primary">Envoyer</v-btn>
            <v-flex xs12 sm6 lg3>
              <v-progress-linear v-if="loading" :indeterminate="true"></v-progress-linear>
            </v-flex>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Inject } from 'vue-property-decorator'
import ApiService from '@/services/api'
import { GetterDialogApp, MutationDialogApp } from '@/store/dialogApp'
import EmailResource from '@/api/resources/email'
import EmailModel from '@/api/model/email'

@Component
export default class Contact extends Vue {
  @Inject()
  api: ApiService

  @MutationDialogApp
  setDialogAppContact: { (contact: boolean): void }

  @GetterDialogApp
  DialogAppContact: { (contact: boolean): void }

  @Inject()
  emailResource: EmailResource

  valid: boolean = false
  loading: boolean = false

  dialogName: string = ''
  dialogEmail: string = ''
  dialogSujet: string = ''
  dialogMessage: string = ''
  email: EmailModel | null = null

  async submit () {
    if ((this.$refs.form as any).validate()) {
      this.email = new EmailModel()
      this.email.name = this.dialogName
      this.email.email = this.dialogEmail
      this.email.sujet = this.dialogSujet
      this.email.message = this.dialogMessage
      await this.emailResource.email(this.email)
    }
  }
}
</script>
