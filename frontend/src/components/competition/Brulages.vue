<template>
  <div class="qui-fait-quoi">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Inject, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import ApiService from '@/services/api'
import FfttResource from '@/api/resources/fftt'
import BrulageModel from '@/api/model/brulage'

@Component({ components: { Banner } })
export default class Brulages extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @Inject()
  ffttResource: FfttResource

  @Inject()
  api: ApiService

  brulagesA: BrulageModel[] | null = null

  async beforeMount () {
    this.brulagesA = await this.ffttResource.brulages('04450026')
  }
}
</script>
