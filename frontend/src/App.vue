<template>
  <v-app id="app">
    <contact/>
    <header-menu :menuItems="menuItems" :userdropdownItems="userDropdownItems" v-if="!getRouteExcluded()"/>
    <v-content ref="content">
      <transition mode="out-in">
        <router-view/>
      </transition>
    </v-content>
    <v-footer class="primary container fluid" style="height: auto;" v-if="!getRouteExcludedFooter()">
      <v-layout fill-height row wrap darken-2>
        <v-flex xs12 md6
                :class="{'drawermenu-open': !DrawerMini && DrawerDisplay, 'footer-menu__drawer-menu': DrawerMini && DrawerDisplay}">
          <div class="white--text text-xs-left card card--flat card--tile primary">
            Saint Marceau Orléans Tennis de Table - Salle Thierry Harismendy<br/>
            <v-icon class="white--text">mdi-map-marker</v-icon>&nbsp;8 rue Alain Savary - 45100 ORLEANS<br/>
            <v-icon class="white--text">mdi-phone</v-icon>&nbsp;02.38.51.91.60<br/>
            <v-icon class="white--text">mdi-email</v-icon>&nbsp;
            <a class="white--text" href="mailto:stmarceau.tt@free.fr">stmarceau.tt@free.fr</a>
          </div>
        </v-flex>
        <v-flex md6 v-if="$vuetify.breakpoint.mdAndUp" class="footer-menu">
          <v-toolbar color="primary">
            <v-spacer></v-spacer>
            <v-toolbar-items>
              <router-link v-for="(item, index) in menuItems" :key="index" :to="item.route"
                           class="footer-menu-button" active-class="active">
                <div class="footer-menu-button-content">
                  {{ item.title }}
                </div>
              </router-link>
              <router-link to="Boutique"
                           class="footer-menu-button" active-class="active">
                <div class="footer-menu-button-content">
                  <v-icon color="white">mdi-cart</v-icon>
                </div>
              </router-link>
            </v-toolbar-items>
          </v-toolbar>
        </v-flex>

        <v-flex xs12 md6
                :class="{'drawermenu-open': !DrawerMini && DrawerDisplay, 'footer-menu__drawer-menu': DrawerMini && DrawerDisplay}">
          <div class="white--text text-xs-left card card--flat card--tile primary">
            <router-link to="MentionsLegales" class="white--text">MENTIONS LÉGALES</router-link>
            | 2018 © SAPOLOLO
          </div>
        </v-flex>
        <v-flex md6 v-if="$vuetify.breakpoint.mdAndUp">
          <div class="white--text text-xs-right card card--flat card--tile primary">
            <v-btn fab light small color="facebook" href="https://www.facebook.com/stmarceautt/" target="_blank">
              <v-icon color="white">mdi-facebook</v-icon>
            </v-btn>
            <v-btn fab light small color="twitter" href="https://twitter.com/stmarceautt" target="_blank">
              <v-icon color="white">mdi-twitter</v-icon>
            </v-btn>
            <v-btn fab light small color="youtube"
                   href="https://www.youtube.com/channel/UCNL4-EI4nLAEQwcm7DYNc4w"
                   target="_blank">
              <v-icon color="white">mdi-youtube-tv</v-icon>
            </v-btn>
            <v-tooltip bottom>
              <v-btn dark color="info" slot="activator" @click="setDialogAppContact(true)">
                Contactez-nous
              </v-btn>
              <span><v-icon color="white">mdi-email-outline</v-icon>stmarceau.tt@free.fr</span>
            </v-tooltip>
          </div>
        </v-flex>

        <snackbar/>
      </v-layout>
    </v-footer>
    <DrawerMenu v-if="!getRouteExcludedDrawerMenu()"/>
  </v-app>
</template>

<script lang="ts">
import { Component, Inject, Vue, Watch } from 'vue-property-decorator'
import AccessService from '@/services/access'
import HeaderMenu, { DropdownItem, MenuItem } from './components/HeaderMenu.vue'
import DrawerMenu from './components/DrawerMenu.vue'
import Contact from '@/components/Contact.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import { GetterDialogApp, MutationDialogApp } from '@/store/dialogApp'
import Snackbar from './components/Snackbar.vue'
import { MutationSnackbar, SnackbarEntry } from './store/snackbar'
import errorHandler from './errorHandler'
import { Route } from 'vue-router'

@Component({ components: { Snackbar, DrawerMenu, HeaderMenu, Contact } })
export default class App extends Vue {
  @Inject()
  access: AccessService

  @MutationDrawer
  setDrawerDisplay: { (display: boolean): void }

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @GetterDrawer
  Drawer: { (drawer: boolean): void }

  @GetterDrawer
  DrawerMini: { (mini: boolean): void }

