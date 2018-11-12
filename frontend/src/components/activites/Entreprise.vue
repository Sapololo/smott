<template>
  <div class="entreprise">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <p>L'association propose aux CE (Comité d'Etablisssement) différentes formules.</p>
      <p>Nous prenons en charge l’organisation partielle ou totale de votre opération événementielle. Par
        l'intermédiaire d'une opération de notoriété, par exemple cérémonie de remise de prix, création d'un
        événement
        sportif.</p>
      <p>L'installation de la salle pour votre événement, en passant par la mise en place d'un buffet, nous
        pouvons
        répondre à toutes vos demandes.</p>
    </div>
  </div>

</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class Entreprise extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
