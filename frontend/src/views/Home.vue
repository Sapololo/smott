<template>
  <div class="home">
    <v-layout row :class="[$vuetify.breakpoint.mdAndUp ? 'my-1': 'mb-1']">
      <v-flex d-flex xs12 lg12>
        <v-carousel delimiter-icon="fiber_manual_record" prev-icon="mdi-arrow-left-bold-circle"
                    next-icon="mdi-arrow-right-bold-circle" lazy>
          <v-carousel-item
              v-for="(item,i) in carouselItems"
              :key="i"
              :src="item.src"
              transition="fade"
              reverse-transition="fade"
          >
            <v-responsive dark>
              <v-layout wrap>
                <v-flex xs12>
                  <v-layout wrap style="padding-top: 50px;">
                    <v-flex xs12 class="slide_subtitre">{{ item.subtitre }}</v-flex>
                    <v-flex xs12 class="slide_titre" v-html="item.titre"></v-flex>
                    <v-flex xs12 class="slide_subheading" v-html="item.text"></v-flex>
                    <v-flex xs12>
                      <v-divider inset/>
                    </v-flex>
                    <v-flex xs12>
                      <v-btn color="success" @click="link(item.name)" v-if="item.name">En savoir
                        plus
                      </v-btn>
                    </v-flex>
                  </v-layout>
                </v-flex>
              </v-layout>
            </v-responsive>
          </v-carousel-item>
        </v-carousel>
      </v-flex>
    </v-layout>

    <v-layout row app wrap :class="['grey lighten-4', $vuetify.breakpoint.mdAndUp ? 'my-1': 'mb-1']">
      <v-flex xs12 sm6 :class="[$vuetify.breakpoint.mdAndUp ? 'px-1': 'pb-1']">
        <gmap-map
            :center="center"
            :zoom="12"
            style="width:100%;  height: 250px;"
        >
          <gmap-info-window :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen"
                            @closeclick="infoWinOpen=false">
            <div v-html="infoContent"></div>
          </gmap-info-window>
          <gmap-marker :key="i" v-for="(m,i) in markers" :position="m.position" :clickable="true"
                       @click="toggleInfoWindow(m,i)" :icon="m.icon"></gmap-marker>
        </gmap-map>
      </v-flex>
      <v-flex v-for="(item, i) in imageLigne2" :key="i" xs12 sm6 lg3
              :class="[$vuetify.breakpoint.mdAndUp ? 'px-1': 'pb-1']" style="height:250px;">
        <vue-flip :active-hover="true" width="100%" height="100%">
          <div slot="front" style="background-size: cover; width:100%; height:100%;">
            <img v-bind:src="item.src" class="img_fit"/>
            <div class="overlay" v-if="item.overlay">
              <div class="text"><h1>{{ item.titre }}</h1>
                <p>{{ item.text }}</p></div>
            </div>
          </div>
          <div slot="back">
            <div v-if="item.backText" v-html="item.backText"/>
            <v-btn color="success" @click="link(item.link, item.paramLink)" v-if="item.link">En savoir
              plus
            </v-btn>
            <a :href="item.href" target="_blank" download :title="item.hrefTitle" v-if="item.href">
              <v-btn color="success">
                <v-icon>mdi-download</v-icon>
                Télécharger
              </v-btn>
            </a>
          </div>
        </vue-flip>
      </v-flex>
    </v-layout>

    <v-layout row app wrap :class="['grey lighten-4', $vuetify.breakpoint.mdAndUp ? 'my-1':'']">
      <v-flex xs12 v-if="!loadingEvents" class="secondary pa-3"><h1
          class="text-xs-center white--text text-uppercase">Chargement des prochains événements</h1>
        <v-progress-linear :indeterminate="true" color="error"
                           height="10"
                           value="75"></v-progress-linear>
      </v-flex>
      <v-flex v-for="(item, i) in events" :key="i" xs12 sm6 lg3
              :class="[$vuetify.breakpoint.mdAndUp ? 'px-1': 'pb-1']"
              style="height:250px;" v-if="loadingEvents">
        <vue-flip :active-hover="true" width="100%" height="100%">
          <div slot="front" style="background-size: cover; width:100%; height:100%;">
            <img v-bind:src="item.image + '_378x270.jpg'" class="img_fit"/>
            <div class="overlay">
              <div class="text"><h1>{{ item.titre }}</h1>
                <p class="text-capitalize">{{ item.dtdebut.date | moment('dddd D MMMM YYYY') }}</p>
                <p>{{ item.dtdebut.date | moment('H:mm') }}</p>
              </div>
            </div>
          </div>
          <div slot="back">
            <div v-if="item.contenu" v-html="getTruncateContenu(item.contenu)"/>
            <a :href="item.lien" target="_blank" download title="Plus d'information" v-if="item.lien">
              <v-btn color="success">
                Plus d'informations
              </v-btn>
            </a>
            <v-btn color="success" @click="eventLink(item.id)">En savoir plus</v-btn>
          </div>
        </vue-flip>
      </v-flex>
    </v-layout>

    <v-layout row app wrap :class="['grey lighten-4', $vuetify.breakpoint.mdAndUp ? 'my-1': 'mb-1']">

      <v-flex d-flex xs12 sm6 lg6 :class="[$vuetify.breakpoint.mdAndUp ? 'px-1': 'pb-1']">
        <slot v-if="!loadingArticles" transition="fade" name="loading-content">
          <div class="loading-content-div">
            <div class="spinner"></div>
          </div>
        </slot>
        <slot v-if="loadingArticles" transition="fade">
          <v-carousel ref="carousel" delimiter-icon="fiber_manual_record"
                      prev-icon="mdi-arrow-left-bold-circle"
                      next-icon="mdi-arrow-right-bold-circle" lazy>
            <v-carousel-item
                v-for="(item,i) in articles"
                :key="i"
                :src="'/img/galerie/presse/773x408_' + item.image"
                transition="fade"
                reverse-transition="fade"
                style="height:100%;"
            >
              <v-responsive dark>
                <div class="article--badge">La Rep</div>
                <v-container fill-height>
                  <v-layout wrap style="padding-top: 50px;">
                    <v-flex xs12 class="slide_subtitre" style="padding-left: 10px;">{{ item.subtitre
                      }}
                    </v-flex>
                    <v-flex xs12 class="slide_titre" v-html="item.titre"
                            style="padding: 0 10px 0 10px;"></v-flex>
                    <v-flex xs12 class="slide_subheading" style="padding-left: 10px;">{{
                      item.creation }}
                    </v-flex>
                    <v-flex xs12>
                      <v-btn color="success" @click="articleLink(item.id)">En savoir plus</v-btn>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-responsive>
            </v-carousel-item>
          </v-carousel>
        </slot>

      </v-flex>
      <v-flex d-flex xs12 sm3 lg3 :class="[$vuetify.breakpoint.mdAndUp ? 'px-1': 'pb-1']" style="height: 500px;">
        <vue-flip :active-hover="true" class="flipMaillot" width="100%" height="100%">
          <div slot="front">
            <img v-bind:src="'/img/accueil/xero.png'" class="img_fit"/>
          </div>
          <div slot="back"><p>Nouveau Maillot du Club pour les 3 prochaines saisons</p>
            <p>22 €</p>
            <p>Butterfly</p>
          </div>
        </vue-flip>
      </v-flex>
      <v-flex d-flex xs12 sm3 lg3
              :class="{ 'px-1': $vuetify.breakpoint.mdAndUp, 'pb-1': !$vuetify.breakpoint.mdAndUp }">
        <vue-flip :active-hover="true" width="100%" height="100%">
          <div slot="front" style="background-size: cover; width:100%; height:100%;">
            <img v-bind:src="'/img/galerie/affiches/2018_Changeons-de-regard_400.jpg'" class="img_fit"/>
          </div>
          <div slot="back">
            <v-btn color="success" @click="link('ChangeonsDeRegard')">En savoir
              plus
            </v-btn>
          </div>
        </vue-flip>
      </v-flex>
    </v-layout>

    <v-layout row v-if="video && actualitesFftt" app wrap
              :class="['grey lighten-4', $vuetify.breakpoint.mdAndUp ? 'my-1': 'mb-1']">
      <v-flex xs12 sm6 md4 :class="[$vuetify.breakpoint.mdAndUp ? 'px-1': 'pb-1']">
        <v-card>
          <v-img height="235px">
            <iframe style="border:none; background:transparent; overflow:hidden; width:100%;"
                    height="100%" v-bind:src="video.lien" allowfullscreen/>
          </v-img>
        </v-card>
        <v-toolbar flat dense color="secondary">
          <v-toolbar-title>
            <a :href="video.lien" class="white--text"
               target="_blank">{{ video.titre
              }}</a>
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-tooltip bottom>
            <v-btn slot="activator" icon>
              <v-icon color="white" @click="goVideos()">mdi-plus</v-icon>
            </v-btn>
            <span>Plus de vidéos</span>
          </v-tooltip>
        </v-toolbar>

      </v-flex>
      <v-flex xs12 sm6 md4 :class="[$vuetify.breakpoint.mdAndUp ? 'px-1': 'pb-1']"
              v-for="item in actualitesFftt"
              :key="item.id"
      >
        <vue-flip :active-hover="true" width="100%" height="100%">
          <div slot="front" style="background-size: cover; width:100%; height:100%;">
            <v-card>
              <v-img :src="item.photo" height="235px"/>
            </v-card>
            <v-toolbar flat dense color="secondary">
              <v-toolbar-title>
                <a :href="item.url" class="white--text"
                   target="_blank">{{ item.titre }}</a>
              </v-toolbar-title>
            </v-toolbar>
          </div>
          <div slot="back">
            <div v-html="item.titre"/>
            <a :href="item.url" target="_blank" download :title="item.titre" v-if="item.url">
              <v-btn color="success">
                Consulter l'article
              </v-btn>
            </a>
          </div>
        </vue-flip>
      </v-flex>
    </v-layout>

    <v-layout row v-if="loadingPartenaires">
      <v-flex xs12 pb-1>
        <v-toolbar color="primary">
          <v-toolbar-title><span
              class="headline white--text text-xs-center">Merci à tous nos partenaires ...</span>
          </v-toolbar-title>
        </v-toolbar>
        <v-carousel hide-controls hide-delimiters lazy class="carousel-partenaires">
          <v-carousel-item v-for="(item,i) in carouselPartenaire" :key="i">
            <v-layout row style="height: 100%">
              <v-flex v-for="(slide,j) in item.slide" :key="j" v-bind="{ [`xs${slide.taille}`]: true }">
                <a :href="j.lien" target="_blank">
                  <img :src="getImgUrl(slide.src)" :alt="slide.titre" class="img_partenaire">
                </a>
              </v-flex>
            </v-layout>
          </v-carousel-item>
        </v-carousel>

      </v-flex>
    </v-layout>

  </div>
