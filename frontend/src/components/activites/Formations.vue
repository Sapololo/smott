<template>
  <div class="formations">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-flex xs12>
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>LES FORMATIONS FFTT - arbitrage</v-toolbar-title>
        </v-toolbar>
        <v-card>
          <v-card-text>
            <h3>
              <v-icon>mdi-arrow-right-thick</v-icon>
              Arbitre Régional
            </h3>
            <p>La <b>formation d’Arbitre de club</b> se déroule sur 4h et correspond au 1er niveau de
              formation, il
              s’agit
              d’une initiation aux premières règles. Le coût de cette formation est prise en charge par le
              club (10€).
              Elle se met en place à la demande d’un club.</p>
            <h3>
              <v-icon>mdi-arrow-right-thick</v-icon>
              La formation d’Arbitre Régional est le 2è niveau de formation
            </h3>
            <p>Cette formation se compose d’<b>1 journée en présentiel</b> avec ours et passage de l’examen
              théorique
              puis
              la validation du grade se fait par une pratique (journée) lors d’une compétition officielle
              avec un
              formateur pour vous évaluer.
            <p>
            <p>L’examen théorique est noté sur 30 points (30 questions), il faut obtenir 24 points pour
              obtenir la
              théorie
              de l’Arbitre Régional. Si vous obtenez entre 20 et 24 points vous serez Arbitre de Club. En
              dessous il
              faudra repasser la journée de formation.</p>
            <p>Le coût de la formation est de 25€ – repas midi compris, pris en charge aussi par le club</p>
            <h3>
              <v-icon>mdi-arrow-right-thick</v-icon>
              Juge Arbitre 1er degré
              Championnat par équipes
            </h3>
            <p>Le JA1 est le Juge qui officie en Championnat par équipes (Pro A à Départemental). Il a une
              mission
              importante de faire respecter les reglements, suivre et ordonner la feuille de match,
              organiser
              l’arbitrage
              des parties.</p>
            <p>La formation se déroule en 2 temps : le premier est <b>1 journée de formation en
              présentiel</b> avec un
              test théorique en fin de journée. Les reçus à la théorie se voient proposer <b>une demi
                journée</b> de
              pratique sous couvert d’un formateur.</p>
            <p>Le coût de la formation est de 30€ – repas compris</p>
            <h3>
              <v-icon>mdi-arrow-right-thick</v-icon>
              Juge Arbitre 2è et 3è degré
              Critérium Fédéral et Tournois
            </h3>
            <p>Le JA2 est le Juge qui officie lors des tours du Critérium Fédéral. Il est en mesure
              d’organiser un
              tournoi
              de ce type à partir des outils qui lui sont présentés.</p>
            <p>Cette formation est couplée dans la Ligue du Centre avec le JA3, qui est le Juge qui officie
              pour les
              Tournois. Cela permet de pouvoir officier sur toutes les épreuves organisées sur le
              territoire.</p>
            <p>La formation se déroule sur 2 jours en présentiel (un WE) puis le passage d’une pratique
              réelle sous la
              tutelle d’un formateur.</p>
            <p>Coût de la formation : 60€ en pension complète</p>
          </v-card-text>
        </v-card>
      </v-flex>
      <v-flex xs12>
        <v-toolbar flat dense color="primary">
          <v-toolbar-title>LES FORMATIONS FFTT - encadrant</v-toolbar-title>
        </v-toolbar>
        <v-card>
          <v-card-text>
            <h3>
              <v-icon>mdi-arrow-right-thick</v-icon>
              Animateur Fédéral
            </h3>
            <p>La <b>formation Animateur Fédéral</b> est ouverte à tous les licenciés de la FFTT.</p>
            <p>C’est le second niveau de formation technique. Il permet d’acquérir des connaissances et
              compétences sur
              l’activité tennis de table : les différents publics, les techniques d’animation et
              d’organisation de
              séances. On aborde également les principes techniques de l’activité pour mieux la
              comprendre.</p>

            <h3>
              <v-icon>mdi-arrow-right-thick</v-icon>
              Entraîneur Fédéral
            </h3>
            <p>La <b>formation Entraîneur Fédéral</b> est le 3è niveau des formations techniques.</p>
            <p>Elle vise les compétences d’entraîneur autonome dans un club avec la capacité d’entraîner un
              joueur vers
              la performance.</p>
            <p>On y aborde les techniques et principes d’entraînement, les exigences et les qualités à
              travailler :
              physique, mental…</p>
          </v-card-text>
        </v-card>
      </v-flex>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component({ components: { Banner } })
export default class Formations extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
