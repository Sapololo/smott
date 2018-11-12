<template>
  <div class="planning">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-toolbar flat dense color="primary">
        <v-toolbar-title>A chacun son ou ses créneaux</v-toolbar-title>
      </v-toolbar>

      <div class="table-responsive">
        <table class="table table-planning" style="border:1px solid #000;width: 100%;">
          <thead style="background-color:#ddd;">
          <tr>
            <th width="16%">LUNDI</th>
            <th width="16%">MARDI</th>
            <th width="16%">MERCREDI</th>
            <th width="16%">JEUDI</th>
            <th width="16%">VENDREDI</th>
            <th width="16%">SAMEDI</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="seance libre" rowspan="5"><p>PING POUR TOUS</p>
              <p>10h à 12h</p></td>
          </tr>
          <tr></tr>
          <tr></tr>
          <tr></tr>
          <tr></tr>
          <tr>
            <td></td>
            <td rowspan="5" class="seance libre"><p>VETERANS LOISIRS<br/>Libre</p>
              <p>13h30 à 15h30</p>
              <p>PING SANTE<br/>Dirigé</p>
              <p>14h à 15h</p></td>
            <td></td>
            <td></td>
            <td rowspan="5" class="seance libre"><p>VETERANS LOISIRS<br/>Libre</p>
              <p>13h30 à 15h30</p></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td rowspan="3" class="seance poussin"><p>POUSSINS / BENJAMINS</p>
              <p>14h à 15h30</p></td>
            <td></td>
            <td rowspan="8" class="seance jeune"><p>COMPETITIONS<br/>JEUNES</p>
              <p>14h à 16h</p>
              <p>suivant compétitions</p></td>
          </tr>
          <tr></tr>
          <tr></tr>
          <tr>
            <td></td>
            <td rowspan="3" class="seance minime"><p>MINIMES / CADETS</p>
              <p>15h30 à 17h</p></td>
          </tr>
          <tr></tr>
          <tr></tr>

          <tr>
            <td></td>
            <td rowspan="2"></td>
            <td rowspan="2" class="seance babie"><p>BABY PING</p>
              <p>17h à 18h</p></td>
            <td rowspan="4" class="seance jeune"><p>PING LOISIRS JEUNES Libre</p>
              <p>17h à 19h</p></td>
            <td rowspan="3" class="seance poussin"><p>POUSSINS / BENJAMINS</p>
              <p>17h à 18h15</p></td>
          </tr>
          <tr>
            <td rowspan="5" class="seance handi"><p>HANDI PING</p>
              <p>17h30 à 19h30</p></td>
          </tr>
          <tr>
            <td rowspan="4" class="seance minime"><p>MINIMES / CADETS<br/>SENIORS Libre</p>
              <p>18h à 19h30</p></td>
            <td rowspan="2" class="seance ecole"><p>QUARTIERS</p>
              <p>18h à 19h</p></td>
            <td></td>
          </tr>
          <tr>
            <td rowspan="3" class="seance minime"><p>OUVERT A TOUS</p>
              <p>18h15 à 19h30</p></td>
          </tr>
          <tr>
            <td rowspan="4" class="seance compet"><p>COMPET PING</p>
              <p>19h à 20h30</p></td>
            <td rowspan="5" class="seance compet"><p>COMPET PING</p>
              <p>19h à 21h</p></td>
          </tr>
          <tr></tr>
          <tr></tr>
          <tr></tr>
          <tr>
            <td></td>
            <td></td>
            <td rowspan="3" class="seance loisir"><p>LOISIRS ADULTES</p>
              <p>20h30 à 22h</p></td>
          </tr>
          <tr></tr>
          <tr></tr>
          </tbody>
        </table>
      </div>
      <h3>* Ce planning ne prend pas en compte les horaires de la section sportive, tous les lundis, mardis et
        jeudis de
        17h à 18h30.</h3>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class Planning extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>

<style lang="scss" scoped>
/deep/ tr {
  height: 30px;
}

.heure {
  text-align: center;
  font-style: italic !important;
  font-weight: 700 !important;
  font-size: 16px !important;
  font-weight: 400;
  line-height: 48px !important;
  letter-spacing: normal !important;
  font-family: 'Roboto', sans-serif !important;
}

.seance {
  text-align: center;
  font-style: italic !important;
  font-weight: 700 !important;
  font-size: 16px !important;
  font-weight: 400;
  line-height: 48px !important;
  letter-spacing: normal !important;
  font-family: 'Roboto', sans-serif !important;
}

.libre {
  background-color: #0D47A1;
  color: #000;
}

.poussin {
  background-color: gold;
  color: #000;
}

.handi {
  background-color: #d0d1d3;
  color: #000;
}

.ecole {
  background-color: #651FFF;
  color: #000;
}

.babie {
  background-color: #fcca2d;
  color: #000;
}

.minime {
  background-color: #449d44;
  color: #000;
}

.jeune {
  background-color: #c87f0a;
  color: #000;
}

.loisir {
  background-color: #9ebecd;
  color: #000;
}

.compet {
  background-color: #b1157a;
  color: #000;
}
</style>
