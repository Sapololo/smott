<template>
  <div class="section-sportive">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout row mb-2>
        <v-card width="100%">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Objectifs</v-toolbar-title>
          </v-toolbar>
          <v-card-text><p>La section sportive offre aux élèves volontaires la possibilité de bénéficier, après
            accord
            des familles, d'un
            entraînement plus soutenu dans une discipline sportive proposée par l'établissement, tout en
            suivant une
            scolarité normale.</p>
            <p>Ce complément de pratique sportive approfondie doit motiver les élèves en leur donnant
              l'occasion de
              progresser
              et d'être valorisés dans leur sport de prédilection.</p>
            <p>Il contribue ainsi à leur épanouissement et à leur réussite scolaire.</p>
            <p>Les sections sportives scolaires permettent la formation de jeunes sportifs de bon niveau et
              de futurs
              éducateurs, arbitres, officiels ou dirigeants. Elles permettent aux élèves d'atteindre un
              bon niveau de
              pratique
              sans pour autant avoir pour objet la formation de sportifs de haut niveau.</p></v-card-text>
        </v-card>
      </v-layout>

      <v-layout row mb-2>
        <v-card width="100%">
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Les colléges</v-toolbar-title>
          </v-toolbar>
          <v-card-text><p>Dans l'attente du dépôt du dossier d'ici le 20 Novembre 2018, le club
            s'associe
            avec les collége Etienne DOLET à Orléans.</p></v-card-text>
        </v-card>
      </v-layout>

      <v-toolbar flat dense color="primary">
        <v-toolbar-title>Les partenaires de cette section</v-toolbar-title>
      </v-toolbar>

      <v-layout column>
        <v-container fluid grid-list-md>
          <v-layout row wrap>
            <v-flex
                v-for="item in items"
                v-bind="{ [`xs${item.flex}`]: true }"
                :key="item.title"
            >
              <v-card light>
                <v-img height="150px" contain><img v-bind:src="item.src"
                                                   style="background-size: cover;"/>
                </v-img>
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
export default class SectionSportive extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  items: any[] = [
    {
      href: 'http://orleans-metropole.fr',
      title: 'Orléans-Métropole',
      src: '/img/galerie/partenaires/Orleans_Metropole.png',
      flex: 3
    },
    {
      href: 'http://loiret.fr',
      title: 'Loiret',
      src: '/img/galerie/partenaires/Logo_loiret.jpg',
      flex: 3
    },
    {
      href: 'http://regioncentre-valdeloire.fr',
      title: 'Région-Centre',
      src: '/img/galerie/partenaires/Logo_region_centre_150.png',
      flex: 3
    }]

  created () {
    this.setDrawer(true)
  }
}
</script>
