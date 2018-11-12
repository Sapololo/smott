<template>
  <div class="qui-fait-quoi">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <div class="posts__item posts__item--card card">
        <figure class="posts__thumb"><img src="/img/pages/orleans-mouv.jpg" alt="orleans mouv'"></figure>
        <div class="card__content"><h4>Activités multi-sports pour les adolescents des quartiers Argonne,
          Blossières et
          La Source.</h4>
          <p>Le Club de Saint Marceau Orléans Tennis de Table est partenaire d'Orléans Mouv'</p></div>
      </div>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class OrleansMouv extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