</template>

<script lang="ts">
import { Component, Inject, Vue } from 'vue-property-decorator'
import ApiService from '../services/api'
import { MutationDrawer } from '@/store/drawer'
import ArticleModel from '@/api/model/article'
import ArticleResource from '@/api/resources/article'
import EventModel from '@/api/model/event'
import EventResource from '@/api/resources/event'
import EquipeModel from '@/api/model/equipe'
import EquipeResource from '@/api/resources/equipe'
import PartenaireModel from '@/api/model/partenaire'
import PartenaireResource from '@/api/resources/partenaire'
import VideoModel from '@/api/model/video'
import VideoResource from '@/api/resources/video'
import ActualiteModel from '@/api/model/actualite'
import FfttResource from '@/api/resources/fftt'
import forEach from 'lodash/forEach'
import VueFlip from 'vue-flip'
import GoogleMap from '../components/GoogleMap.vue'

@Component({ components: { GoogleMap, VueFlip } })
export default class Home extends Vue {
  @Inject()
  articleResource: ArticleResource

  @Inject()
  eventResource: EventResource

  @Inject()
  equipeResource: EquipeResource

  @Inject()
  partenaireResource: PartenaireResource

  @Inject()
  videoResource: VideoResource

  @Inject()
  ffttResource: FfttResource

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @Inject()
  api: ApiService

