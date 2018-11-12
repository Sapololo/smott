<template>
  <div class="drawer-menu" v-if="DrawerDisplay">
    <v-navigation-drawer app fixed stateless :mini-variant.sync="mini" :value="Drawer"
                         class="grey lighten-4 sidebar-smott" clipped>
      <!--<v-toolbar flat dense flat class="transparent" v-on:mouseover="showAlert('true')" v-on:mouseleave="showAlert('false')">-->
      <v-toolbar flat dense class="transparent" v-on:mouseover="showAlert('true')" v-on:mouseleave="showAlert('false')">
        <v-list pa-0>
          <v-list-tile avatar>
            <v-list-tile-avatar>
              <v-icon>{{ title.icon }}</v-icon>
            </v-list-tile-avatar>
            <v-list-tile-content>
              <v-list-tile-title>{{ title.title }}</v-list-tile-title>
            </v-list-tile-content>
            <v-list-tile-action>
              <v-btn icon @click.native.stop="mini=!mini">
                <v-icon>mdi-chevron-left</v-icon>
              </v-btn>
            </v-list-tile-action>
          </v-list-tile>
        </v-list>
      </v-toolbar>
      <v-list>
        <v-list-group
            v-for="item in items"
            v-model="item.active"
            :key="item.title"
            :prepend-icon="item.iconalt"
            no-action
        >
          <v-list-tile slot="activator" dense>
            <v-list-tile-content>
              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-list-tile v-for="subItem in item.children" :key="subItem.title"
                       @click="link(subItem.name, subItem.params)"
                       v-if="$permission.isRole(subItem.roles)"
                       dense>

            <v-list-tile-content>
              <v-list-tile-title>{{ subItem.title }}</v-list-tile-title>
            </v-list-tile-content>
            <v-list-tile-avatar>
              <v-icon>{{ subItem.icon }}</v-icon>
            </v-list-tile-avatar>
          </v-list-tile>
        </v-list-group>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Watch } from 'vue-property-decorator'
import { MutationDrawer, GetterDrawer } from '@/store/drawer'
import { Route } from 'vue-router'

export interface DrawerTitle {
  title: string
  icon: string
}

export interface DrawerItem {
  title: string
  titleShort: string
  icon: string
  iconalt: string
  // onClick (): void
  active?: boolean
  children: any[]
}

@Component
export default class DrawerMenu extends Vue {
  title: DrawerTitle = { title: '', icon: '' }
  titleLeClub: DrawerTitle = { title: 'Le Club', icon: 'mdi-animation green--text' }
  titleCompetition: DrawerTitle = { title: 'Compétitions', icon: 'mdi-animation' }
  titleActivites: DrawerTitle = { title: 'Activités', icon: 'mdi-animation' }
  titleAdmin: DrawerTitle = { title: 'Admin', icon: 'mdi-animation' }

  items: DrawerItem[] = []
  itemsLeClub: DrawerItem[]
  itemsCompetition: DrawerItem[]
  itemsActivites: DrawerItem[]
  itemsAdmin: DrawerItem[]

