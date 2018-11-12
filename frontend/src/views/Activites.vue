<template>
  <div class="activites">
    <div class="row main-wrapper"
         :class="{'drawermenu-open': !DrawerMini && DrawerDisplay && $vuetify.breakpoint.mdAndUp}">
      <Banner/>
      <v-container fluid grid-list-md>
        <v-layout row wrap>
          <v-flex d-flex xs12 sm6 lg3 px2 v-for="(item, i) in itemVignettes" :key="i">
            <vue-flip :active-hover="true" width="100%" height="250px" transition="0.7s">
              <div slot="front">
                <v-icon style="font-size: 110px">{{ item.icon }}</v-icon>
                <div v-html="item.title"/>
              </div>
              <div slot="back">
                <div v-html="item.text"/>
                <v-btn color="success" @click="link(item.name)">En savoir plus</v-btn>
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
export default class Activites extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  link (link: string) {
    this.$router.push({ name: link })
  }

  created () {
    this.setDrawer(true)
  }

  itemVignettes: any = [
    {
      icon: 'mdi-calendar green--text',
      title: 'Planning',
      text: 'A chacun son ou ses créneaux',
      name: 'Planning'
    },
    {
      icon: 'mdi-baby blue--text',
      title: 'Baby Ping',
      text: 'A partir de 4 ans',
      name: 'BabyPing'
    },
    {
      icon: 'mdi-heart pink--text',
      title: 'Ping Santé',
      text: 'La pratique du tennis de table est utilisée dans un cadre médical, notamment dans la prévention de maladies',
      name: 'PingSante'
    },
    {
      icon: 'mdi-walk pink--text',
      title: 'Loisirs',
      text: 'La pratique du tennis de table est à tous âges',
      name: 'Loisirs'
    },
    {
      icon: 'mdi-wheelchair-accessibility green--text',
      title: 'Handisport',
      text: 'La pratique du tennis de table est ouverte à tous valide ou non',
      name: 'Handisport'
    },
    {
      icon: 'mdi-pokeball red--text',
      title: 'Section<br />Sportive',
      text: 'Pour le collégien du Dolet',
      name: 'SectionSportive'
    },
    {
      icon: 'mdi-beach yellow--text',
      title: 'Pendant les vacances',
      text: 'Du Tennis de Table<br />pendant les vacances',
      name: 'pendantLesVacances'
    },
    {
      icon: 'mdi-account-group',
      title: 'Stages Multisports',
      text: 'Du Tennis de Table<br />pendant les vacances',
      name: 'StagesMultisports'
    },
    {
      icon: 'mdi-account-card-details',
      title: 'Coaching<br />Personnalisé',
      text: 'Comment progresser<br />au Tennis de Table',
      name: 'CoachingPersonnalise'
    },
    {
      icon: 'mdi-beer amber--text',
      title: 'Soirée<br />Entreprise',
      text: 'soirées originales',
      name: 'SoireeEntreprise'
    },
    {
      icon: 'mdi-human-male-female',
      title: 'Famille',
      text: 'Comment progresser<br />au Tennis de Table',
      name: 'Famille'
    },
    {
      icon: 'mdi-theme-light-dark white--text',
      title: 'Dark Ping',
      text: 'Le Tennis de Table<br />dans le noir',
      name: 'DarkPing'
    },
    {
      icon: 'mdi-new-box blue white--text',
      title: 'Nouvelles Pratiques',
      text: 'Du Tennis de Table<br />sous tous les formes',
      name: 'NouvellesPratiques'
    },
    {
      icon: 'mdi-soccer white--text',
      title: 'Headis',
      text: 'Du Tennis de Table<br />avec la tête',
      name: 'Headis'
    },
    {
      icon: 'mdi-eye-settings',
      title: 'Changeons de regard',
      text: 'Du Tennis de Table<br />et le handicap',
      name: 'ChangeonsDeRegard'
    },
    {
      icon: 'mdi-guy-fawkes-mask',
      title: 'Rentree en fête',
      text: 'Du Tennis de Table<br />avec la ville',
      name: 'RentreeEnFete'
    },
    {
      icon: 'mdi-run-fast',
      title: 'Orleans Mouv',
      text: 'Du Tennis de Table<br />dans les quartiers',
      name: 'OrleansMouv'
    },
    {
      icon: 'mdi-school',
      title: 'Challenge inter-écoles',
      text: 'Du Tennis de Table<br />dans les écoles',
      name: 'ChallengeInterEcoles'
    },
    {
      icon: 'mdi-currency-eur',
      title: 'Telethon',
      text: 'Du Tennis de Table<br />pour tous',
      name: 'Telethon'
    },
    {
      icon: 'mdi-city',
      title: 'UrbanPing',
      text: 'Ping Tour',
      name: 'UrbanPing'
    },
    {
      icon: 'mdi-information',
      title: 'Formations',
      text: 'Des formations à tout âge',
      name: 'Formations'
    }]
}
</script>

<style lang="scss" scoped>

/deep/ .flip-container .flipper {
  white-space: normal;
  font-size: 48px;
  line-height: 48px;
  font-weight: 400;
  transition: none;
  letter-spacing: 2px;
  text-shadow: black 0.1em 0.1em 0.2em;
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
  background-color: #FF3434;
  color: white;
  text-align: center;
}
</style>
