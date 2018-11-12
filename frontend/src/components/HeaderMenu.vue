<template>
  <div class="header-menu">
    <login v-if="!authenticated"/>
    <div class="header-menu__desktop" v-if="$vuetify.breakpoint.mdAndUp">

      <v-toolbar color="primary" app dark clipped-left elevation fixed light white>
        <router-link to="/" tag="v-flex" dark class="logoBox secondary shrink"
                     style="cursor: pointer">
          <img src="../assets/logo.png" class="logo">
        </router-link>
        <v-toolbar-items>
          <router-link v-for="(item, index) in menuItems" :key="index" :to="item.route"
                       v-if="$permission.isRole(item.roles)"
                       class="header-menu__desktop-button" active-class="active">
            <div class="header-menu__desktop-button-content">
              {{ item.title }}
            </div>
          </router-link>
          <router-link to="Boutique"
                       class="header-menu__desktop-button" active-class="active">
            <div class="header-menu__desktop-button-content">
              <v-icon color="white">mdi-cart</v-icon>
            </div>
          </router-link>
        </v-toolbar-items>
        <v-spacer/>
        <v-flex shrink class="mr-2 adresse" v-if="$vuetify.breakpoint.lgAndUp && !authenticated">
          <v-icon>mdi-map-marker</v-icon>
          8 RUE ALAIN SAVARY, 45100 ORLEANS<br/>
          <v-icon>mdi-phone</v-icon>
          02.38.51.91.60
        </v-flex>
        <v-flex shrink class="mr-2" v-if="$vuetify.breakpoint.lgAndUp">
          <v-tooltip bottom>
            <v-btn fab light small slot="activator" @click="setDialogAppLogin(true)" v-if="!authenticated">
              <v-icon color="secondary">mdi-account-outline</v-icon>
            </v-btn>
            <span>S'identifier</span>
          </v-tooltip>
          <v-tooltip bottom>
            <v-btn dark color="info" slot="activator" @click="setDialogAppContact(true)">Contactez-nous
            </v-btn>
            <span><v-icon color="white">mdi-email-outline</v-icon>stmarceau.tt@free.fr</span>
          </v-tooltip>
        </v-flex>
        <v-flex shrink class="mr-0" v-if="authenticated">
          <v-menu>
            <v-flex shrink>

            </v-flex>
          </v-menu>
        </v-flex>
        <v-flex shrink class="mr-0" v-if="authenticated">
          <v-layout row class="user-menu">
            <v-menu v-if="$permission.isRole(['ROLE_ADMIN'])"
                transition="slide-y-transition"
                bottom
            >
              <v-btn flat slot="activator" icon>
                <v-badge overlap color="white">
                  <span slot="badge" class="red--text">3</span>
                  <v-avatar
                      class="purple red--after"
                  >
                    <v-icon dark>mdi-bell-ring</v-icon>
                  </v-avatar>
                </v-badge>
              </v-btn>
              <v-list>
                <!--<v-list-tile-->
                    <!--v-for="(item, i) in items"-->
                    <!--:key="i"-->
                    <!--@click=""-->
                <!--&gt;-->
                  <!--<v-list-tile-title>{{ item.title }}</v-list-tile-title>-->
                <!--</v-list-tile>-->
              </v-list>
            </v-menu>
            <v-flex>
              <v-layout column style="position: relative;top:50%;transform: translateY(-50%);">
                <span class="subheading pl-3">{{userDisplayName}}</span>
                <span class="caption pl-3">{{userEmail}}</span>
              </v-layout>
            </v-flex>
            <v-flex>
              <v-menu transition="slide-y-transition"
                      bottom left min-width="400px">
                <v-btn icon slot="activator" dark>
                  <v-icon class="user-arrow-dropdown">mdi-menu-down</v-icon>
                </v-btn>
                <v-list>
                  <v-list-tile v-for="(item, i) in userdropdownItems" :key="i"
                               v-if="$permission.isRole(item.roles)"
                               @click="item.onClick()">
                    <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                  </v-list-tile>
                </v-list>
              </v-menu>
            </v-flex>
          </v-layout>
        </v-flex>
      </v-toolbar>
    </div>
    <div class="header-menu__mobile" v-else>
      <transition name="slide-y-transition">
        <v-toolbar flat dense dark app class="mobile-toolbar shadow-toolbar">
          <v-toolbar-side-icon @click.stop="drawerVisible = !drawerVisible"/>
        </v-toolbar>
      </transition>
      <v-navigation-drawer touchless dark app v-model="drawerVisible"
                           v-touch="{parent: true, left: () => drawerVisible = false}">
        <v-layout>
          <v-flex>
            <v-card flat>
              <div class="gradiant"></div>
              <v-img :src="require('../assets/img/error-bg.jpg')" height="150px"
                     style="background-size: cover;">
                <v-layout fill-height style="z-index:2;" column v-if="authenticated">
                  <v-flex>
                    <div class="user-picture">
                      <v-icon>mdi-account</v-icon>
                    </div>
                  </v-flex>
                  <v-flex>
                    <v-layout row>
                      <v-flex>
                        <v-layout column>
                          <span class="subheading pl-3">{{userDisplayName}}</span>
                          <span class="caption pl-3">{{userEmail}}</span>
                        </v-layout>
                      </v-flex>
                      <v-spacer/>
                      <v-flex>
                        <v-menu bottom left min-width="400px">
                          <v-btn icon slot="activator" dark>
                            <v-icon class="user-arrow-dropdown">mdi-menu-down</v-icon>
                          </v-btn>
                          <v-list>
                            <v-list-tile v-for="(item, i) in userdropdownItems" :key="i"
                                         @click="item.onClick()">
                              <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                            </v-list-tile>
                          </v-list>
                        </v-menu>
                      </v-flex>
                    </v-layout>
                  </v-flex>
                </v-layout>
              </v-img>
            </v-card>
          </v-flex>
        </v-layout>
        <v-list class="pt-0 menu-list">
          <router-link is="v-list-tile" v-for="(item, index) in menuItems" :key="index" :to="item.route">
            <v-list-tile-content>
              <v-list-tile-title class="text-xs-right caption" style="color:white!important;">
                {{ item.title }}
              </v-list-tile-title>
            </v-list-tile-content>
            <v-list-tile-action>
              <v-icon color="grey darken-2">{{ item.icon }}</v-icon>
            </v-list-tile-action>
          </router-link>
          <router-link is="v-list-tile" name="Boutique">
            <v-list-tile-content>
              <v-list-tile-title class="text-xs-right caption" style="color:white!important;">
                Boutique
              </v-list-tile-title>
            </v-list-tile-content>
            <v-list-tile-action>
              <v-icon color="grey darken-2">mdi-cart</v-icon>
            </v-list-tile-action>
          </router-link>
          <v-list-tile @click="dialogLoginValue=true" v-if="!authenticated">
            <v-list-tile-content>
              <v-list-tile-title class="text-xs-right caption" style="color:white!important;">
                Se connecter
              </v-list-tile-title>
            </v-list-tile-content>
            <v-list-tile-action>
              <v-icon color="grey darken-2">mdi-account-outline</v-icon>
            </v-list-tile-action>
          </v-list-tile>
          <span class="menu-list__footer">
            <v-divider/>
            <v-list-tile>
              <v-list-tile-content>
                <v-list-tile-title class="text-xs-right caption" style="color:white!important;">
                  <img src="../assets/logo.png" style="height: 100%;background-size: cover;">
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </span>
        </v-list>
      </v-navigation-drawer>
    </div>
    <!--<v-toolbar flat dense class="header__top-bar"  color="secondary" app dark clipped-left elevation fixed light white>-->
    <!--<v-flex xs4></v-flex>-->
    <!--</v-toolbar>-->
  </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator'