  beforeCreate () {
    this.itemsLeClub = [
      {
        title: 'Le Club',
        titleShort: '',
        icon: 'mdi-chevron-down',
        iconalt: 'mdi-deskphone red--text',
        active: true,
        children: [
          {
            icon: 'mdi-google-maps blue--text',
            title: 'Localisation',
            name: 'Localisation',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-currency-eur red--text',
            title: 'Les cotisations',
            name: 'LesCotisations',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-calendar lime--text',
            title: 'Calendrier',
            name: 'Calendrier',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-newspaper orange--text',
            title: 'Revue de presse',
            name: 'RevueDePresse',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-image teal--text',
            title: 'Affiches',
            name: 'Affiches',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-video amber--text',
            title: 'Videos',
            name: 'Videos',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-image-multiple purple--text',
            title: 'Photos',
            name: 'Photos',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-chart-bar brown--text',
            title: 'Statistiques',
            name: 'Statistiques',
            params: { clubId: '04450026' },
            roles: ['ROLE_USER']
          }]
      },
      {
        title: 'Le Bureau',
        titleShort: '',
        icon: 'mdi-chevron-down',
        iconalt: 'mdi-deskphone',
        active: false,
        children: [
          {
            icon: 'mdi-textbox-password  pink--text',
            title: 'Le mot de la présidente',
            name: 'LeMotDeLaPresidente',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-account-group',
            title: 'Le bureau',
            name: 'LeBureau',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-help',
            title: 'Qui fait quoi ?',
            name: 'QuiFaitQuoi',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-account-card-details',
            title: 'Cadres sportifs',
            name: 'CadresSportifs',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-pillar brown--text',
            title: 'Statuts',
            name: 'Statuts',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-altimeter pink--text',
            title: 'Règlement intérieur',
            name: 'ReglementInterieur',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-history brown--text',
            title: 'Légendes',
            name: 'Legendes',
            roles: ['ROLE_USER']
            // },
            // {
            //   icon: 'mdi-account-search',
            //   title: 'Trombinoscope',
            //   name: 'Trombinoscope'
          }]
      },
      {
        title: 'Patenaires',
        titleShort: '',
        icon: 'mdi-chevron-down',
        iconalt: 'mdi-google-circles-extended',
        active: false,
        children: [
          {
            icon: 'mdi-thumb-up blue--text',
            title: 'Nos partenaires',
            name: 'NosPartenaires',
            roles: ['ROLE_USER']
          },

          {
            icon: 'mdi-thumb-up blue--text',
            title: 'Etre partenaire',
            name: 'DevenezPartenaires',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-map-marker-radius red--text',
            title: 'Carte des partenaires',
            name: 'CarteDesPartenaires',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-help green--text',
            title: 'Ping sans frontières',
            name: 'PingSansFrontieres',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-label purple--text',
            title: 'Labels',
            name: 'Labels',
            roles: ['ROLE_USER']
          }]
      }
    ]
    this.itemsCompetition = [
      {
        title: 'FFTT',
        titleShort: '',
        icon: 'mdi-chevron-down',
        iconalt: 'mdi-deskphone',
        active: true,
        children: [
          {
            icon: 'mdi-account-search',
            title: 'Recherche',
            name: 'Recherche',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-chart-bar',
            title: 'Les licenciés du club',
            name: 'LesLicencesDuClub',
            params: { clubId: '04450026' },
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-account-multiple',
            title: 'Les équipes',
            name: 'Equipe',
            params: { clubId: '04450026', num: 1 },
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-fire amber--text',
            title: 'Brûlages',
            name: 'Brulages',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-whistle blue--text',
            title: 'Arbitres et Juge-arbitres',
            name: 'ArbitresEtJugeArbitres',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-image-filter-frames',
            title: 'Cadres',
            name: 'Cadres',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-newspaper',
            title: 'Actualités FFTT',
            name: 'Actualites',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-human-handsup',
            title: 'Individuel',
            name: 'Individuel',
            roles: ['ROLE_USER']
          }]
      },
      {
        title: 'Les Equipes Séniors',
        titleShort: '',
        icon: 'mdi-chevron-down',
        iconalt: 'mdi-google-circles-extended',
        active: false,
        children: [
          {
            icon: 'mdi-thumb-up blue--text',
            title: 'PRENATIONALE',
            name: 'Equipe',
            params: { num: 1 },
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-thumb-up blue--text',
            title: 'REGIONALE 1',
            name: 'Equipe',
            params: { num: 2 },
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-thumb-up blue--text',
            title: 'REGIONALE 3 Eqp3',
            name: 'Equipe',
            params: { num: 3 },
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-thumb-up blue--text',
            title: 'REGIONALE 3 Eqp4',
            name: 'Equipe',
            params: { num: 4 },
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-thumb-up blue--text',
            title: 'DEPARTEMENTALE 3 Eqp5',
            name: 'Equipe',
            params: { num: 5 },
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-thumb-up blue--text',
            title: 'DEPARTEMENTALE 3 Eqp6',
            name: 'Equipe',
            params: { num: 6 },
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-thumb-up blue--text',
            title: 'DEPARTEMENTALE 5',
            name: 'Equipe',
            params: { num: 7 },
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-thumb-up blue--text',
            title: 'DEPARTEMENTALE 6',
            name: 'Equipe',
            params: { num: 8 },
            roles: ['ROLE_USER']
          }]
      },
      {
        title: 'Les Equipes Vétérans',
        titleShort: '',
        icon: 'mdi-chevron-down',
        iconalt: 'mdi-google-circles-extended',
        active: false,
        children: [
          {
            icon: 'mdi-thumb-up blue--text',
            title: 'D1 VETERANS Eqp1',
            name: 'Equipe',
            params: { num: 10 },
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-thumb-up blue--text',
            title: 'D1 VETERANS Eqp2',
            name: 'Equipe',
            params: { num: 11 },
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-thumb-up blue--text',
            title: 'D3 VETERANS',
            name: 'Equipe',
            params: { num: 12 },
            roles: ['ROLE_USER']
          }]
      },
      {
        title: 'Les Equipes Jeunes',
        titleShort: '',
        icon: 'mdi-chevron-down',
        iconalt: 'mdi-google-circles-extended',
        active: false,
        children: [
          {
            icon: 'mdi-thumb-up green--text',
            title: 'Equipe 1',
            name: 'Equipe',
            params: { num: 13 },
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-thumb-up green--text',
            title: 'Equipe 2',
            name: 'Equipe',
            params: { num: 14 },
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-thumb-up green--text',
            title: 'Equipe 3',
            name: 'Equipe',
            params: { num: 15 },
            roles: ['ROLE_USER']
          }]
      }]

    this.itemsActivites = [
      {
        title: 'Quotidiennes',
        titleShort: '',
        icon: 'mdi-chevron-down',
        iconalt: 'mdi-calendar-clock',
        active: true,
        children: [
          {
            icon: 'mdi-calendar green--text',
            title: 'Planning',
            text: 'A chacun son ou ses créneaux',
            name: 'Planning',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-baby blue--text',
            title: 'Baby Ping',
            text: 'A partir de 4 ans',
            name: 'BabyPing',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-pokeball red--text',
            title: 'Section Sportive',
            text: 'Pour le collégien du Dolet',
            name: 'SectionSportive',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-heart pink--text',
            title: 'Ping Santé',
            text: 'La pratique du tennis de table est utilisée dans un cadre médical, notamment dans la prévention de maladies',
            name: 'PingSante',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-walk pink--text',
            title: 'Loisirs',
            text: 'La pratique du tennis de table est à tous âges',
            name: 'Loisirs',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-wheelchair-accessibility green--text',
            title: 'Handisport',
            text: 'La pratique du tennis de table est ouverte à tous valide ou non',
            name: 'Handisport',
            roles: ['ROLE_USER']
          }]
      },
      {
        title: 'Périodes Scolaires',
        titleShort: '',
        icon: 'mdi-chevron-down',
        iconalt: 'mdi-school',
        children: [
          {
            icon: 'mdi-beach yellow darken-4-text',
            title: 'Pendant les vacances',
            text: 'Du Tennis de Table<br />pendant les vacances',
            name: 'PendantLesVacances',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-account-group',
            title: 'Stages Multisports',
            text: 'Du Tennis de Table<br />pendant les vacances',
            name: 'StagesMultisports',
            roles: ['ROLE_USER']
          }]
      },
      {
        title: 'Evénementielles',
        titleShort: '',
        icon: 'mdi-chevron-down',
        iconalt: 'mdi-calendar-check',
        children: [
          {
            icon: 'mdi-account-card-details',
            title: 'Coaching Personnalisé',
            text: 'Comment progresser<br />au Tennis de Table',
            name: 'CoachingPersonnalise',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-beer amber--text',
            title: 'Soirée Entreprise',
            text: 'soirées<br />originales',
            name: 'SoireeEntreprise',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-human-male-female',
            title: 'Famille',
            text: 'Comment progresser<br />au Tennis de Table',
            name: 'Famille',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-theme-light-dark black white--text',
            title: 'Dark Ping',
            text: 'Le Tennis de Table<br />dans le noir',
            name: 'DarkPing',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-new-box blue white--text',
            title: 'Nouvelles Pratiques',
            text: 'Du Tennis de Table<br />pendant les vacances',
            name: 'NouvellesPratiques',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-soccer grey--text',
            title: 'Headis',
            text: 'Du Tennis de Table<br />pendant les vacances',
            name: 'Headis',
            roles: ['ROLE_USER']
          }]
      },
      {
        title: 'Actions',
        titleShort: '',
        icon: 'mdi-chevron-down',
        iconalt: 'mdi-ticket',
        children: [
          {
            icon: 'mdi-eye-settings',
            title: 'Changeons De Regard',
            text: 'Du Tennis de Table<br />pendant les vacances',
            name: 'ChangeonsDeRegard',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-guy-fawkes-mask',
            title: 'Rentree en Fête',
            text: 'Du Tennis de Table<br />pendant les vacances',
            name: 'RentreeEnFete',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-run-fast',
            title: 'Orleans Mouv',
            text: 'Du Tennis de Table<br />dans les quartiers',
            name: 'OrleansMouv',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-school',
            title: 'Challenge Inter Ecoles',
            text: 'Du Tennis de Table<br />dans les écoles',
            name: 'ChallengeInterEcoles',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-currency-eur',
            title: 'Telethon',
            text: 'Du Tennis de Table<br />pendant les vacances',
            name: 'Telethon',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-city',
            title: 'UrbanPing',
            text: 'Du Tennis de Table<br />pendant les vacances',
            name: 'UrbanPing',
            roles: ['ROLE_USER']
          },
          {
            icon: 'mdi-information',
            title: 'Formations',
            text: 'Du Tennis de Table<br />pendant les vacances',
            name: 'Formations',
            roles: ['ROLE_USER']
          }]
      }

    ]
    this.itemsAdmin = [
      {
        title: 'Le Club',
        titleShort: '',
        icon: 'mdi-chevron-down',
        iconalt: 'mdi-deskphone red--text',
        active: true,
        children: [
          {
            icon: 'mdi-account-group purple--text',
            title: 'Gestion Adhérents',
            name: 'Adherents',
            roles: ['ROLE_BUREAU', 'ROLE_ADMIN']
          },
          {
            icon: 'mdi-at brown--text',
            title: 'Liste des Emails',
            name: 'ListeEmail',
            roles: ['ROLE_BUREAU', 'ROLE_ADMIN']
          }]
      },
      {
        title: 'La Compta',
        titleShort: '',
        icon: 'mdi-chevron-down',
        iconalt: 'mdi-calculator pink--text',
        active: true,
        children: [
          {
            icon: 'mdi-bank light-green--text',
            title: 'Releves',
            name: 'Releves',
            roles: ['ROLE_BUREAU', 'ROLE_ADMIN']
          },
          {
            icon: 'mdi-counter indigo--text',
            title: 'Ecritures',
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
          }]
      },
      {
        title: 'Outil',
        titleShort: '',
        icon: 'mdi-chevron-down',
        iconalt: 'mdi-settings-outline teal--text',
        active: true,
        children: [
          {
            icon: 'mdi-google-analytics orange--text',
            title: 'Google Analystics',
            text: 'Verifier la notoriété du site',
            lien: 'https://analytics.google.com/analytics/web/?authuser=1#/report-home/a35276216w63037954p64639485',
            roles: ['ROLE_BUREAU', 'ROLE_ADMIN']
          }]
      }
    ]
  }

