<template>
  <div class="administration">
    <div class="row main-wrapper"
         :class="{'drawermenu-open': !DrawerMini && DrawerDisplay && $vuetify.breakpoint.mdAndUp}">
      <Banner/>
      <v-container fluid grid-list-md>
        <v-layout row wrap>
          <v-flex d-flex xs6 sm6 lg3 px2 v-for="(item, i) in itemVignettes" :key="i"
                  v-if="$permission.isRole(item.roles)">
            <vue-flip :active-hover="true" width="100%" height="250px" transition="0.7s">
              <div slot="front">
                <v-icon style="font-size: 110px">{{ item.icon }}</v-icon>
                <div v-html="item.title"/>
              </div>
              <div slot="back">
                <div v-html="item.text"/>
                <v-btn color="success" @click="link(item.name)" v-if="item.name">En savoir plus</v-btn>

                <v-btn color="success" v-if="item.lien"><a :href="item.lien" class="white--text"
                                                  target="_blank">En savoir plus</a></v-btn>
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
export default class Administration extends Vue {
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
      icon: 'mdi-account-group purple--text',
      title: 'Gestion Adhérents',
      text: 'Gestion des Adhérents',
      name: 'Adherents',
      roles: ['ROLE_BUREAU', 'ROLE_ADMIN']
    },
    {
      icon: 'mdi-at brown--text',
      title: 'ListeEmail',
      text: 'Liste des Emails',
      name: 'ListeEmail',
      roles: ['ROLE_BUREAU', 'ROLE_ADMIN']
    },
    {
      icon: 'mdi-bank light-green--text',
      title: 'Releves',
      text: 'Releves',
      name: 'Releves',
      roles: ['ROLE_BUREAU', 'ROLE_ADMIN']
    },
    {
      icon: 'mdi-counter indigo--text',
      title: 'Ecritures',
      text: 'Ecritures',
      name: 'Ecritures',
      roles: ['ROLE_ADMIN']
    },
    {
      icon: 'mdi-user indigo--text',
      title: 'Ecritures Adherent',
      text: 'Ecritures  Adherent',
      name: 'EcrituresAdherent',
      params: { licenceId: '3412268' },
      roles: ['ROLE_BUREAU', 'ROLE_ADMIN']
    },
    {
      icon: 'mdi-bank-transfer-in blue--text',
      title: 'Remises',
      text: 'Remises',
      name: 'Remises',
      roles: ['ROLE_BUREAU', 'ROLE_ADMIN']
    },
    {
      icon: 'mdi-bank-transfer-out red--text',
      title: 'Compte de résultats',
      text: 'Compte de résultats',
      name: 'CompteResultat',
      roles: ['ROLE_BUREAU', 'ROLE_ADMIN']
    },
    {
      icon: 'mdi-google-analytics orange--text',
      title: 'Google Analystics',
      text: 'Verifier la notoriété du site',
      lien: 'https://analytics.google.com/analytics/web/?authuser=1#/report-home/a35276216w63037954p64639485',
      roles: ['ROLE_BUREAU', 'ROLE_ADMIN']
    }
  ]
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
