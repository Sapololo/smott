<template>
  <div class="qui-fait-quoi">
    <div class="row main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <div class="card">
        <div class="card__header">
          <h4>Au fur et à mesure, le tennis de table continue d'évoluer et principalement à lors de
            l'apparition du
            caoutchouc</h4></div>
        <div class="card__content"><p>De nouvelles variantes du tennis de table sont praticables en club.</p>
          <p>En voici quelques unes.</p></div>
      </div>
    </div>
    <div class="content">
      <div class="posts posts--cards post-grid row">
        <div class="post-grid__item col-sm-4">
          <div class="posts__item posts__item--card card">
            <figure class="posts__thumb">
              <img data-src="/img/hardbat-classic-logo.jpg" id="hardbat-classic-logo"
                   src="/img/hardbat-classic-logo.jpg" alt="hardbat-classic-logo"
                   title="hardbat-classic-logo"></figure>
            <div class="posts__inner card__content"><p>A première vue, rien ne semble différencier le
              hardbat du tennis
              de table. La table est la même, les coups se ressemblent, les joueurs ont quasiment la même
              gestuelle...
              Et pourtant, les deux sports sont bien différents. C’est en fait dans la raquette que réside
              tout la
              subtilité du hardbat. Là où les joueurs de tennis de balle ont un choix quasiment illimité
              de bois, de
              mousses et de revêtements qui rendent le jeu très rapide, les pratiquants du hardbat
              disposent de
              raquettes “à revêtements picots courts sans mousse”. Pour schématiser, leurs raquettes
              ressemblent à
              celles qui étaient utilisées au tennis de table dans les années 50. Forcément, les effets
              sont moins
              prononcés, les attaques moins puissantes ... et les points plus difficiles à marquer. Une
              variante idéale
              pour les pongistes qui veulent découvrir de nouvelles sensations et revenir aux sources du
              tennis de
              table.</p></div>
            <div class="group-item"></div>
          </div>
        </div>

        <div class="post-grid__item col-sm-4">
          <div class="posts__item posts__item--card card">
            <figure class="posts__thumb"><img data-src="/img/sandpaper-racket.jpg"
                                              id="Saint-Marceau-Orléans-Tennis-de-Table-salle-Harismendy-Gymnase-Cigogne-2015-04-03-00:00:00"
                                              src="/img/sandpaper-racket.jpg"
                                              alt="Championnat Régional Domicile Gymnase de la cigogne à Saint Marceau Orléans Tennis de Table - Copyright stmarceautt.fr">
            </figure>
            <div class="posts__inner card__content"><p>Le sandpaper est une discipline apparentée au
              hardbat, où les
              raquettes sont recouvertes de papier de verre. Les parties se jouent en 2 manches gagnantes
              de 15 points,
              sans point d’écart et sans temps mort. Chaque joueur peut demander l’application de la règle
              du double une
              fois dans la partie : sur son propre service et si son score n’est pas supérieur à 12
              points, un joueur
              peut demander le double point. S’il remporte l’échange, il marque deux points. Dans le cas
              contraire, son
              adversaire ne marque qu’un point.</p></div>
            <div class="group-item"></div>
          </div>
        </div>

        <div class="post-grid__item col-sm-4">
          <div class="posts__item posts__item--card card">
            <figure class="posts__thumb"><img data-src="/img/headis-logo.jpg"
                                              id="Saint-Marceau-Orléans-Tennis-de-Table-salle-Harismendy-Gymnase-Cigogne-2015-04-03-00:00:00"
                                              src="/img/headis-logo.jpg"
                                              alt="Championnat Régional Domicile Gymnase de la cigogne à Saint Marceau Orléans Tennis de Table - Copyright stmarceautt.fr">
            </figure>
            <div class="posts__inner card__content"><p>Pratique hybrid entre le football et le tennis de
              table.</p>
            </div>
            <div class="group-item"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'

import { GetterDrawer, MutationDrawer } from '@/store/drawer'

@Component
export default class NouvellesPratiques extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }
}
</script>