  @GetterDrawer
  Drawer: {
    (Drawer: boolean): void
  }

  @GetterDrawer
  DrawerMini: {
    (DrawerMini: boolean): void
  }

  @GetterDrawer
  DrawerDisplay: {
    (DrawerDisplay: boolean): void
  }

  @MutationDrawer
  setDrawer: (Drawer: boolean | null) => any

  @MutationDrawer
  setDrawerMini: (DrawerMini: boolean | null) => any

  mini: boolean = false

  drawer: boolean = true

  // @Watch('drawer', { immediate: true })
  // onDrawerChange (drawer: boolean) {
  //   this.setDrawer(drawer)
  // }

  hover: boolean = false

  link (link: string, parametres?: any) {
    this.$router.push({ name: link, params: parametres })
  }

  @Watch('mini', { immediate: true })
  onMiniChange (mini: boolean) {
    this.setDrawerMini(mini)
    this.gestionList()
    // if (mini === true && this.items.length > 0) {
    //   for (var i = 0, l = this.items.length; i < l; i++) {
    //     this.items[i].active = false
    //   }
    // } else if (mini === false && this.items.length > 0) {
    //   this.items[0].active = true
    // }
  }

  // @Watch('hover', { immediate: true })
  // onMiniChange (hover: boolean) {
  //   if (hover === true) {
  //     this.mini = false
  //   } else {
  //     this.mini = true
  //   }
  //   this.setDrawerMini(this.mini)
  // }