  loadingArticles: boolean = false
  articles: ArticleModel[] = []
  loadingEvents: boolean = false
  events: EventModel[] = []
  equipes: EquipeModel[] = []
  loadingPartenaires: boolean = false
  partenaires: PartenaireModel[] = []
  partenairesFede: PartenaireModel[] = []
  carouselPartenaire: any[] = []
  video: VideoModel | null = null
  actualitesFftt: ActualiteModel[] = []

  // default to Montreal to keep it simple
  // change this to whatever makes sense
  center: { lat: number, lng: number } = { lat: 47.89, lng: 1.909 }

  markers: any[] = [
    {
      position: { lat: 47.89, lng: 1.909 },
      infoText: 'Salle Thierry Harismendy<br />8, avenue Alain Savary<br/>45100 Orléans (quartier Saint-Marceau)<br/><v-icon class="mdi mdi-phone" style="font-size: 14px;"></v-icon>02.38.51.91.60<br/><v-icon class="mdi mdi-at" style="font-size: 14px;"></v-icon>stmarceau.tt@free.fr',
      icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'
    },
    {
      position: { lat: 47.8853, lng: 1.9035 },
      infoText: 'Gymnase La Cigogne - Bernard Pelle<br />rue Honoré d\'Estienne d\'Orves<br/>45100 Orléans, Loiret<br/>(quartier Saint-Marceau)<br/><v-icon class="mdi mdi-phone" style="font-size: 14px;"></v-icon>02.38.66.01.64',
      icon: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png'
    }]

