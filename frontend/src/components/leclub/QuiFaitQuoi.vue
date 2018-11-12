<template>
  <div class="qui-fait-quoi">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout row wrap>
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>Le bureau du club, les responsabilités, et les tâches à accomplir</v-toolbar-title>
        </v-toolbar>
        <v-card>
          <div class="card__content">
            <div class="table-responsive">
              <table class="table">
                <thead>
                <tr text-xs-center>
                  <th valign="middle" width="33%" height="50"><h1>
                    Qui</h1></th>
                  <th valign="middle" width="66%"><h1>Quoi</h1>
                  </th>
                </tr>
                </thead>
                <tbody>
                <tr class="odd">
                  <td width="33%">
                    <h2 class="headline blue--text darken-4">Le Président et le(s)
                      vice-Présidents</h2>
                    <span class="grey--text">supervisent l’ensemble du club, l’ensemble des adhérents</span>
                  </td>
                  <td width="66%">
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;représentent le
                      Club
                      auprès des autorités et personnes extérieures,
                    </p>
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;sont responsables
                      des
                      demandes de subventions.
                    </p>
                  </td>
                </tr>
                <tr>
                  <td width="33%">
                    <h2 class="headline blue--text darken-4">Le Secrétaire et son adjoint</h2>
                    <span class="grey--text">sont responsables de l’administration et de la gestion du Club</span>
                  </td>
                  <td width="66%">
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;statuts du club,
                      affiliation FFTT et FSCF, Agréments
                    </p>
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;conventions
                      club/mairie,
                    </p>
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;gestion des
                      installations
                      et des horaires, règlement intérieur
                    </p>
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;réunions de bureau
                      et
                      réunions diverses, assemblée générale, registres divers de l’association
                    </p>
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;gestion du
                      Personnel,
                      gestion des archives
                    </p>
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;gestion des
                      licences
                      et
                      des adhérents, certificats médicaux.
                    </p>
                  </td>
                </tr>
                <tr class="odd">
                  <td width="33%">
                    <h2 class="headline blue--text darken-4">Le Trésorier et le Trésorier
                      adjoint</h2>
                    <span class="grey--text">sont en charge de la gestion financière du club</span>
                  </td>
                  <td width="66%">
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;responsables de
                      toutes
                      les
                      opérations bancaires, registre de la comptabilité, budget prévisionnel
                      annuel, compte de
                      résultats,
                      bilan financier du club, éditent les factures et encaissent les «
                      conventions » diverses,
                      vérifient
                      l’encaissement des subventions, établissent les certificats fiscaux pour les
                      déductions fiscales
                      (cerfa), remboursements des frais de déplacements et de juge arbitrage.
                    </p>
                  </td>
                </tr>
                <tr>
                  <td width="33%">
                    <h2 class="headline blue--text darken-4">Le Responsable Développement</h2>
                    <span class="grey--text">s’appuie sur tous les membres du club pour</span>
                  </td>
                  <td width="66%">
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;établir et mettre
                      à
                      jour
                      le « projet du club » avec des objectifs
                    </p>
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;promouvoir l’image
                      du
                      club, développer l’animation
                    </p>
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;obtenir des aides,
                      ponctuelles ou non, pour des « événements » organisés par le club
                    </p>
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;gérer la
                      logistique,
                      l’entretien des tables et du matériel en général
                    </p>
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;chercher des
                      mécènes
                      et
                      sponsors, établir les conventions
                    </p>
                  </td>
                </tr>
                <tr class="odd">
                  <td width="33%">
                    <h2 class="headline blue--text darken-4">Le Correspondant du Club</h2>
                    <span class="grey--text">est en charge de</span>
                    <p>&nbsp;</p>
                  </td>
                  <td width="66%">
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;l’animation
                      interne du
                      Club, entre les dirigeants et les adhérents : gère le site Internet du Club.
                    </p>
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;l’animation
                      externe :
                      avec
                      le Comité, la Ligue, la FFTT, la Municipalité, les Collectivités, avec la
                      Presse et les Médias,
                      avec
                      les partenaires.
                    </p>
                  </td>
                </tr>
                <tr>
                  <td width="33%">
                    <h2 class="headline blue--text darken-4">Le Responsable de la Gestion
                      Sportive</h2>
                    <span class="grey--text">avec l’appui des entraîneurs s’occupe</span>
                  </td>
                  <td width="66%">
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;des championnats
                      jeunes,
                      adultes et vétérans,
                    </p>
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;des déplacements
                      (individuels ou collectifs), les arbitres et juge arbitres, de
                      l’approvisionnement du bar pour
                      toutes
                      les compétitions.
                    </p>
                  </td>
                </tr>
                <tr class="odd">
                  <td width="33%">
                    <h2 class="headline blue--text darken-4">Le Responsable de la Gestion
                      Éducative</h2>
                    <span class="grey--text">s’occupe</span>
                  </td>
                  <td width="66%">
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;des relations avec
                      les
                      éducateurs, la formation en général (éducateurs, pilotes, arbitres et JA …),
                    </p>
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;l’école de TT du
                      club,
                      les
                      entraînements compétiteurs et loisirs
                    </p>
                    <p>
                      <v-icon class="mdi mdi-check-outline" color="blue"/>&nbsp;des relations avec
                      les
                      écoles (scolaires et péri-scolaires),
                    </p>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </v-card>
      </v-layout>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class QuiFaitQuoi extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>

<style lang="scss" scoped>
.table-responsive .table {
  thead {
    background-color: grey;
    color: white;
  }

  .odd {
    background-color: lightgrey;
  }
  td {
    padding: 10px;
    vertical-align: middle;
    text-align: left;
  }
}
</style>