  @Watch('$route', { immediate: true })
  onRouteChange (value: Route | Route) {
    let open: boolean = true
    if (value.fullPath.indexOf('competition') === 1) {
      this.items = this.itemsCompetition
      this.title = this.titleCompetition
    } else if (value.fullPath.indexOf('leclub') === 1 || value.fullPath.indexOf('article') === 1) {
      this.items = this.itemsLeClub
      this.title = this.titleLeClub
    } else if (value.fullPath.indexOf('activites') === 1) {
      this.items = this.itemsActivites
      this.title = this.titleActivites
    } else if (value.fullPath.indexOf('admin') === 1) {
      this.items = this.itemsAdmin
      this.title = this.titleAdmin
    } else {
      open = false
    }
    if (value.name !== 'home') {
      document.title = value.meta.title + ' - Saint Marceau Orléans Tennis de Table - stmarceautt.fr'
    }
    this.mini = !open
    this.setDrawerMini(this.mini)
    this.$forceUpdate()
  }

  showAlert (value: string) {
    if (value === 'true') {
      this.hover = true
    } else {
      this.hover = false
    }
  }

  gestionList () {
    let i: number = 0
    let l: number = 0
    if (this.mini === true && this.items.length > 0) {
      for (i = 0, l = this.items.length; i < l; i++) {
        this.items[i].active = false
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.sidebar-smott {
  box-shadow: 6px 0 25px 0 rgba(38, 50, 56, .2);
}

.toolbar::before {
  display: none;
}

</style>