  places: any
  currentPlace: null
  infoContent: string = ''
  infoWindowPos: any = null
  infoWinOpen: boolean = false
  currentMidx: any = null
  // optional: offset infowindow so it visually sits nicely on top of our marker
  infoOptions: any = {
    pixelOffset: {
      width: 0,
      height: -35
    }
  }

  geolocate () {
    navigator.geolocation.getCurrentPosition(position => {
      this.center = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      }
    })
  }

  toggleInfoWindow (marker: any, idx: number) {
    this.infoWindowPos = marker.position
    this.infoContent = marker.infoText
    // check if its the same marker that was selected if yes toggle
    if (this.currentMidx === idx) {
      this.infoWinOpen = !this.infoWinOpen
      // if different marker set infowindow to open and reset current marker index
    } else {
      this.infoWinOpen = true
      this.currentMidx = idx
    }
  }

  imageLigne2: any = [
    // {
    //   id: 1,
    //   titre: 'Le Samedi 1er Septembre 2018',
    //   src: require('@/assets/img/accueil/Ping-Tour-bandeau.jpg'),
    //   text: 'Arrêt tram Saint Marceau, de 14h à 17h.',
    //   overlay: true,
    //   link: 'UrbanPing',
    //   backText: '<p>Venez à notre rencontre et pratiquer !</p>'
    // },
    // {
    //   id: 2,
    //   titre: 'Pendant les vacances, la salle est ouverte le mardi et vendredi',
    //   src: require('@/assets/img/accueil/Harismendy.jpg'),
    //   overlay: true,
    //   backText: '<p>A la salle Harismendy<br />de 13h30 à 15h30<br /><br />On vous attend et de tous niveaux</p>'
    // },
    // {
    //   id: 3,
    //   titre: 'Fiche d\'inscription',
    //   src: '/img/accueil/Inscriptions.jpg',
    //   overlay: false,
    //   href: '/document/Fiche-inscription-2018-2019.pdf',
    //   hrefTitle: 'Fiche d\'inscription',
    //   backText: '<p>Que la saison commence</p>'
    // },
    {
      id: 3,
      titre: 'Soirée Privée',
      src: '/img/accueil/soiree_privee.jpg',
      overlay: false,
      link: 'SoireeEntreprise',
      backText: '<p>Réserver votre soirée d\'entreprise dès maintenant</p>'
    },
    {
      id: 5,
      src: '/img/accueil/Devenez-partenaire.jpg',
      text: '',
      overlay: false,
      link: 'DevenezPartenaires',
      backText: '<p>Trouvez votre bonne offre de partenariat  ...</p>'
      // },
      // {
      //   id: 4,
      //   titre: 'Calendrier des équipes',
      //   src: '/img/accueil/equipes.jpg',
      //   text: '',
      //   overlay: true,
      //   link: 'Calendrier',
      //   paramLink: '04450026',
      //   backText: '<p>Réservez dès aujourd\'hui vos dates  ...</p>'
    }
  ]

  carouselItems = [
    // {
    //   subtitre: 'Championnat',
    //   titre: 'Prochaine Rencontre à Olivet le samedi 23 Octobre dès 17h.',
    //   text: '2 Matchs, 2 Victoires. Allez les gars, on compte sur vous !',
    //   src: '/img/slide/slidePn2.jpg',
    //   name: 'Equipe'
    // },
    // {
    //   subtitre: 'Stages Multisports jeunes',
    //   titre: 'A chacun son stage<br />22 au 26 et 29 au 31 Octobre',
    //   text: 'Par demi-journée, ou journée compléte,.<br />15% lors de l\'engagement sur 8 jours.<br />Le stage du 29 au 31 sera maintenus si plus de 10 stagiaires<br />Le programme est disponible.',
    //   src: '/img/slide/slideStages.jpg',
    //   name: 'StagesMultisports'
    // },
    {
      subtitre: 'Reprise du championnat',
      titre: 'Vous souhaitez faire de la compétition',
      text: 'Vous arrivez sur Orléans, vous pouvez incorporez nos équipes Nationales, régionales ou départementales !.',
      src: '/img/slide/slideOrleans.jpg'
    },
    // {
    //   subtitre: 'Stages de Reprise',
    //   titre: 'Pour les compétiteurs<br />3 au 7 Septembre',
    //   text: 'De 18h à 20h.',
    //   src: require('@/assets/img/slide/slideStages.jpg'),
    //   name: ''
    // },
    {
      subtitre: 'Tennis de Table',
      titre: 'Le tennis de table comme style de vie',
      text: 'Pour tous les niveaux, du sport santé au sport lien social, de la compétition au sport loisir, nous nous adoptons à toutes les pratiques.',
      src: '/img/slide/slide1_bg.jpg',
      action: ''
    },
    {
      subtitre: 'Bienvenue',
      titre: 'Pratiquer avec un éducateur',
      text: ' Que vous soyez loisir ou compétiteur, jeune, adulte ou senior, notre éducateur Sébastien vous accompagnera..',
      src: '/img/slide/slide2_bg.jpg',
      action: 'CoachingPersonnalise'
    },
    {
      subtitre: 'Jouer',
      titre: 'Pratiquer avec la famille et les amis',
      text: 'partager des moments conviviaux, se faire des amis.',
      src: '/img/slide/slide3_bg.jpg',
      action: ''
    },
    {
      subtitre: 'Haut niveau',
      titre: '<br /><br />',
      text: '<br /><br /><br />',
      src: '/img/slide/slide4_bg.jpg',
      name: 'SectionSportive'
    }
  ]

  mounted () {
    document.title = 'Bienvenue au Tennis de table de SAINT MARCEAU ORLEANS, l\'actualité et les résultats - Saint Marceau Orléans Tennis de Table - stmarceautt.fr'
    // document.querySelector('meta[name="description"]').setAttribute('content', 'random')
    this.setDrawer(false)
    this.geolocate()
  }

  async created () {
    this.events = await this.eventResource.home()
    this.loadingEvents = true
    this.articles = await this.articleResource.home()
    this.equipes = await this.equipeResource.equipes()
    this.loadingArticles = true
    this.partenaires = await this.partenaireResource.category(5)
    this.partenairesFede = await this.partenaireResource.category(6)
    forEach(this.partenairesFede, (item, key) => {
      this.partenaires.push(item)
    })
    let count = 0
    let taille: string | null = null
    let slide: any[] = []
    forEach(this.partenaires, (item, key) => {
      if (this.$device.mobile) {
        count += 6
        taille = '' + 6
      } else {
        if (item.taille && item.taille === 2) {
          count += 1
          taille = '' + 1
        } else {
          count += 2
          taille = '' + 2
        }
      }
      slide.push({ 'taille': taille, 'src': item.image, 'titre': item.titre, 'lien': item.lien })
      if (count >= 11) {
        this.carouselPartenaire.push({ slide: slide })
        count = 0
        slide = []
      }
    })
    if (count > 0 && count < 11) {
      this.carouselPartenaire.push({ slide: slide })
    }
    this.loadingPartenaires = true
    this.actualitesFftt = await this.ffttResource.actualite()
    this.actualitesFftt = this.actualitesFftt.splice(0, 2)
    this.video = await this.videoResource.videoLast()
  }

  articleLink (id: number) {
    this.$router.push({ name: 'Article', params: { id: '' + id } })
  }

  eventLink (id: number) {
    this.$router.push({ name: 'Evenement', params: { id: '' + id } })
  }

  link (link: string, clubId: string) {
    if (!this.$device.mobile) {
      this.setDrawer(true)
    }
    if (clubId) {
      this.$router.push({ name: link, params: { clubId: '' + clubId } })
    } else {
      this.$router.push({ name: link })
    }
  }

  goVideos () {
    this.$router.push({ name: 'Videos' })
  }

  getImgUrl (img: string) {
    return '/img/galerie/partenaires/' + img
  }

  getTruncateContenu (text: string) {
    if (text.length > 80) {
      return text.substring(0, 80) + '...'
    } else {
      return text
    }
  }
}
</script>

