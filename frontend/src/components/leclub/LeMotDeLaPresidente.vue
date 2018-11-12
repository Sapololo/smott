<template>
  <div class="le-mot-de-la-presidente">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout class="container page wrap pb-5" style="transform-origin: center top 0px;">
        <v-flex xs12 md9>
          <h1>NOUVELLE SAISON, NOUVEAUX PROJETS</h1>
          <h3 color>
            <v-icon class="mdi mdi-check-outline red--text"></v-icon>
            Faire monter le niveau des équipes et des joueurs
          </h3>
          <p>Thomas LIN, classé N°670 Français, vient de nous rejoindre et aidera les meilleurs joueurs du
            club à
            progresser et à monter notre équipe de pré-nationale en National 3.</p>
          <h3>
            <v-icon class="mdi mdi-check-outline red--text"></v-icon>
            Jeunes : nouveaux rythmes scolaires.
          </h3>
          <p>Le vendredi,
            l’école se termine à 15h30. Nous allons ouvrir un nouveau créneau d’entrainement pour accueillir
            les
            scolaires qui souhaitent devenir adhérents au club.</p>
          <h3>
            <v-icon class="mdi mdi-check-outline red--text"></v-icon>
            Jeunes : TAP (temps activité périscolaires)
          </h3>
          <p>Sébastien
            sera à harismendy de 15h45 à 16h45 les lundis, mardis et jeudis, à entraîner les jeunes des
            écoles du
            quartier.</p>
          <h3>
            <v-icon class="mdi mdi-check-outline red--text"></v-icon>
            Jeunes
          </h3>
          <p>Les ateliers éducatifs continuent les lundis,
            mardis et jeudis midi dans 3 écoles.</p>
          <h3>
            <v-icon class="mdi mdi-check-outline red--text"></v-icon>
            Sport-handicap
          </h3>
          <p>Renouvellement des 2 journées « changez
            de regard » en collaboration avec la Ville d’Orléans pour permettre à tous d’appréhender le
            handicap.
            Nous
            accueillerons à nouveau Florian MERRIEN &amp; Julien BOCHEREAU.</p>
          <h3>
            <v-icon class="mdi mdi-check-outline red--text"></v-icon>
            Sport-urbain
          </h3>
          <p>Faire vivre notre quartier tout en
            faisant découvrir au plus grand nombre notre sport. Certains samedis, de 14 à 17h, en fonction
            de la
            météo
            et des bénévoles du club, nous descendrons nos tables dans la rue, à l’arrêt de tram de la Croix
            St
            Marceau.</p>
          <h3>
            <v-icon class="mdi mdi-check-outline red--text"></v-icon>
            Sport-communication
          </h3>
          <p>Mise en place de la nouvelle
            version de notre site : plus de clarté, plus d’infos, plus de rapidité.</p>
          <h3>
            <v-icon class="mdi mdi-check-outline red--text"></v-icon>
            Sport Famille
          </h3>
          <p>Samedi matin, de 10 à 12h, parents et
            enfants. Il suffit d’un seul adhérent au club.</p>
          <h3>
            <v-icon class="mdi mdi-check-outline red--text"></v-icon>
            Horaires d’entraînements
          </h3>
          <p>le plus large possible pour
            tous, y compris pendant les vacances scolaires.</p>
          <p>Bien sportivement.</p>
        </v-flex>
        <v-flex md3 hidden-sm-and-down>
          <img src="/img/galerie/2017/titre-loiret/small/small_titres-2017-66.jpg"
               border="0">
        </v-flex>
        <v-flex xs12>
          <v-layout class="justify-center">
            <v-flex xs12 sm10 md8>
              <div class="alpha-testimonial">
                <v-footer>
                  <div class="alpha-testimonial__footer-bar primary"></div>
                  <div class="headline">Marylène Lablée</div>
                  <div class="title">Présidente</div>
                </v-footer>
              </div>
            </v-flex>
          </v-layout>
        </v-flex>
      </v-layout>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class LeMotDeLaPresidente extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
<style lang="scss" scoped>

.alpha-testimonial__content {
  -webkit-box-align: start;
  -ms-flex-align: start;
  align-items: flex-start;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: justify;
  -ms-flex-pack: justify;
  justify-content: space-between;
}

.alpha-testimonial__footer-bar {
  height: 4px;
  margin: 20px 0 20px auto;
  width: 100px;
}

.alpha-testimonial .icon {
  -webkit-box-pack: end;
  -ms-flex-pack: end;
  justify-content: flex-end;
  -webkit-box-flex: 0;
  -ms-flex: 0 1 10%;
  flex: 0 1 10%;
  margin-top: -8px;
}

.alpha-testimonial p {
  -webkit-box-flex: 1;
  -ms-flex: 1 1 85%;
  flex: 1 1 85%;
  line-height: 2;
}

.alpha-testimonial footer {
  -webkit-box-flex: 1;
  -ms-flex: 1 0 auto;
  flex: 1 0 auto;
  text-align: right;
  display: block;
}

.alpha-testimonial footer .title {
  font-weight: 300;
}
</style>
