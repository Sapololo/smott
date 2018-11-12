<template>
  <div class="boutique">
    <div class="row main-wrapper" style="padding: 30px 30px 30px 30px;">
      <Banner/>
      <v-container fluid grid-list-md>
        <v-layout row wrap>
          <v-flex d-flex xs12 sm3 lg3 px-1 style="height: 500px;">
            <vue-flip :active-hover="true" class="flipMaillot" width="100%" height="100%">
              <div slot="front">
                <img v-bind:src="'/img/accueil/xero.png'" class="img_fit"/>
              </div>
              <div slot="back">
                Maillot du Club<br/>22 €<br/>Butterfly
              </div>
            </vue-flip>
          </v-flex>

          <v-flex d-flex xs12 sm3 lg3 px-1 style="height: 500px;">
            <vue-flip :active-hover="true" class="flipMaillot" width="100%" height="100%">
              <div slot="front">
                <img v-bind:src="require('@/assets/img/boutique/materiel-1.jpg')" class="img_fit"/>
                <div class="overlay">
                  <div class="text"><h6>Raquette perfectionnement</h6></div>
                </div>
              </div>
              <div slot="back"><p>Revêtements UPGRADE (ITTF). Bonne adhérence. 2 mm.</p>
                <p>
                  <v-btn color="success"
                         href="http://www.wsport.com/catalogue/?todo=aff_items&grp=120120"
                         target="_blank">En savoir plus
                  </v-btn>
                </p>
                <p>Marque</p>
                <p>TIBHAR SAMSONOV TRIPLE X</p>
                <p>25.95 €</p></div>
            </vue-flip>
          </v-flex>

          <v-flex d-flex xs12 sm3 lg3 px-1 style="height: 500px;">
            <vue-flip :active-hover="true" class="flipMaillot" width="100%" height="100%">
              <div slot="front">
                <img v-bind:src="require('@/assets/img/boutique/materiel-2.jpg')" class="img_fit"/>
                <div class="overlay">
                  <div class="text"><h6>Raquette loisir</h6></div>
                </div>
              </div>
              <div slot="back"><p>Revêtements Banco Start déjà adhérents. Pour un bon apprentissage.</p>
                <p>
                  <v-btn color="success"
                         href="http://www.wsport.com/catalogue/?todo=aff_items&grp=120912"
                         target="_blank">En savoir plus
                  </v-btn>
                </p>
                <p>Marque</p>
                <p>RAQ. BANCO CADET </p>
                <p>20 €</p></div>
            </vue-flip>
          </v-flex>

          <v-flex d-flex xs12 sm3 lg3 px-1 style="height: 500px;">
            <vue-flip :active-hover="true" class="flipMaillot" width="100%" height="100%">
              <div slot="front">
                <img v-bind:src="require('@/assets/img/boutique/materiel-3.jpg')" class="img_fit"/>
                <div class="overlay">
                  <div class="text"><h6>Balles plastique Sans couture d'entraînement</h6></div>
                </div>
              </div>
              <div slot="back"><p>Balles plastique Sans couture !</p>
                <p>Ne peuvent pas être utilisées en compétitions.</p>
                <p>
                  <v-btn color="success"
                         href="http://www.wacksport.fr/catalogue/?todo=aff_items&grp=510136&qty="
                         target="_blank">En savoir plus
                  </v-btn>
                </p>
                <p>Marque</p>
                <p>THIBAR - Quantité 72 </p>
                <p>55 €</p></div>
            </vue-flip>
          </v-flex>

          <v-flex d-flex xs12 sm3 lg3 px-1 style="height: 500px;">
            <vue-flip :active-hover="true" class="flipMaillot" width="100%" height="100%">
              <div slot="front">
                <img v-bind:src="require('@/assets/img/boutique/materiel-4.jpg')" class="img_fit"/>
                <div class="overlay">
                  <div class="text"><h6>Balles plastique Sans couture de compétitions</h6></div>
                </div>
              </div>
              <div slot="back"><p>Balles plastique Sans couture !</p>
                <p>Peuvent être utilisées en compétitions</p>
                <p>
                  <v-btn color="success"
                         href="http://www.wacksport.fr/catalogue/?todo=aff_items&grp=510130&qty="
                         target="_blank">En savoir plus
                  </v-btn>
                </p>
                <p>Marque</p>
                <p>THIBAR - Quantité 72 </p>
                <p>115 €</p></div>
            </vue-flip>
          </v-flex>
        </v-layout>
      </v-container>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../components/Banner.vue'
import VueFlip from 'vue-flip'

@Component({ components: { Banner, VueFlip } })
export default class Boutique extends Vue {
}
</script>

<style lang="scss" scoped>
/* The overlay effect (full height and width) - lays on top of the container and over the image */
.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 1;
  transition: .3s ease;
  background-color: rgba(0, 0, 0, .5);
}

/deep/ .flip-container .flipper {
  white-space: normal;
  font-size: 40px;
  line-height: 40px;
  font-weight: 400;
  transition: none;
  letter-spacing: 2px;
  text-shadow: black 0.1em 0.1em 0.2em;
  text-align: center;
  transition: 0.7s;
  .btn {
    bottom: -20px;
  }
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
  background-color: #ff3434;
  color: white;
  font-size: 24px;
  line-height: 24px;
  font-weight: 300;
}
</style>
