<template>
  <div class="famille">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <div class="card">
        <div class="card__header">
          <h4>Le samedi de 10h à midi, le tennis de table en famille, c’est convivial</h4></div>
        <div class="card__content">
          <p>Papa, maman, familles et même avec des amis, c’est à la salle Harismendy 8 av. Alain Savary dans
            le
            quartier St Marceau.</p>
          <div class="col-xs-4 col-md-2">
            <div class="panel panel-success text-center">
              <div class="panel-heading"><h3 class="panel-title">Séance libre</h3></div>
              <div class="panel-body"><p><span class="glyphicon glyphicon-time">&nbsp;Samedi<br>10h à 12h</span>
              </p>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <p>La salle harismendy est accessible pendant les autres créneaux, dans la limite des tables
            restantes.</p>
          <p>Pendant les vacances scolaires, des créneaux sont aussi mis à la disposition des adhérents, et
            non
            adhérents.</p></div>
      </div>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class Famille extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