import { RawLocation } from 'vue-router'
import Login from './Login.vue'
import { GetterAuth, Payload, StateAuth } from '@/store/auth'
import { GetterDialogApp, MutationDialogApp } from '@/store/dialogApp'

export interface MenuItem {
  title: string
  titleShort: string
  icon: string
  route: RawLocation | string
  roles: string[]
  exact?: boolean
}

export interface DropdownItem {
  title: string
  roles: string[]

  onClick (): void
}

@Component({ components: { Login } })
export default class HeaderMenu extends Vue {
  dialogLogin: boolean = false
  drawerVisible: boolean = false
  @GetterAuth
  authenticated: boolean

  @StateAuth
  payload: Payload | Payload

  @Prop({ default: () => [] })
  menuItems: MenuItem[]

  @Prop({ default: () => [] })
  userdropdownItems: DropdownItem[]

  @MutationDialogApp
  setDialogAppLogin: { (login: boolean): void }

  @GetterDialogApp
  DialogAppLogin: { (login: boolean): void }

  @MutationDialogApp
  setDialogAppContact: { (contact: boolean): void }

  @GetterDialogApp
  DialogAppContact: { (contact: boolean): void }

  get userDisplayName (): string | undefined {
    return this.payload ? this.payload.username : undefined
  }

  get userEmail (): string | undefined {
    return this.payload ? this.payload.email : undefined
  }

  login (): void {
    this.$router.push({ name: 'Login' })
  }
}
</script>

<style lang="scss" scoped>
.menu-list__footer {
  position: absolute;
  width: 100%;
  bottom: 0;
}

.header-menu__mobile {
  .logo {
    position: absolute;
    left: 0;
    top: 50%;
    margin-top: -16px;
    width: 100px;
    z-index: 50;
  }

  .gradiant {
    position: absolute;
    height: 100%;
    width: 100%;
    z-index: 1;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0) 60%, #424242 98%, #424242 100%);
  }

  .user-picture {
    border: solid white 4px;
    border-radius: 9999px;
    height: 70px;
    width: 70px;
    background-color: #20AB72;
    margin-top: 20px;
    margin-left: 20px;

    > i {
      font-size: 4.5em;
      position: relative;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      border-bottom-left-radius: 9999px;
      border-bottom-right-radius: 9999px;
      border: solid transparent 7px;
      height: calc(100% - 5px);
      width: calc(100% - 5px);
      overflow: hidden;
      user-select: none;
      cursor: initial;
    }
  }

  .user-arrow-dropdown {
    position: relative;
    user-select: none;
    cursor: pointer;
  }

  .list__tile--active i {
    color: #20AB72 !important;
  }

  .shadow-toolbar {
    box-shadow: initial;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.65) 0%, rgba(0, 0, 0, 0) 100%) !important;
  }
}

/deep/ .v-toolbar__content {
  padding: 0 0 0 0 !important;
}

/deep/ .v-toolbar__content > *:first-child.v-btn--icon, .v-toolbar__extension > *:first-child.v-btn--icon {
  margin-left: 17px;
}

@media only screen and (max-width: 1500px) {
  .adresse {
    visibility: hidden;
  }
}

.header__top-bar {
  background: #131929;
  height: 60px;
  display: -ms-flexbox;
  display: flex;
  padding-right: 15px;
  padding-left: 15px;
  position: relative
}

@media screen and (min-width: 530px) {
  .header__top-bar {
    padding-right: 30px;
    padding-left: 30px
  }
}

@media screen and (min-width: 850px) {
  .header__top-bar {
    z-index: 2
  }
}

.header__top-bar.has-accordion-open {
  z-index: 50
}
</style>
