<template>
  <div class="google-map">
    <slot v-if="partenaires.length === 0 && adherents.length === 0" transition="fade" name="loading-content">
      <v-flex xs12 class="secondary pa-3"><h1 class="text-xs-center white--text text-uppercase">
        Chargement des données en cours</h1>
        <v-progress-linear :indeterminate="true" color="error"
                           height="10"
                           value="75"></v-progress-linear>
      </v-flex>
    </slot>
    <slot v-else transition="fade">
      <v-card>
        <v-card-text>
          <gmap-map
              :center="center"
              :zoom="12"
              style="width:100%;  height: 400px;"
          >
            <gmap-info-window :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen"
                              @closeclick="infoWinOpen=false">
              <div v-html="infoContent"></div>
            </gmap-info-window>
            <gmap-marker :key="i" v-for="(m,i) in markers" :position="m.position" :clickable="true"
                         @click="toggleInfoWindow(m,i)" :icon="m.icon"></gmap-marker>
          </gmap-map>
        </v-card-text>
        <v-card-text style="padding: 0;">
          <v-data-table
              :headers="headersAdherents"
              :items="adherents"
              hide-actions
              no-data-text="Chargement en cours"
              class="elevation-1 white"
              style="width: 100%;"
          >
            <template slot="items" slot-scope="props" v-if="props.item.lat && props.item.lng">
              <td class="text-xs-left">{{props.item.nom}}</td>
              <td class="text-xs-left">{{props.item.prenom}}</td>
              <td class="text-xs-center">{{props.item.numero}} {{props.item.rue}}, {{props.item.ville.id}}
                {{props.item.ville.ville}}
              </td>
            </template>
            <v-alert slot="no-results" value="true" color="error" icon="warning">
              Votre recherche ne donne aucun résultat.
            </v-alert>
          </v-data-table>
        </v-card-text>
      </v-card>
    </slot>
  </div>
</template>

<script lang="ts">
import { Component, Inject, Prop, Vue } from 'vue-property-decorator'
import PartenaireModel from '@/api/model/partenaire'
import PartenaireResource from '@/api/resources/partenaire'
import AdherentModel from '@/api/model/adherent'
import AdherentResource from '@/api/resources/adherent'
import ApiService from '@/services/api'
import forEach from 'lodash/forEach'

@Component
export default class GoogleMap extends Vue {
  @Inject()
  adherentResource: AdherentResource

  @Inject()
  partenaireResource: PartenaireResource

  @Inject()
  api: ApiService

  partenaires: PartenaireModel[] = []
  adherents: AdherentModel[] = []
  headersAdherents: any[] = [
    { text: 'Nom', align: 'left', value: 'nom', sortable: true },
    { text: 'Prénom', align: 'left', value: 'prenom', sortable: true },
    { text: 'Licence', align: 'center', value: 'licence', sortable: true }
  ]

  @Prop()
  listPartenaire: boolean

  @Prop()
  listLicencie: boolean

  // default to Montreal to keep it simple
  // change this to whatever makes sense
  center: { lat: number, lng: number } = { lat: 47.89, lng: 1.909 }

  markers: any[] = [
    {
      position: { lat: 47.89, lng: 1.909 },
      infoText: 'Salle Thierry Harismendy<br />8, avenue Alain Savary<br/>45100 Orléans (quartier Saint-Marceau)<br/><v-icon class="mdi mdi-phone" style="font-size: 14px;"></v-icon>02.38.51.91.60<br/><v-icon class="mdi mdi-email" style="font-size: 14px;"></v-icon>stmarceau.tt@free.fr',
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

  async mounted () {
    if (this.listPartenaire) {
      //  Chargement de la liste des partenaires
      this.partenaires = await this.partenaireResource.category(5)
      forEach(this.partenaires, (item, key) => {
        this.markers.push({
          position: { lat: item.lat, lng: item.lng },
          infoText: '<div style=\'float:left\'><img src="/img/galerie/partenaires/' + item.imageLarge + '"></div><div style=\'float:right; padding: 10px;\'><b>' + item.titre + '</b>' + item.contenu + '</div>',
          icon: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png'
        })
      })
    }

    if (this.listLicencie) {
      //  Chargement de la liste des adherents
      this.adherents = await this.adherentResource.adherents()
      const data = this.adherents
      let adresse = ''
      forEach(this.adherents, (item, key) => {
        if (item.lat && item.lng) {
          console.log(item.lat + ',' + item.lng)
          adresse = ''
          if (item.ville && item.ville.id && item.ville.ville) {
            adresse = item.ville.id + item.ville.ville
          }
          if (item.type === 'Promotionnelle') {
            this.markers.push({
              position: { lat: item.lat, lng: item.lng },
              infoText: item.prenom + ' ' + item.nom + '<br/>' + item.numero + item.rue + '<br/>' + adresse,
              icon: 'https://maps.google.com/mapfiles/ms/icons/yellow-dot.png'
            })
          } else {
            this.markers.push({
              position: { lat: item.lat, lng: item.lng },
              infoText: item.prenom + ' ' + item.nom + '<br/>' + item.numero + item.rue + '<br/>' +
                adresse,
              icon: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png'
            })
          }
        }
      })
      this.adherents = data
    }
    this.geolocate()
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
}
</script>
