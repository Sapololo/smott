<template>
  <div class="le-club">
    <div class="row main-wrapper"
         :class="{'drawermenu-open': !DrawerMini && DrawerDisplay && $vuetify.breakpoint.mdAndUp}">
      <Banner/>
      <v-container fluid grid-list-md>
        <v-layout row wrap>
          <v-flex d-flex xs12 sm6 md3 px2 v-for="(item, i) in itemVignettes" :key="i">
            <vue-flip :active-hover="true" width="100%" height="250px" transition="0.7s">
              <div slot="front">
                <v-icon style="font-size: 110px">{{ item.icon }}</v-icon>
                <div v-html="item.title"/>
              </div>
              <div slot="back">
                <div v-html="item.text" style="padding-bottom: 10px;"/>
                <v-btn color="success" @click="link(item.name, item.params)">En savoir plus</v-btn>
              </div>
            </vue-flip>
          </v-flex>
        </v-layout>
      </v-container>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../components/Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import VueFlip from 'vue-flip'

@Component({ components: { Banner, VueFlip } })
export default class LeClub extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  link (link: string, parametres?: any) {
    this.$router.push({ name: link, params: parametres })
  }

  created () {
    this.setDrawer(true)
  }

  itemVignettes: any = [
    {
      icon: 'mdi-google-maps blue--text',
      title: 'Localisation',
      text: 'Retrouvez les adresses des salles',
      name: 'Localisation'
    },
    {
      icon: 'mdi-currency-eur red--text',
      title: 'Les cotisations',
      text: 'Des tarifs suivant votre niveau',
      name: 'LesCotisations'
    },
    {
      icon: 'mdi-calendar lime--text',
      title: 'Calendrier',
      text: 'Les dates des prochains événements',
      name: 'Calendrier'
    },
    {
      icon: 'mdi-textbox-password  pink--text',
      title: 'Le mot de la présidente',
      text: 'Les ambitions du club',
      name: 'LeMotDeLaPresidente'
    },
    {
      icon: 'mdi-account-group',
      title: 'Le bureau',
      text: 'Les bénévoles',
      name: 'LeBureau'
    },
    {
      icon: 'mdi-newspaper orange--text',
      title: 'Revue de presse',
      text: 'Les articles qui parlent du Club',
      name: 'RevueDePresse'
    },
    {
      icon: 'mdi-image teal--text',
      title: 'Affiches',
      text: 'Les dernières affiches',
      name: 'Affiches'
    },
    {
      icon: 'mdi-video amber--text',
      title: 'Videos',
      text: 'Les vidéos autour du Ping',
      name: 'Videos'
    },
    {
      icon: 'mdi-image-multiple purple--text',
      title: 'Photos',
      name: 'Photos'
    },
    {
      icon: 'mdi-chart-bar brown--text',
      title: 'Statistiques',
      text: 'Le club en chiffres',
      name: 'Statistiques',
      params: { clubId: '04450026' }
    },
    {
      icon: 'mdi-help',
      title: 'Qui fait quoi ?',
      text: 'Repartition des rôles',
      name: 'QuiFaitQuoi'
    },
    {
      icon: 'mdi-account-card-details',
      title: 'Cadres sportifs',
      text: 'Les diplômés de la FFTT',
      name: 'CadresSportifs'
    },
    {
      icon: 'mdi-pillar brown--text',
      title: 'Statuts',
      name: 'Statuts'
    },
    {
      icon: 'mdi-altimeter pink--text',
      title: 'Règlement intérieur',
      text: 'Le respect des régles',
      name: 'ReglementInterieur'
    },
    {
      icon: 'mdi-history brown--text',
      title: 'Légendes',
      text: 'Les grands joueurs du club',
      name: 'Legendes'
      // },
      // {
      //   icon: 'mdi-account-search',
      //   title: 'Trombinoscope',
      //   name: 'Trombinoscope'
    },
    {
      icon: 'mdi-thumb-up blue--text',
      title: 'Nos partenaires',
      text: 'Merci de leur soutien',
      name: 'NosPartenaires'
    },
    {
      icon: 'mdi-thumb-up blue--text',
      title: 'Etre partenaire',
      text: 'C\'est ca !',
      name: 'DevenezPartenaires'
    },
    {
      icon: 'mdi-map-marker-radius red--text',
      title: 'Carte des partenaires',
      text: 'Retrouvez les !',
      name: 'CarteDesPartenaires'
    },
    {
      icon: 'mdi-help green--text',
      title: 'Ping sans frontières',
      text: 'Le Ping en Afrique',
      name: 'PingSansFrontieres'
    },
    {
      icon: 'mdi-label purple--text',
      title: 'Labels',
      text: 'Les reconnaissances',
      name: 'Labels'
    }]
}
</script>

<style lang="scss" scoped>
/deep/ .flip-container .flipper {
  white-space: normal;
  font-size: 40px;
  line-height: 40px;
  font-weight: 400;
  transition: none;
  letter-spacing: 2px;
  text-shadow: black 0.1em 0.1em 0.2em;
  text-align: center;
  transition: 0.7s;
  .btn {
    bottom: -20px;
  }
}

/deep/ .flip-container .flipper .front {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  background-color: #404040;
  color: white;
}

/deep/ .flip-container .flipper .back {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  background-color: #ff3434;
  color: white;
  font-size: 24px;
  line-height: 24px;
  font-weight: 300;
}
</style>
