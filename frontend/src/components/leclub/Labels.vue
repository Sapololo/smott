<template>
  <div class="labels">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout row wrap pb-2>
        <v-flex sm6 xs12 px-1>
          <v-toolbar flat dense color="primary" class="white--text">
            <v-toolbar-title>Club reconnu par les fédérations</v-toolbar-title>
          </v-toolbar>

          <v-card>
            <v-img height="250px" contain>
              <img v-bind:src="'/img/pages/labels_2016.jpg'" title="Les labels 2016 de la FFTT"
                   style="background-size: cover; width:100%;"/>
            </v-img>
            <v-card-text>
              <h3>En début d'année 2016, la Fédération Française de Tennis de Table nous a accordé 8
                labels, sur 11
                possibles.<br>
                <small>(voir le descriptif ci-dessous)</small>
              </h3>
              <p><a href="http://www.fftt.com/actus/a_chaque_club_son_label_ping_2015_05_19-1234.html"
                    target="_blank">+
                d'information sur le site de la FFTT</a></p>
              <p>Le Club de Saint Marceau Orléans TT s'est vu attribué 8 labels.</p>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex sm6 xs12 px-1>
          <v-toolbar flat dense color="primary" class="white--text" pb-2>
            <v-toolbar-title>Commission départemental Sport et Handicap 45</v-toolbar-title>
          </v-toolbar>

          <v-card>
            <v-img height="250px" contain>
              <img v-bind:src="'/img/pages/lable_sport_handicap.jpg'"
                   title="Label  Commission départemental Sport et Handicap 45"
                   style="background-size: cover; width:100%;"/>
            </v-img>
          </v-card>
        </v-flex>

        <v-flex xs12 px-1>
          <v-toolbar flat dense color="primary" class="white--text">
            <v-toolbar-title>Les labels</v-toolbar-title>
          </v-toolbar>
          <v-card>
            <v-card-text>
              <v-list>
                <v-list-tile v-for="(item, i) in listLabel"
                             :key="i">
                  <v-list-tile-avatar>
                    <img width="180" title="Label" :src="'/img/pages/' + item.src" border="0">
                  </v-list-tile-avatar>
                  <v-list-tile-content v-html="item.text"/>
                </v-list-tile>
              </v-list>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class Labels extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  listLabel: any[] = [
    {
      src: 'label_pingaufeminin.jpg',
      text: 'Mesure la situation et de l’action tournée vers les féminines, de façon la plus complète et simple possible.'
    },
    {
      src: 'label_pingsante.jpg',
      text: 'Développer l’offre et la pratique du Ping pour le plus grand nombre, y compris les personnes accompagnées ou déficientes, afin améliorer leur capital santé - bien être.'
    },
    {
      src: 'label_pingdurable.jpg',
      text: 'Un sport durable est un sport qui se développe en tenant compte de l’impact de ses activités dans les domaines sociaux, environnementaux et économiques. Le tennis de table veut apporter sa contribution à cet enjeu de changement de la société que représente le développement durable.'
    },
    {
      src: 'label_ping4-7ans.jpg',
      text: 'Le Ping pour les plus jeunes, aussi appelé Baby Ping, fait l’objet d’aménagements ludiques et de principes fédéraux.'
    },
    {
      src: 'label_equipping.jpg',
      text: 'Les conditions de pratique sont essentielles pour fidéliser les licencis et attirer de nouveaux publics. L’objectif est d’augmenter la convivialité dans sa salle ou se mobiliser pour obtenir une salle adaptée.'
    },
    {
      src: 'label_handiping.jpg',
      text: 'Mesure l’intérêt et des compétences du club dans l’encadrement du sport Handicap, sous toutes ses formes et appellations.'
    },
    {
      src: 'label_actiping.jpg',
      text: 'Il s’agit de mesurer, la qualité de la vie associative, de la cohésion, du lien entre les adhérents donc «le cœur» du club et de sa contribution à la vie de la commune.'
    },
    {
      src: 'label_equipping.jpg',
      text: 'Les conditions de pratique sont essentielles pour fidéliser les licenciés et attirer de nouveaux publics. L’objectif est d’augmenter la convivialité dans sa salle ou se mobiliser pour obtenir une salle adaptée.'
    },
    {
      src: 'label_loisirping.jpg',
      text: 'Matérialise tous les aspects de la gestion et de l’animation des pratiquants pongistes non compétiteurs.'
    },
    {
      src: 'label_formaping.jpg',
      text: 'Les outils fédéraux du tennis de table, pour l’apprentissage, ainsi que la formation à tous les profils d’encadrement (dirigeants, techniciens et arbitres).'
    },
    {
      src: 'label_promoping.jpg',
      text: 'La promotion est une affaire de communication. Le but pour le club est d’être identifié et reconnu.'
    }
  ]
}
</script>
