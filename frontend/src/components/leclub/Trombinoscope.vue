<template>
  <div class="trombinoscope">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">

    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'

import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component
export default class Trombinoscope extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
