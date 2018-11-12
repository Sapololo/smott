<template>
  <div class="le-bBureau">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout column>
        <v-container fluid grid-list-md>
          <v-layout row wrap>
            <v-flex md4 sm6 v-for="(item, i) in items" :key="i">
              <v-card>
                <v-img :src="'/img/bureau/'+item.image" height="300px">
                </v-img>
                <v-card-text>
                  <h1 class="headline text--primary" v-html="item.nom"/>
                  <h3 class="title purple--text" v-html="item.role"/>
                  <p class="back--text" v-html="item.titre"/>
                </v-card-text>
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
export default class LeBureau extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  items = [
    {
      image: 'Mary_Bureau.jpg',
      nom: 'Marylène LABLEE',
      role: 'Présidente',
      titre: 'Elle supervise l’ensemble du club, l’ensemble des adhérents'
    },
    {
      image: 'Pierre_Bureau.jpg',
      nom: 'Pierre VACQUET',
      role: 'Vice-président',
      titre: 'Représente le Club auprès des autorités et personnes extérieures'
    },
    {
      image: 'avatar_f.png',
      nom: 'Elisabeth HUBERT',
      role: 'Secrétaire',
      titre: 'Responsable de l’administration et de la gestion du Club'
    },
    {
      image: 'Jean-luc_Bureau.jpg',
      nom: 'Jean-luc POMMIER',
      role: 'Suivi dossiers de subventions',
      titre: 'Avec l’appui des entraîneurs s’occupe adultes.'
    },
    {
      image: 'Francis_Bureau.jpg',
      nom: 'Francis BRASSEUR',
      role: 'Relations loisirs et approvisionnement',
      titre: 'S’occupe des troisièmes mi-temps, ainsi que du relation avec nos séniors.'
    },
    {
      image: 'Loic_Bureau.jpg',
      nom: 'Loïc VACQUET',
      role: 'Correspondant du Club et Trésorier',
      titre: 'Correspondant du club avec les Fédérations, gestionnaire et développeur du site internet ...'
    },
    {
      image: 'avatar_f.png',
      nom: 'CLaire LISBONIS',
      role: 'Documentation, archives',
      titre: ''
    },
    {
      image: 'avatar_h.png',
      nom: 'Hervé JOUAN',
      role: 'Gestion des équipes jeunes et documentation/archives',
      titre: ''
    }]
}
</script>
