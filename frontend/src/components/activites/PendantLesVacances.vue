<template>
  <div class="pendant-les-vacances">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <div class="posts__item posts__item--card card">
        <figure class="posts__thumb"><img src="http://stmarceautt.fr/img/galerie/Harismendy.jpg" border="0"
                                          title="Image: http://stmarceautt.fr/img/galerie/Harismendy.jpg">
        </figure>
        <div class="card__header"><h4>La salle harismendy reste ouverte pendant les vacances</h4></div>
        <div class="card__content"><p>

        </p>
          <h3>
            <small>A tous les adhérents de l'association. Ils peuvent être accompagnés d'une à deux
              personnes non
              membre.
            </small>
          </h3>
          <div class="clearfix"></div>
          <div class="col-sm-4 col-lg-3">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title text-center" id="panel-title1">Mardi</h3>
              </div>
              <div class="panel-body">
                <p class="text-center"><span class="glyphicon glyphicon-time"></span> 13h30 à 16h<br>
                  <small>avec les loisirs de l’après-midi</small>
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-lg-3">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title text-center" id="panel-title1">Vendredi</h3>
              </div>
              <div class="panel-body">
                <p class="text-center"><span class="glyphicon glyphicon-time"></span> 13h30 à 16h<br>
                  <small>avec les loisirs de l’après-midi</small>
                </p>
              </div>
            </div>
          </div>

          <div class="clearfix"></div>
          <p>A compter du 9 juillet et jusqu'au 31 août, la salle sera ouverte les mardis et vendredis de
            13h30 à 16h30
            sauf les :
          </p>
          <ul>
            <li>mardi 24 juillet</li>
            <li>mardi 31 juillet</li>
            <li>vendredi 3 août</li>
            <li>mardi 7 août</li>
            <li>vendredi 10 août</li>
          </ul>
          <p></p>
          <div class="alert alert-success" role="alert">
            Retrouvez le plan de la salle harismendy <a href="localisation">ICI</a></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class PendantLesVacances extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
