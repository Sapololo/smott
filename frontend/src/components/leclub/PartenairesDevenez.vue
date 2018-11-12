<template>
  <div class="nos-partenaires">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>

      <v-layout row column>
        <v-flex xs12 sm6>
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>c'est</v-toolbar-title>
          </v-toolbar>
          <v-card>
            <v-card-text class="font-weight-bold display-1">Pour être ambitieux et proposer des activités de qualité,
              SMOTT a besoin d'un socle solide de
              partenaires. Afin de satisfaire ces premiers soutiens, le club met en place plusieurs prestations tout au
              long de l'année. Suivez le guide ...
            </v-card-text>
            <v-card-text class="title font-weight-regular">Sans eux, pas de tennis de table pour tous possible à
              Orléans. Indispensables pour la
              pérennité et le développement du club, les partenaires de <span
                  class="primary--text">Saint Marceau Orléans Tennis de Table</span> sont aussi ses premiers supporters. Aussi,
              pour les remercier de leur soutien actif, <span class="primary--text">Saint Marceau Orléans Tennis de Table</span>
              leur propose plusieurs
              avantages en termes de visibilité et d'opérations publiques. En conséquence, le club se fait fort d'être
              un facilitateur de contacts et donne la possibilité à ses partenaires de s'ouvrir à de nouveau marchés et
              en rencontrant les décideurs locaux déjà présents soutenant <span
                  class="primary--text">Saint Marceau Orléans Tennis de Table</span>.
            </v-card-text>
            <v-card-text class="title font-weight-regular"><h3 class="primary--text">des avantages
              multiples ...</h3><br/>Plusieurs solutions s'offrent aux partenaires en termes de visibilité. Ils peuvent
              ainsi apposer leur nom et leur logo sur les panneaux publicitaires dans les salles tout au long de
              l'année et s'assurer ainsi une notoriété auprès de plusieurs centaines de participants. Leur entreprise
              peut aussi figurer dans l'annuaire officiel des partenaires et leur logo s'afficher sur le site internet
              du club, visité par des milliers de personnes par an. Des événements sont également organisés chez les
              partenaires du club pour faire découvrir leur activité.
            </v-card-text>
            <v-card-text class="font-weight-bold display-1 primary--text">
              <v-icon color="red" class="display-3">mdi-format-quote-open</v-icon>
              <v-icon color="red" class="display-1">mdi-chevron-double-left</v-icon>
              Développer un réseau, une notoriété et renforcer son image
              <v-icon color="red" class="display-1">mdi-chevron-double-right</v-icon>
              <v-icon color="red" class="display-3">mdi-format-quote-close</v-icon>
            </v-card-text>
            <v-card-text class="title font-weight-regular"><h3 class="primary--text">... et des soirées
              conviviales</h3><br/>Nos actions peuvent devenir un spectacle à part. Pour vivre pleinement, en famille,
              entre amis et/ou dans un cercle professionnel. <span
                  class="primary--text">SMOTT</span> offres à ses partenaires les meilleures conditions
              d'acceuil possibles.
            </v-card-text>
            <v-card-text class="title font-weight-bold">Si vous souhaitez devenir partenaire, contactez Pierre
              Vacquet par mail (stmarceau.tt@free.fr)
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import VueFlip from 'vue-flip'

@Component({ components: { Banner, VueFlip } })
export default class NosPartenaires extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>

<style lang="scss" scoped>
.img_fit {
  border-style: none;
  background-size: cover;
  width: 100%;
  height: 250px;
  margin: 0;
  padding: 0;
  -webkit-background-size: cover;
  background-size: cover;
}

/deep/ .flip-container .flipper {
  white-space: normal;
  font-size: 48px;
  line-height: 48px;
  font-weight: 400;
  transition: none;
  letter-spacing: 2px;
  text-shadow: black 0.1em 0.1em 0.2em;
}

/deep/ .flip-container .flipper .front {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  background-color: #fff;
  color: white;
}

/deep/ .flip-container .flipper .back {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  background-color: #FF3434;
  color: white;
  text-align: center;
}
</style>