<style lang="scss" scoped>
a {
  text-decoration: none;
}

/* Container needed to position the overlay. Adjust the width as needed */
.img_container {
  position: relative;
  width: 100%;
}

/* Make the image to responsive */
.image {
  width: 100%;
  height: auto;
}

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

/* When you mouse over the container, fade in the overlay icon*/
/*.img_container:hover .overlay {*/
/*opacity: 0;*/
/*transform: scale(1);*/
/*}*/

/* When you mouse over the container, fade in the overlay titre */
/*.img_container:hover .overlay {*/
/*opacity: 0;*/
/*transform: scale(1);*/
/*}*/

.text {
  color: white;
  font-size: 12px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
  line-height: 1.5;
}

.slide_texte {
  position: absolute;
  display: block;
  left: 300px;
  top: 80px;
  z-index: 5;
}

@media only screen and (max-width: 599px) {
  .slide_texte {
    left: 10px;
    max-width: 460px;
  }
}

.slide_subtitre {
  z-index: 6;
  white-space: nowrap;
  font-size: 100px;
  font-weight: 700;
  color: rgba(255, 255, 255, 0.52);
  font-family: Montserrat;
  text-transform: uppercase;
  visibility: inherit;
  transition: none;
  line-height: 60px;
  border-width: 0px;
  margin: 0px;
  margin-left: -30px;
  padding: 0px;
  padding-left: 70px;
  letter-spacing: 2px;
  min-height: 0px;
  min-width: 0px;
  max-height: none;
  max-width: none;
  opacity: 1;
  transform-origin: 50% 50% 0px;
  transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
}