  @GetterDrawer
  DrawerDisplay: { (mini: boolean): void }

  @MutationSnackbar
  setSnackbarEntry: (entry: SnackbarEntry) => void

  @MutationDialogApp
  setDialogAppLogin: { (login: boolean): void }

  @GetterDialogApp
  DialogAppLogin: { (login: boolean): void }

  @MutationDialogApp
  setDialogAppContact: { (contact: boolean): void }

  @GetterDialogApp
  DialogAppContact: { (contact: boolean): void }

  @Watch('$route', { immediate: true })
  onRouteChange (value: Route | Route) {
    // this.$metaInfo().title = this.$route.meta
  }

  metaInfo () {
    return {
      title: this.$route.meta
    }
  }

  mounted () {
    let path = this.$route.path
    if (path !== '/') {
      this.setDrawer(true)
    } else {
      this.setDrawer(false)
    }

    if (this.$device.mobile) {
      this.setDrawerDisplay(false)
    } else {
      this.setDrawerDisplay(true)
    }
    this.setDialogAppLogin(false)
  }

  menuItems: MenuItem[] = [
    {
      title: 'Le Club',
      titleShort: 'Club',
      icon: 'mdi-pencil',
      route: { name: 'LeClub' },
      roles: ['ROLE_USER']
    },
    {
      title: 'Activités',
      titleShort: 'Activités',
      icon: 'mdi-eye-outline',
      route: { name: 'Activites' },
      roles: ['ROLE_USER']
    },
    {
      title: 'Competitions',
      titleShort: 'Competitions',
      icon: 'mdi-eye-outline',
      route: { name: 'Competitions' },
      roles: ['ROLE_USER']
    },
    {
      title: 'Administration',
      titleShort: 'Administrations',
      icon: 'mdi-eye-outline',
      route: { name: 'Administration' },
      roles: ['ROLE_BUREAU', 'ROLE_ADMIN']
    }
  ]

  userDropdownItems: DropdownItem[] = [
    {
      title: 'Mon profil',
      roles: ['ROLE_USER', 'ROLE_ADMIN'],
      onClick: () => {
        return this.monprofil()
      }
    },
    {
      title: 'Carte des licenciés',
      roles: ['ROLE_USER', 'ROLE_BUREAU', 'ROLE_ADMIN'],
      onClick: () => {
        return this.carteLicencie()
      }
    },
    {
      title: 'Se déconnecter',
      roles: ['ROLE_USER', 'ROLE_ADMIN'],
      onClick: () => {
        return this.logout()
      }
    }
  ]

  async logout () {
    await this.access.logout()
    this.$router.push({ name: 'Home' })
  }

  monprofil (): void {
    this.$router.push({ name: 'MonProfil' })
  }

  carteLicencie (): void {
    this.$router.push({ name: 'CarteLicencie' })
  }

  handleError (err: Error, vm?: any, info?: string) {
    errorHandler(err, vm, info)
  }

  getRouteExcluded () {
    if (this.$route.fullPath.indexOf('login') === 1) {
      return true
    }
    return false
  }

  getRouteExcludedDrawerMenu () {
    if (this.$route.fullPath.indexOf('login') === 1 || this.$route.fullPath.indexOf('monprofil') === 1 || this.$route.fullPath.indexOf('modifier-mot-de-passe') === 13 || this.$route.fullPath.indexOf('Boutique') === 1) {
      return true
    }
    return false
  }

  getRouteExcludedFooter () {
    if (this.$route.fullPath.indexOf('login') === 1) {
      return true
    }
    return false
  }
}
</script>

<style lang="scss" scoped>
.active-view {
  flex-basis: 100%;
}

/deep/ .v-content {
  padding: 0 0 0 0 !important;
}

.footer-menu__drawer-menu {
  padding-left: 80px;
}

.footer-menu {
  /deep/ .v-toolbar {
    webkit-box-shadow: none;
    box-shadow: none;
  }
  /deep/ .v-toolbar__content {
    height: 42px;
  }
  /deep/ a {
    color: #fff;
    text-decoration: none;
    font-style: oblique;
  }
  .footer-menu-button {
    position: relative;
    color: white;
    height: 100%;
    text-decoration: none;
    white-space: nowrap;
    padding: 0 32px;
    .footer-menu-button-content {
      position: relative;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 1.3em;
      letter-spacing: 0.1em;
      font-weight: 400;
      text-transform: uppercase;
    }
  }
  .footer-menu-button::after {
    content: '';
    display: block;
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 0;
    background-color: white;
    transition: height .1s ease-in-out;
  }
  .footer-menu-button:hover::after,
  .footer-menu-button.active::after {
    height: 4px;
  }
  .footer-menu-button.active .footer-menu-button-content {
    font-weight: normal !important;
  }
}
</style>
