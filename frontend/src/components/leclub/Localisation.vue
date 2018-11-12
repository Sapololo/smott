<template>
  <div class="localisation">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <v-layout class="fluid fill-height pb-2">
        <v-flex xs12 md6 :class="{'pr-3': !DrawerMini && DrawerDisplay && $vuetify.breakpoint.mdAndUp}">
          <v-card class="text-xs-center" height="100%">

            <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin primary py-4"><h3>LE SIÈGE DU CLUB DE ST-MARCEAU ORLÉANS TENNIS DE
              TABLE SE SITUE DANS LA <br/>SALLE THIERRY HARISMENDY – JEAN-LOUIS GEYMOND</h3></span>
            </v-card-title>
            <v-card-text class="text-xs-center">
              <p>8, avenue Alain Savary<br/>
                45100 Orléans (quartier Saint-Marceau)<br/>
                <v-icon class="mdi mdi-phone" style="font-size: 14px;"></v-icon>
                02.38.51.91.60<br/>
                <v-icon class="mdi mdi-email" style="font-size: 14px;"></v-icon>
                stmarceau.tt@free.fr
              </p>
              <p>La salle harismendy (spécifique tennis de table de 16 tables) sert aux entraînements.<br/>&nbsp;</p>
              <p>
                <v-tooltip bottom>
                  <v-icon color="cyan" dark slot="activator" class="mx-2">mdi-elevator</v-icon>
                  <span>Ascenseur disponible sur demande</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-icon color="purple" dark slot="activator" class="mx-2">mdi-wheelchair-accessibility</v-icon>
                  <span>Accès pour handicapés</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-icon color="blue" dark slot="activator" class="mx-2">mdi-shower-head</v-icon>
                  <span>Douches disponibles</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-icon color="pink" dark slot="activator" class="mx-2">mdi-human-female</v-icon>
                  <span>Vestiaire femmes</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-icon color="green" dark slot="activator" class="mx-2">mdi-human-male</v-icon>
                  <span>Vestiaire hommes</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-icon color="red" dark slot="activator" class="mx-2">mdi-smoking-off</v-icon>
                  <span>Espace non fumeur</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-icon color="indigo" dark slot="activator" class="mx-2">mdi-bike</v-icon>
                  <span>Garage vélos</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-icon color="teal" dark slot="activator" class="mx-2">mdi-wifi</v-icon>
                  <span>Garage vélos</span>
                </v-tooltip>
              </p>
            </v-card-text>
            <v-card-actions>
              <v-btn dark
                     :href="'http://maps.google.com/maps/dir/'+latitude+','+longitude+'/8+Avenue+Alain+Savary,+45100+Orléans,+FR/'"
                     v-if="latitude !==0 && longitude !==0"
                     target="_blank">
                <v-icon class="pr-1">mdi-road-variant</v-icon>
                Se rendre à la salle
              </v-btn>
              <v-btn dark
                     href="http://maps.google.com/maps/dir/8+Avenue+Alain+Savary,+45100+Orléans,+FR"
                     v-else
                     target="_blank">
                <v-icon class="pr-1">mdi-road-variant</v-icon>
                Se rendre à la salle
              </v-btn>
              <v-btn dark color="green" @click="goPlanning()">
                <v-icon class="pr-1">mdi-calendar</v-icon>
                Voir le planning
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
        <v-flex xs12 md6>
          <v-card class="text-xs-center" height="100%">

            <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin primary py-4"><h3>COMPÉTITIONS<br/>GYMNASE DE LA CIGOGNE – BERNARD
              PELLÉ</h3></span>
            </v-card-title>
            <v-card-text class="text-xs-center">
              <p>rue Honoré d'Estienne d'Orves<br/>
                45100 Orléans, Loiret<br/>
                (quartier Saint-Marceau)<br/>
                <v-icon class="mdi mdi-phone" style="font-size: 14px;"></v-icon>
                02.38.66.01.64
              </p>
              <p>Les compétitions se déroulent au gymnase Bernard Pellé (16
                tables).<br/><span
                    class="red--text"><i><b>Ouverture du gymnase à 20h le vendredi soir pour les matchs.</b></i></span>
              </p>
              <p>
                <v-tooltip bottom>
                  <v-icon color="purple" dark slot="activator" class="mx-2">mdi-wheelchair-accessibility</v-icon>
                  <span>Accès pour handicapés</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-icon color="blue" dark slot="activator" class="mx-2">mdi-shower-head</v-icon>
                  <span>Douches disponibles</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-icon color="pink" dark slot="activator" class="mx-2">mdi-human-female</v-icon>
                  <span>Vestiaire femmes</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-icon color="green" dark slot="activator" class="mx-2">mdi-human-male</v-icon>
                  <span>Vestiaire hommes</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-icon color="red" dark slot="activator" class="mx-2">mdi-smoking-off</v-icon>
                  <span>Espace non fumeur</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-icon color="indigo" dark slot="activator" class="mx-2">mdi-bike</v-icon>
                  <span>Garage vélos</span>
                </v-tooltip>
                <v-tooltip bottom>
                  <v-icon color="teal" dark slot="activator" class="mx-2">mdi-printer</v-icon>
                  <span>Imprimante pour les JA</span>
                </v-tooltip>
              </p>
            </v-card-text>
            <v-card-actions>
              <v-btn dark
                     :href="'http://maps.google.com/maps/dir/'+latitude+','+longitude+'/Rue+Honoré+d\'Estienne+d\'Orves,+45100+Orléans,+FR/'"
                     v-if="latitude !==0 && longitude !==0"
                     target="_blank">
                <v-icon class="pr-1">mdi-road-variant</v-icon>
                Se rendre à la salle
              </v-btn>
              <v-btn dark
                     href="http://maps.google.com/maps/dir/Rue+Honoré+d'Estienne+d'Orves,+45100+Orléans,+FR"
                     v-else
                     target="_blank">
                <v-icon class="pr-1">mdi-road-variant</v-icon>
                Se rendre à la salle
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
      <v-flex xs12>
        <v-card>
          <google-map :listPartenaire="listPartenaire"/>
        </v-card>
      </v-flex>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import GoogleMap from '../GoogleMap.vue'
import { RawLocation } from 'vue-router'

@Component({ components: { GoogleMap } })
export default class Localisation extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  listPartenaire: boolean = false
  latitude: number = 0
  longitude: number = 0

  mounted () {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(position => {
        this.latitude = position.coords.latitude
        this.longitude = position.coords.longitude
      })
    }
  }

  goPlanning () {
    this.$router.push({ name: 'Planning' } as RawLocation)
  }
}
</script>

<style lang="scss" scoped>
#EmplacementDeMaCarte {
  height: 400px;
}

h1 {
  -webkit-box-flex: 1;
  -ms-flex: 1 1 auto;
  flex: 1 1 auto;
}
</style>