@media only screen and (max-width: 599px) {
  .slide_subtitre {
    font-size: 50px;
    font-weight: 350;
    letter-spacing: 1px;
    margin-left: 0px;
    padding-left: 10px;
  }
}

.slide_titre {
  z-index: 1;
  min-width: 648px;
  white-space: normal;
  font-size: 74px;
  line-height: 74px;
  font-weight: 700;
  color: rgb(255, 255, 255);
  font-family: Montserrat;
  visibility: inherit;
  transition: none;
  text-align: left;
  border-width: 0px;
  margin: 0px;
  padding: 0px;
  padding-left: 70px;
  letter-spacing: 2px;
  min-height: 149px;
  max-height: 149px;
  opacity: 1;
  transform-origin: 50% 50% 0px;
  transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
  text-shadow: black 0.1em 0.1em 0.2em;
}

@media only screen and (max-width: 599px) {
  .slide_titre {
    min-width: 100px;
    font-size: 30px;
    line-height: 30px;
    font-weight: 300;
    padding-left: 10px;
  }
}

.slide_subheading {
  z-index: 7;
  white-space: normal;
  min-width: 80px;
  font-size: 20px;
  line-height: 30px;
  font-weight: 500;
  color: rgb(206, 221, 243);
  font-family: " Open Sans ";
  visibility: inherit;
  transition: none;
  text-align: left;
  border-width: 0px;
  margin: 0px;
  padding: 0px 100px;
  letter-spacing: 0px;
  min-height: 0px;
  max-height: none;
  opacity: 1;
  transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
  transform-origin: 50% 50% 0px;
  text-shadow: black 0.1em 0.1em 0.2em;
}

