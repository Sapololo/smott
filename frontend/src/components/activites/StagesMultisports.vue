<template>
  <div class="stages-multisports">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-toolbar flat dense color="primary">
        <v-toolbar-title>Le programme type d'une journée se décompose de la façon suivante</v-toolbar-title>
      </v-toolbar>
      <v-layout row mb-2>
        <v-card width="100%">
          <v-card-text>
            <v-container>
              <ul>
                <li><em><span><u>8h30 à 9h&nbsp;:</u></span></em> Accueil</li>
                <li><span><em><u>9h à 12h :</u></em></span> Tennis de Table</li>
                <li><em><span><u>12h à 13h30 :</u></span></em> Repas (sur place; prévoir panier «&nbsp;pique-nique&nbsp;»,
                  possibilité de faire réchauffer les plats au micro-onde) – Temps calme (jeux
                  détente, vidéos …)
                </li>
                <li><em><span><u>13h30 à 17h :</u></span></em> Activités physiques diverses (sports de
                  raquette :
                  Badminton, Tennis …, Sports collectifs : Hockey, Football, Handball, Basketball …,
                  Sports «&nbsp;funs&nbsp;»
                  : Ultimate, Théèque …, Sports individuels : Athlétisme …)
                </li>
                <li><em><span><u>17h à 17h30 :</u></span></em> Fin de la journée (reprise des enfants)
                </li>
              </ul>
            </v-container>
            <h1>PROGRAMME STAGE TOUSSAINT (sem 1)</h1>
            <table width="100%">
              <thead style="background-color:#404040;" class="white--text title">
              <tr>
                <td class="text-xs-center title" pt-2>HORAIRES<br/>JOURS</td>
                <td class="text-xs-center title">Lundi 22 Octobre</td>
                <td class="text-xs-center title">Mardi 23 Octobre</td>
                <td class="text-xs-center title">Mercredi 24 Octobre</td>
                <td class="text-xs-center title">Jeudi 25 Octobre</td>
                <td class="text-xs-center title">Vendredi 26 Octobre</td>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td style="background-color:#404040;" class="white--text text-xs-center">08h30 à 09h00
                </td>
                <td colspan="5" style="background-color:#2196F3;"
                    class="white--text text-xs-center">ACCUEIL
                  HARISMENDY
                </td>
              </tr>
              <tr>
                <td style="background-color:#404040;" class="white--text text-xs-center">9h00 à
                  10h15<br/>(Animation
                  1)
                </td>
                <td colspan="5" rowspan="2" style="background-color:#673AB7;"
                    class="white--text text-xs-center">TENNIS DE TABLE
                </td>
              </tr>
              <tr>
                <td style="background-color:#404040;" class="white--text text-xs-center">10h45
                  à 12h00<br/>(Animation
                  2)
                </td>
              </tr>
              <tr>
                <td style="background-color:#404040;" class="white--text text-xs-center">14h00-
                  15h30<br/>(Animation
                  3)
                </td>
                <td rowspan="2" style="background-color:#009688;"
                    class="white--text text-xs-center">LASER
                  QUEST
                </td>
                <td rowspan="2" style="background-color:#009688;"
                    class="white--text text-xs-center">COURSE
                  D’ORIENTATION
                  <br/>ou<br/>
                  PETANQUE
                </td>
                <td rowspan="2" style="background-color:#009688;"
                    class="white--text text-xs-center">BOWLING
                </td>
                <td rowspan="2" style="background-color:#009688;"
                    class="white--text text-xs-center">LASER
                  QUEST
                </td>
                <td rowspan="2" style="background-color:#009688;"
                    class="white--text text-xs-center">TOURNOI
                  TENNIS DE TABLE
                </td>
              </tr>
              <tr>
                <td style="background-color:#404040;" class="white--text text-xs-center">14h00-
                  15h30<br/>(Animation
                  3)
                </td>
              </tr>
              <tr>
                <td style="background-color:#404040;" class="white--text text-xs-center">
                  17h00-17h30
                </td>
                <td colspan="5" style="background-color:#2196F3;"
                    class="white--text text-xs-center">ACCUEIL
                  HARISMENDY
                </td>
              </tr>
              </tbody>
            </table>
            <p class="justify-center">Remise 10% sur semaine complète (hors supplément)</p>
            <p class="justify-center">Supplément semaine : LASER QUEST (11€) + BOWLING (4€) = 15€</p>
            <br/>
            <br/>
            <h1>PROGRAMME STAGE TOUSSAINT (sem 2)</h1>
            <table width="100%">
              <thead style="background-color:#404040;" class="white--text title">
              <tr>
                <td class="text-xs-center title" pt-2>HORAIRES<br/>JOURS</td>
                <td class="text-xs-center title">Lundi 29 Octobre</td>
                <td class="text-xs-center title">Mardi 30 Octobre</td>
                <td class="text-xs-center title">Mercredi 31 Octobre</td>
                <td class="text-xs-center title">Jeudi 1 Novembre</td>
                <td class="text-xs-center title">Vendredi 2 Novembre</td>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td style="background-color:#404040;" class="white--text text-xs-center">08h30 à 09h00
                </td>
                <td colspan="3" style="background-color:#2196F3;"
                    class="white--text text-xs-center">ACCUEIL
                  HARISMENDY
                </td>
                <td colspan="2" rowspan="6" style="background-color:#9E9E9E;"
                    class="white--text text-xs-center">RIEN
                </td>
              </tr>
              <tr>
                <td style="background-color:#404040;" class="white--text text-xs-center">9h00 à
                  10h15<br/>(Animation
                  1)
                </td>
                <td colspan="3" rowspan="2" style="background-color:#673AB7;"
                    class="white--text text-xs-center">TENNIS DE TABLE
                </td>
              </tr>
              <tr>
                <td style="background-color:#404040;" class="white--text text-xs-center">10h45
                  à 12h00<br/>(Animation
                  2)
                </td>
              </tr>
              <tr>
                <td style="background-color:#404040;" class="white--text text-xs-center">14h00-
                  15h30<br/>(Animation
                  3)
                </td>
                <td rowspan="2" style="background-color:#009688;"
                    class="white--text text-xs-center">LASER
                  QUEST
                </td>
                <td rowspan="2" style="background-color:#009688;"
                    class="white--text text-xs-center">TOURNOI
                  TENNIS DE TABLE
                </td>
                <td rowspan="2" style="background-color:#009688;"
                    class="white--text text-xs-center">BOWLING
                </td>
              </tr>
              <tr>
                <td style="background-color:#404040;" class="white--text text-xs-center">14h00-
                  15h30<br/>(Animation
                  3)
                </td>
              </tr>
              <tr>
                <td style="background-color:#404040;" class="white--text text-xs-center">
                  17h00-17h30
                </td>
                <td colspan="3" style="background-color:#2196F3;"
                    class="white--text text-xs-center">ACCUEIL
                  HARISMENDY
                </td>
              </tr>
              </tbody>
            </table>
            <p class="justify-center">Remise 15% sur 2 semaines complètes (hors supplément)</p>
            <p class="justify-center">Supplément semaine : LASER QUEST (8€) + BOWLING (4€) = 12€</p>
          </v-card-text>
        </v-card>
      </v-layout>

      <v-toolbar flat dense color="primary">
        <v-toolbar-title>Tarifs</v-toolbar-title>
      </v-toolbar>
      <v-layout row mb-2>
        <v-card width="100%">

          <v-card-text>
            <p>Non licenciés = 14 €/jour et Licenciés = 10 €/jour.</p>
            <p>En cas d'activités extérieures <a href="http://www.laserquest45.fr/" target="_blank">(Laser
              Quest</a>,
              bowling...), un supplément financier de 5 à 10€/personne sera demandé.</p>
            <a href="/document/fiche_stage_inscription.pdf" download title="Fiche d'inscription"
               class="btn btn-gray btn-sm btn-animated">Fiche d’inscription à remplir<i
                class="fa fa-download"></i></a>
          </v-card-text>
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
export default class StagesMultisports extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  created () {
    this.setDrawer(true)
  }
}
</script>
