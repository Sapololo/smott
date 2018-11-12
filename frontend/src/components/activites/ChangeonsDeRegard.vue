<template>
  <div class="qui-fait-quoi">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout row>
        <v-flex sm3>
          <v-card>
            <v-img><img v-bind:src="'/img/galerie/affiches/2017_Changeons-de-regard_400.jpg'"
                        width="100%"/></v-img>
          </v-card>
        </v-flex>
        <v-flex xs12 sm9>
          <v-card>
            <v-card-text>
              <p>Saint Marceau Orléans Tennis de table a organisé avec Florian Merrien et Julien Bochereau la
                sixième
                édition de "Changeons de regard". Cette événement permet sur 2 jours aux enfants de
                découvrir malgré le
                handicap la pratique d'un sport, ici le "Tennis de table".<br>En 2016, Florian Merrien et
                Julien Bochereau
                étaient les parrains de l'événement.</p><br>En 2018, l'événement. se déroulera sur la semaine.
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>

      <v-toolbar flat dense color="primary">
        <v-toolbar-title>Planning 2018</v-toolbar-title>
      </v-toolbar>
      <v-layout fill-height fluid grid-list-xl>
        <v-flex xs12 sm4 pr-1>
          <v-card color="purple lighten-4">
            <v-card-title><h2>Lundi 19 Nov.</h2></v-card-title>
            <v-card-text>
              <ul>
                <li><i><u>10h15 à 12h</u></i><br/>Accueil de 40 jeunes du collège DOLET</li>
                <li><i><u>14h à 15h15</u></i><br/>Accueil de 60 jeunes du collège BOURDON BLANC</li>
                <li><i><u>16h à 17h15</u></i><br/>Accueil de 75 jeunes du collège BOURDON BLANC</li>
                <li><i><u>17h30 à 19h30</u></i><br/>Tournoi Handicap/valide</li>
              </ul>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 sm4 pr-1>
          <v-card color="deep-purple lighten-4">
            <v-card-title><h2>Mardi 20 Nov.</h2></v-card-title>
            <v-card-text>
              <ul>
                <li><i><u>8h15 à 9h45</u></i><br/>Accueil de 30 jeunes du collège DOLET</li>
                <li><i><u>10h15 à 12h</u></i><br/>Accueil de 28 jeunes du collège DOLET et 15 élèves du lycée Mouillère
                </li>
                <li><i><u>14h à 16h</u></i><br/>Accueil de 60 jeunes du collège PREVERT</li>
              </ul>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 sm4 pr-1>
          <v-card color="indigo lighten-4">
            <v-card-title><h2>Mercredi 21 Nov.</h2></v-card-title>
            <v-card-text>
              <ul>
                <li><i><u>8h15 à 10h08</u></i><br/>Accueil de 60 jeunes du lycée PEGUY</li>
                <li><i><u>10h23 à 12h15</u></i><br/>Accueil de 60 jeunes du lycée PEGUY</li>
                <li><i><u>13h30 à 15h30</u></i><br/>Accueil de 60 jeunes du lycée St CHARLES</li>
                <li><i><u>16h à 18h</u></i><br/>Les jeunes du Club</li>
              </ul>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 sm4 pr-1>
          <v-card color="blue lighten-4">
            <v-card-title><h2>Jeudi 22 Nov.</h2></v-card-title>
            <v-card-text>
              <ul>
                <li><i><u>8h15 à 9h45</u></i><br/>Accueil de 60 jeunes de l'école ST MARCEAU</li>
                <li><i><u>10h15 à 12h00</u></i><br/>Accueil de 30 jeunes du lycée PEGUY et jeunes de la MFR</li>
                <li><i><u>13h30 à 15h30</u></i><br/>Accueil de 60 jeunes du lycée St CHARLES</li>
                <li><i><u>19H-21H</u></i><br/>Soirée PARTENAIRES et adhérents</li>
              </ul>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 sm4 pr-1>
          <v-card color="light-blue lighten-4">
            <v-card-title><h2>Vendredi 23 Nov.</h2></v-card-title>
            <v-card-text>
              <ul>
                <li><i><u>8h15 à 9h45</u></i><br/>Accueil de 40 jeunes des collèges DOLET et MOUILLERE</li>
                <li><i><u>9H30 à 11h30</u></i><br/>Accueil de 60 jeunes du lycée ST CHARLES</li>
                <li><i><u>14h à 16h</u></i><br/>Accueil de 60 jeunes de l'école de la Cigogne</li>
              </ul>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 sm4>
          <v-card color="cyan lighten-4">
            <v-card-title><h2>Samedi 24 Nov.</h2></v-card-title>
            <v-card-text>
              <p>Tournoi Sport Adapté de 8h30 à 17h</p></v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
      <v-toolbar flat dense color="primary">
        <v-toolbar-title>Les affiches</v-toolbar-title>
      </v-toolbar>
      <v-layout column>
        <v-container fluid grid-list-md>
          <v-layout row wrap>
            <v-flex
                v-for="item in items"
                v-bind="{ [`xs${item.flex}`]: true }"
                :key="item.title"
            >
              <v-card>
                <v-img v-bind:src="item.src" height="540px"/>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-layout>

    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class ChangeonsDeRegard extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  items: any[] = [
    {
      href: '',
      src: '/img/galerie/affiches/2017_Changeons-de-regard_400.jpg',
      title: 'Changeons de regard 2017',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2016_changeons-de-regard.jpg',
      title: 'Changeons de regard 2016',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2015-Changeons-de-regard_400.jpg',
      title: 'Changeons de regard 2015',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2014_Affiche_Florian-Merrien_400.jpg',
      title: 'Changeons de regard 2014',
      flex: 4
    },
    {
      href: '',
      src: '/img/galerie/affiches/2013_Changeons-de-regard_400.jpg',
      title: 'Changeons de regard 2013',
      flex: 4
    }
  ]
}
</script>