@media only screen and (max-width: 599px) {
  .slide_subheading {
    font-size: 17px;
    line-height: 24px;
    padding-left: 10px;
  }
}

.carousel__controls {
  background: none !important;
}

@media only screen and (max-width: 599px) {
  /deep/ .v-carousel__prev {
    display: none;
  }

  /deep/ .v-carousel__next {
    display: none;
  }
}

.slide_article {
  position: absolute;
  display: block;
  left: 80px;
  top: 80px;
  z-index: 5;

  .slide_titre {
    z-index: 1;
    min-width: 648px;
    max-width: 648px;
    white-space: normal;
    font-size: 50px;
    line-height: 45px;
    font-weight: 700;
    color: rgb(255, 255, 255);
    font-family: Montserrat;
    visibility: inherit;
    transition: none;
    text-align: left;
    border-width: 0px;
    margin: 0px;
    padding: 0px;
    letter-spacing: 2px;
    min-height: 149px;
    max-height: 149px;
    opacity: 1;
    transform-origin: 50% 50% 0px;
    transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
  }
}

loading-content-div {
  /*width: 100%;*/
  height: 500px;
}

.spinner {
  width: 40px;
  height: 40px;
  margin: 100px auto;
  background-color: #333;
  border-radius: 100%;
  -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
  animation: sk-scaleout 1.0s infinite ease-in-out;
}

@-webkit-keyframes sk-scaleout {
  0% {
    -webkit-transform: scale(0)
  }
  100% {
    -webkit-transform: scale(1.0);
    opacity: 0;
  }
}

@keyframes sk-scaleout {
  0% {
    -webkit-transform: scale(0);
    transform: scale(0);
  }
  100% {
    -webkit-transform: scale(1.0);
    transform: scale(1.0);
    opacity: 0;
  }
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
  background-color: #404040;
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

/deep/ .flipMaillot .flipper .front {
  background-color: #FFF;
}

.carousel-partenaires {
  height: 150px !important;
}

.article--badge {
  font-size: 20px;
  font-weight: 500;
  color: #fff;
  padding: 5px 40px 5px 40px;
  background-color: #bd2e18;
  position: absolute;
  right: -30px;
  top: 11px;
  -webkit-transform: rotate(40deg);
  -moz-transform: rotate(40deg);
  -o-transform: rotate(40deg);
  /* filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=1.1); */
  -ms-transform: rotate(40deg);
  transform: rotate(40deg);
}
</style>
