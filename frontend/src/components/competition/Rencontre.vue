<template>
  <v-flex shrink>
    <v-layout row justify-center>
      <v-dialog v-model="dialog"
                scrollable
                max-width="700px"
                persistent
                :fullscreen="$vuetify.breakpoint.smAndDown"
                :transition="$vuetify.breakpoint.smAndDown ? 'dialog-bottom-transition' : 'dialog-transition'"
                @keydown.esc="onCancel()">
        <v-layout row>
          <slot v-if="detailsRencontre.length === 0" transition="fade" name="loading-content">
            <v-flex xs12 class="secondary pa-3"><h1 class="text-xs-center white--text text-uppercase">
              Chargement des
              détails de la rencontre</h1>
              <v-progress-linear :indeterminate="true" color="error"
                                 height="10"
                                 value="75"></v-progress-linear>
            </v-flex>
          </slot>
          <slot v-else transition="fade">
            <v-card style="width: 100%;">
              <v-toolbar flat dense color="secondary">
                <v-toolbar-title class="text-xs-center" style="width: 100%">
                  <v-layout row class="white--text" justify-center>
                    <v-flex shrink class="pr-1">{{detailsRencontre.nomEquipeA}}</v-flex>
                    <v-flex shrink class="px-1"><span
                        v-if="detailsRencontre.scoreEquipeA > detailsRencontre.scoreEquipeB"
                        class="headline blue--text">{{detailsRencontre.scoreEquipeA}}</span><span
                        v-else
                        class=" red--text">{{detailsRencontre.scoreEquipeA}}</span>
                    </v-flex>
                    <v-flex shrink class="px-1">-</v-flex>
                    <v-flex shrink class="px-1"><span
                        v-if="detailsRencontre.scoreEquipeB > detailsRencontre.scoreEquipeA"
                        class="headline blue--text">{{detailsRencontre.scoreEquipeB}}</span><span
                        v-else
                        class=" red--text">  {{detailsRencontre.scoreEquipeB}}</span>
                    </v-flex>
                    <v-flex shrink class="pl-1">{{detailsRencontre.nomEquipeB}}</v-flex>
                  </v-layout>
                </v-toolbar-title>
                <v-spacer/>
                <v-btn icon @click="onCancel()">
                  <v-icon color="white">mdi-close</v-icon>
                </v-btn>
              </v-toolbar>
              <v-layout grid>
                <v-flex xs6>
                  <v-data-table
                      :items="detailsRencontre.joueursA"
                      hide-actions
                      hide-headers
                      no-data-text="Chargement en cours"
                      class="elevation-1 white"
                      style="width: 100%;"
                  >
                    <template slot="items" slot-scope="props">
                      <td class="text-xs-center">{{props.item.points}}</td>
                      <td class="text-xs-left"
                          @click="rechercheJoueur(props.item.nom, props.item.prenom)">
                        {{props.item.nom}} {{props.item.prenom}}
                      </td>
                    </template>
                    <v-alert slot="no-results" value="true" color="error" icon="warning">
                      Votre recherche ne donne aucun résultat.
                    </v-alert>
                  </v-data-table>
                </v-flex>
                <v-flex xs6>
                  <v-data-table
                      :items="detailsRencontre.joueursB"
                      hide-actions
                      hide-headers
                      no-data-text="Chargement en cours"
                      class="elevation-1 white"
                      style="width: 100%;"
                  >
                    <template slot="items" slot-scope="props">
                      <td class="text-xs-right" @click="rechercheJoueur(props.item.nom, props.item.prenom)">
                        {{props.item.nom}} {{props.item.prenom}}
                      </td>
                      <td class="text-xs-center">{{props.item.points}}</td>
                    </template>
                    <v-alert slot="no-results" value="true" color="error" icon="warning">
                      Votre recherche ne donne aucun résultat.
                    </v-alert>
                  </v-data-table>
                </v-flex>
              </v-layout>
              <v-toolbar flat dense color="primary">
                <v-toolbar-title>Détails des parties</v-toolbar-title>
              </v-toolbar>
              <v-card-text style="padding: 0;">
                <v-data-table
                    :items="detailsRencontre.parties"
                    hide-actions
                    hide-headers
                    no-data-text="Chargement en cours"
                    class="elevation-1 white"
                    style="width: 100%;"
                >
                  <template slot="items" slot-scope="props">
                    <td class="text-xs-right"><span v-if="props.item.scoreA"
                                                    class="blue--text">{{props.item.adversaireA}}</span><span
                        v-else>{{props.item.adversaireA}}</span>
                    </td>
                    <td class="text-xs-center"><span v-if="props.item.scoreA"
                                                     class="title blue--text">{{props.item.scoreA}}</span><span
                        v-else class="title red--text">-</span></td>
                    <td class="text-xs-center"><span v-if="props.item.scoreB"
                                                     class="title blue--text">{{props.item.scoreB}}</span><span
                        v-else class="title red--text">-</span></td>
                    <td class="text-xs-left"><span v-if="props.item.scoreB"
                                                   class="blue--text">{{props.item.adversaireB}}</span><span
                        v-else>{{props.item.adversaireB}}</span>
                    </td>
                  </template>
                  <v-alert slot="no-results" value="true" color="error" icon="warning">
                    Votre recherche ne donne aucun résultat.
                  </v-alert>
                </v-data-table>
              </v-card-text>
            </v-card>
          </slot>
        </v-layout>
      </v-dialog>
    </v-layout>
  </v-flex>
</template>

<script lang="ts">
import { Component, Prop, Vue, Watch } from 'vue-property-decorator'
import RencontreDetailModel from '@/api/model/rencontreDetail'

@Component
export default class Rencontre extends Vue {
  @Prop({ type: Boolean })
  dialogDisplay: boolean

  @Prop({ type: Array, default: () => [] })
  detailsRencontre: RencontreDetailModel[] = []

  dialog: boolean = false

  @Watch('dialogDisplay', { immediate: true })
  onValueChanged (newVal: boolean): void {
    this.dialog = newVal
  }

  onCancel () {
    this.dialogDisplay = false
  }

  rechercheJoueur (nom?: string, prenom?: string) {
    this.$router.push({ name: 'Recherche', params: { nomJoueur: '' + nom, prenomJoueur: '' + prenom } })
  }
}
</script>

<style lang="scss" scoped>
</style>
