<template>
  <div class="joueur">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <JoueurDetail :licenceId="licenceId" v-if="licenceId"/>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue, Inject } from 'vue-property-decorator'
import { RawLocation } from 'vue-router'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import { GetterAuth } from '@/store/auth'
import JoueurDetail from '@/components/competition/JoueurDetail.vue'

@Component({ components: { Banner, JoueurDetail } })
export default class Joueur extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @MutationSnackbar
  setSnackbarEntry: (entry: SnackbarEntry) => void

  @GetterAuth
  authenticated: boolean

  licenceId: string = ''
  async mounted () {
    if (!this.authenticated) {
      Vue.nextTick(() => {
        this.setSnackbarEntry({
          color: 'error',
          icon: 'mdi-alert-decagram',
          message: `Vous devez être connecté pour voir le détail de ce joueur ! Vous pouvez faire votre demande par mail à stmarceau.tt@free.fr`
        })
      })
      this.$router.push({ name: 'Home' } as RawLocation)
    } else {
      this.licenceId = this.$route.params.licenceId
    }
  }
}
</script>

<style lang="scss" scoped>
/deep/ table.v-table thead td:not(:nth-child(1)), table.v-table tbody td:not(:nth-child(1)), table.v-table thead th:not(:nth-child(1)), table.v-table tbody th:not(:nth-child(1)), table.v-table thead td:first-child, table.v-table tbody td:first-child, table.v-table thead th:first-child, table.v-table tbody th:first-child {
  padding: 0 5px;
}

.main-wrapper-desktop {
  padding: 30px 30px 30px 30px !important;
}

.main-wrapper-mobile {
  padding: 30px 0px 30px 0px !important;
}

</style>
