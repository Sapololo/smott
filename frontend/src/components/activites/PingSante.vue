<template>
  <div class="ping-sante">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>

      <v-toolbar flat dense color="primary">
        <v-toolbar-title>Sport Santé - Le tennis de table se vit au quotidien</v-toolbar-title>
      </v-toolbar>
      <v-layout row>
        <v-flex d-flex xs12 md8>
          <v-layout column>
          <v-card>
            <v-card-text>
              <p>Reconnue pour ses vertus de récupération, la pratique du tennis de table est
                utilisée dans un cadre médical, notamment dans la prévention de maladies.</p>
              <p>Saint Marceau Tennis de Table s'inscrit dans le cadre du développement du «Sport
                Santé» pour offrir aux personnes qui ont été touchées par le cancer; par exemple; comme
                structure
                d’accueil pour faire de l’activité physique et sportive une composante essentielle du
                parcours de vie.</p>
            </v-card-text>
          </v-card>
          <v-toolbar flat dense color="primary">
            <v-toolbar-title>Essais scientifiques</v-toolbar-title>
          </v-toolbar>
          <v-card>
            <v-card-text>
              <p>Depuis le milieu des années 2000, de nombreuses études scientifiques démontrent
                qu’une activité physique, suffisamment intense, régulière et encadrée par des professionnels
                formés, a un
                impact bénéfique
                réel pour les personnes atteintes de cancer, aussi bien pendant la phase de la maladie,
                qu’après la
                maladie en prévention tertiaire.</p>
            </v-card-text>
          </v-card>
            <v-toolbar flat dense color="primary">
              <v-toolbar-title>Témoignage d'Aline</v-toolbar-title>
            </v-toolbar>
            <v-card>
              <v-card-text>
              <p>Je m'appelle Aline Morin j'ai 64 ans .Jai commencé à prendre du poids pendant
                mes grossesses et je n'ai jamais pratiqué d'activités sportives même étant enfant. De ce
                fait j'ai entamé
                tous les régimes qui existent même les plus farfelus. Dans ma vie professionnelle j'ai
                toujours travaillé
                en horaires décalés et même de nuit .Il est souvent arrivé que je ne savais plus où j'en
                étais. Les 15
                dernières années de carrière je faisais les 2/8 avec 20 minutes de pause pour les
                repas.Alors quand la
                faim se faisait trop sentir je buvais de l'eau (environ 4l par jour),et je sautais de
                nombreux repas .
                Mais je prenais de plus en plus de poids. Je suis allée voir un endocrinologue, qui après
                étude de mes
                habitudes m'a dit que mon corps était épuisé par les privations ,et de ce fait il m'a
                conseillé de faire
                une chirurgie bariatrique. La sleeve était indiquée dans mon cas car je ne grignote pas.</p>
              <p>J'ai été opérée le 7 septembre 2016 et on m'a coupé 3/4 de l'estomac. Je devais
                prendre de nouvelles habitudes alimentaires, mais cela ne se fait pas tout seul. En plus il
                faut se
                bouger. Mais quand on fait 130kg pas facile à faire. J'ai longtemps cherché une activité
                sportive qui
                conviendrait à mon état jusqu'au jour où un mail m'est parvenu au mois de mars m'invitant à
                essayer le
                ping santé à Saint Marceau. J'y suis allée pour voir si cette activité ( car je ne voulais
                pas le type gym
                au sol trop de mal à me relever).</p>
              <p>J'ai fais une séance en expliquant mon état de santé et mes problèmes de poids
                et de genou. Depuis tous les mardi , je retrouve Sébastien, mon coach qui me fait faire des
                exercices afin
                de retrouver la souplesse dans les articulations, la respiration, l'endurance, la situation
                dans l'espace
                et la vivacité par le tennis de table. Il m'apprend aussi à me réapproprier de mon corps car
                dans la tête
                l'image n'est pas toujours exacte. Je dois préciser que j'ai perdu 40kg,et sans cette
                activité je crois
                que physiquement je n'en serai pas où j'en suis actuellement. Récemment j'ai réussi à suivre
                un groupe de
                marcheurs pendant 12km dans les Vosges et même si j'en ai bavé je n'en reviens pas moi même.
                Je suis contente d'avoir trouvé cette structure associative qui m'aide à retrouver le
                bonheur de
                vivre.</p>
              <p>Merci à tous de m'avoir encouragé et surtout Sébastien de me supporter.</p>
              <p class="text-xs-right title">Aline</p>
            </v-card-text>
          </v-card>
          </v-layout>
        </v-flex>
        <v-flex d-flex xs12 md4>
          <v-layout row wrap>
            <v-flex d-flex xs12 class="text-xs-center">
              <v-layout column justify-space-between fill-height>
                <v-card color="blue darken-3">
                  <v-card-text>
                    <h1 class="white--text">Séance dirigée</h1>
                    <h2 class="white--text">Mardi</h2>
                    <p class="white--text">
                      <v-icon class="mdi mdi-clock white--text">mdi-clock-outline</v-icon>
                      13h30 à 15h30
                    </p>
                    <v-divider color="white"></v-divider>
                    <h2 class="white--text">Nombre d'aldutes</h2>
                    <p class="white--text">
                      <v-icon class="mdi mdi-clock white--text">mdi-human-child</v-icon>
                      1 à 16 personnes
                    </p>
                    <v-divider color="white"></v-divider>
                    <h2 class="white--text">Tarif Annuel</h2>
                    <p class="white--text">120
                      <v-icon class="mdi mdi-clock white--text">mdi-currency-eur</v-icon>
                    </p>
                  </v-card-text>
                  <v-card-media><v-img src="/img/pages/pingsante.jpg"/></v-card-media>
                </v-card>
              </v-layout>
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
export default class PingSante extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
