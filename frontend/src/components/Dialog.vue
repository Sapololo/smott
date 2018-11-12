<template>
  <v-flex shrink>
    <v-layout row justify-center>
      <v-dialog
          v-if="currentDialogEntry"
          v-bind="currentDialogEntry"
          v-model="dialogDisplayed"
          scrollable
          max-width="500px"
          persistent
          :fullscreen="$vuetify.breakpoint.smAndDown"
          :transition="$vuetify.breakpoint.smAndDown ? 'dialog-bottom-transition' : 'dialog-transition'"
          @keydown.esc="onCancel()">
        <component v-if="currentDialogEntry.component" :is="currentDialogEntry.component"
                   v-bind="currentDialogEntry.componentProps"></component>
        <v-card v-else>
          <v-toolbar flat dense dark color="primary lighten-1" v-if="currentDialogEntry.title">
            <v-toolbar-title>
              <v-icon dark class="pr-2" v-if="currentDialogEntry.icon">{{currentDialogEntry.icon}}
              </v-icon>
              <span class="headline white--text">{{currentDialogEntry.title}}</span></v-toolbar-title>
            <v-spacer/>
            <v-btn icon @click="onCancel()">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-toolbar>
          <v-card-text v-if="currentDialogEntry.message" v-html="currentDialogEntry.message">
          </v-card-text>

          <v-layout row justify-center v-if="waiting">
            <v-flex xs12 sm6 lg3>
              <v-progress-circular :indeterminate="true"></v-progress-circular>
            </v-flex>
          </v-layout>
          <v-card-actions class="skrink">
            <v-spacer></v-spacer>
            <v-btn v-if="currentDialogEntry.trueandfalse && typeof currentDialogEntry.cancelLabel !== 'undefined'"
                   color="blue darken-1" flat @click.native="onCancel()">
              {{currentDialogEntry.cancelLabel}}
            </v-btn>
            <v-btn v-if="currentDialogEntry.trueandfalse && typeof currentDialogEntry.okLabel !== 'undefined'"
                   color="primary" flat
                   @click.native="onOk()">
              {{currentDialogEntry.okLabel}}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-layout>
  </v-flex>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { DialogEntry, GetterDialog, MutationDialog } from '@/store/dialog'
import { Watch } from 'vue-property-decorator'
import errorHandler from '@/errorHandler'

@Component
export default class Dialog extends Vue {
  @MutationDialog
  setDialogEntry: (entry: DialogEntry) => void

  @GetterDialog
  currentDialogEntry: DialogEntry | DialogEntry

  dialogDisplayed: boolean = false
  waiting: boolean = false

  @Watch('currentDialogEntry')
  onDialogEntryChange (entry?: DialogEntry | null) {
    this.dialogDisplayed = !!entry
  }

  async onOk () {
    try {
      this.waiting = true
      if (this.currentDialogEntry.onOk) {
        this.currentDialogEntry.onOk()
      }
    } catch (err) {
      errorHandler(err)
    } finally {
      this.waiting = false
      this.dialogDisplayed = false
    }
  }

  onCancel () {
    if (this.currentDialogEntry.onCancel) {
      this.currentDialogEntry.onCancel()
    }
    this.dialogDisplayed = false
  }
}
</script>