<template>
  <div class="statistiques">
    <div class="main-wrapper" :class="{'drawermenu-open': !DrawerMini && DrawerDisplay}">
      <Banner/>
      <v-layout wrap row v-if="clubId!='04450026' && clubDetail">
        <v-flex xs12 mb-2>
          <v-card dark primary>
            <v-card-text px-0 class="text-xs-center" v-if="clubDetail.nom"><h2>{{ clubDetail.nom }}</h2>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 md4 :class="$vuetify.breakpoint.smAndDown ? 'mb-2' : 'mb-2 pr-1'">
          <div class="box palette-Blue-400 bg">
            <div class="box-header palette-Blue-400 bg">
              <div class="pull-right white--text box-tools">
                <v-icon
                    class="mdi mdi-address mdi-48px" color="white"/>
              </div>
              <h2 class="box-title"><span class="white--text"
                                          v-if="clubDetail.nomSalle">{{ clubDetail.nomSalle }}</span></h2>
            </div>
            <div class="box-body">
              <div class="wrap-no-pad white--text">
                <div v-if="clubDetail.adresseSalle1">{{ clubDetail.adresseSalle1 }}</div>
                <div v-if="clubDetail.adresseSalle2">{{ clubDetail.adresseSalle2 }}</div>
                <div v-if="clubDetail.adresseSalle3">{{ clubDetail.adresseSalle3 }}</div>
                <div v-if="clubDetail.codePostaleSalle && clubDetail.villeSalle">{{
                  clubDetail.codePostaleSalle }} - {{
                  clubDetail.villeSalle }}
                </div>
              </div>
            </div>
          </div>
        </v-flex>
        <v-flex xs12 md4 :class="$vuetify.breakpoint.smAndDown ? 'mb-2' : 'mb-2 pl-1'">
          <div class="box palette-Blue-400 bg">
            <div class="box-header palette-Blue-400 bg">
              <div class="pull-right white--text box-tools">
                <v-icon
                    class="mdi mdi-address mdi-48px" color="white"/>
              </div>
              <h2 class="box-title"><span class="white--text">Contact</span></h2></div>
            <div class="box-body">
              <div class="wrap-no-pad white--text">
                <div v-if="clubDetail.nomCoordo && clubDetail.prenomCoordo">{{ clubDetail.nomCoordo }},
                  {{
                  clubDetail.prenomCoordo }}
                </div>
                <div v-if="clubDetail.telCoordo">
                  <v-icon
                      class="mdi mdi-phone mdi-48px" color="white"/>
                  {{ clubDetail.adresseSalle3 }}
                </div>
                <div v-if="clubDetail.mailCoordo">
                  <v-icon
                      class="mdi mdi-mail mdi-48px" color="white"/>
                  {{ clubDetail.mailCoordo }}
                </div>
              </div>
            </div>
          </div>
        </v-flex>
      </v-layout>
      <v-layout wrap row v-if="clubId=='04450026'">
        <v-flex xs12 mb-2>
          <v-card dark primary>
            <v-card-text px-0 class="text-xs-center"><h2>Saison 2017-2018</h2></v-card-text>
          </v-card>
        </v-flex>
        <v-flex xs12 md4 :class="$vuetify.breakpoint.smAndDown ? 'mb-2' : 'mb-2 pr-1'">
          <div class="box palette-Blue-400 bg">
            <div class="box-header palette-Blue-400 bg">
              <div class="pull-right white--text box-tools">
                <v-icon
                    class="mdi mdi-account-group mdi-48px" color="white"/>
              </div>
              <h2 class="box-title"><span class="white--text">NOMBRE DE LICENCIÉS</span></h2></div>
            <div class="box-body">
              <div class="wrap-no-pad white--text">
                <svg width="100%" height="25%" viewBox="0 0 300 75">
                  <g transform="scale(1,-1) translate(0,-67)" id="vue-bars-109-path">
                    <rect id="bar-id-0" fill="#ffffff" x="1.5714285714285712" y="0" width="8"
                          height="5.9" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="5.899999999999999" dur="0.5s"
                               fill="freeze"></animate>
                      <title>1</title></rect>
                    <rect id="bar-id-1" fill="#ffffff" x="21.857142857142854" y="0" width="8"
                          height="11.8" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="11.799999999999997" dur="0.5s"
                               fill="freeze"></animate>
                      <title>2</title></rect>
                    <rect id="bar-id-2" fill="#ffffff" x="42.14285714285714" y="0" width="8"
                          height="29.5" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="29.5" dur="0.5s"
                               fill="freeze"></animate>
                      <title>5</title></rect>
                    <rect id="bar-id-3" fill="#ffffff" x="62.42857142857143" y="0" width="8"
                          height="53.1" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="53.1" dur="0.5s"
                               fill="freeze"></animate>
                      <title>9</title></rect>
                    <rect id="bar-id-4" fill="#ffffff" x="82.71428571428571" y="0" width="8"
                          height="29.5" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="29.5" dur="0.5s"
                               fill="freeze"></animate>
                      <title>5</title></rect>
                    <rect id="bar-id-5" fill="#ffffff" x="102.99999999999999" y="0" width="8"
                          height="59" rx="2" ry="2">
                      <animate attributeName="height" from="0" to="59" dur="0.5s"
                               fill="freeze"></animate>
                      <title>10</title></rect>
                    <rect id="bar-id-6" fill="#ffffff" x="123.28571428571429" y="0" width="8"
                          height="17.7" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="17.700000000000003" dur="0.5s"
                               fill="freeze"></animate>
                      <title>3</title></rect>
                    <rect id="bar-id-7" fill="#ffffff" x="143.57142857142858" y="0" width="8"
                          height="29.5" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="29.5" dur="0.5s"
                               fill="freeze"></animate>
                      <title>5</title></rect>
                    <rect id="bar-id-8" fill="#ffffff" x="163.85714285714286" y="0" width="8"
                          height="11.8" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="11.799999999999997" dur="0.5s"
                               fill="freeze"></animate>
                      <title>2</title></rect>
                    <rect id="bar-id-9" fill="#ffffff" x="184.14285714285714" y="0" width="8"
                          height="29.5" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="29.5" dur="0.5s"
                               fill="freeze"></animate>
                      <title>5</title></rect>
                    <rect id="bar-id-10" fill="#ffffff" x="204.42857142857142" y="0" width="8"
                          height="5.9" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="5.899999999999999" dur="0.5s"
                               fill="freeze"></animate>
                      <title>1</title></rect>
                    <rect id="bar-id-11" fill="#ffffff" x="224.71428571428572" y="0" width="8"
                          height="47.2" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="47.2" dur="0.5s"
                               fill="freeze"></animate>
                      <title>8</title></rect>
                    <rect id="bar-id-12" fill="#ffffff" x="245" y="0" width="8" height="11.8" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="11.799999999999997" dur="0.5s"
                               fill="freeze"></animate>
                      <title>2</title></rect>
                    <rect id="bar-id-13" fill="#ffffff" x="265.2857142857143" y="0" width="8"
                          height="53.1" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="53.1" dur="0.5s"
                               fill="freeze"></animate>
                      <title>9</title></rect>
                    <rect id="bar-id-14" fill="#ffffff" x="285.57142857142856" y="0" width="8"
                          height="0" rx="2" ry="2">
                      <animate attributeName="height" from="0" to="0" dur="0.5s"
                               fill="freeze"></animate>
                      <title>0</title></rect>
                  </g>
                </svg>
                <h2><strong><span class="white--text">276 MEMBRES</span></strong></h2>
              </div>
            </div>
          </div>
        </v-flex>
        <v-flex xs12 md4 :class="$vuetify.breakpoint.smAndDown ? 'mb-2' : 'mb-2 px-1'">
          <div class="box palette-Deep-Purple-300 bg">
            <div class="box-header palette-Deep-Purple-300 bg">
              <div class="pull-right white--text box-tools">
                <v-icon
                    class="mdi mdi-human-male-female mdi-48px" color="white"/>
              </div>
              <h2 class="box-title"><span class="white--text">FEMMES / HOMMES</span></h2></div>
            <div class="box-body">
              <div class="wrap-no-pad">
                <svg width="100%" height="25%" viewBox="0 0 300 75">
                  <g transform="scale(1,-1) translate(0,-67)" id="vue-bars-109-path">
                    <rect id="bar-id-0" fill="#ffffff" x="1.5714285714285712" y="0" width="8"
                          height="5.9" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="5.899999999999999" dur="0.5s"
                               fill="freeze"></animate>
                      <title>1</title></rect>
                    <rect id="bar-id-1" fill="#ffffff" x="21.857142857142854" y="0" width="8"
                          height="11.8" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="11.799999999999997" dur="0.5s"
                               fill="freeze"></animate>
                      <title>2</title></rect>
                    <rect id="bar-id-2" fill="#ffffff" x="42.14285714285714" y="0" width="8"
                          height="29.5" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="29.5" dur="0.5s"
                               fill="freeze"></animate>
                      <title>5</title></rect>
                    <rect id="bar-id-3" fill="#ffffff" x="62.42857142857143" y="0" width="8"
                          height="53.1" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="53.1" dur="0.5s"
                               fill="freeze"></animate>
                      <title>9</title></rect>
                    <rect id="bar-id-4" fill="#ffffff" x="82.71428571428571" y="0" width="8"
                          height="29.5" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="29.5" dur="0.5s"
                               fill="freeze"></animate>
                      <title>5</title></rect>
                    <rect id="bar-id-5" fill="#ffffff" x="102.99999999999999" y="0" width="8"
                          height="59" rx="2" ry="2">
                      <animate attributeName="height" from="0" to="59" dur="0.5s"
                               fill="freeze"></animate>
                      <title>10</title></rect>
                    <rect id="bar-id-6" fill="#ffffff" x="123.28571428571429" y="0" width="8"
                          height="17.7" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="17.700000000000003" dur="0.5s"
                               fill="freeze"></animate>
                      <title>3</title></rect>
                    <rect id="bar-id-7" fill="#ffffff" x="143.57142857142858" y="0" width="8"
                          height="29.5" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="29.5" dur="0.5s"
                               fill="freeze"></animate>
                      <title>5</title></rect>
                    <rect id="bar-id-8" fill="#ffffff" x="163.85714285714286" y="0" width="8"
                          height="11.8" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="11.799999999999997" dur="0.5s"
                               fill="freeze"></animate>
                      <title>2</title></rect>
                    <rect id="bar-id-9" fill="#ffffff" x="184.14285714285714" y="0" width="8"
                          height="29.5" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="29.5" dur="0.5s"
                               fill="freeze"></animate>
                      <title>5</title></rect>
                    <rect id="bar-id-10" fill="#ffffff" x="204.42857142857142" y="0" width="8"
                          height="5.9" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="5.899999999999999" dur="0.5s"
                               fill="freeze"></animate>
                      <title>1</title></rect>
                    <rect id="bar-id-11" fill="#ffffff" x="224.71428571428572" y="0" width="8"
                          height="47.2" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="47.2" dur="0.5s"
                               fill="freeze"></animate>
                      <title>8</title></rect>
                    <rect id="bar-id-12" fill="#ffffff" x="245" y="0" width="8" height="11.8" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="11.799999999999997" dur="0.5s"
                               fill="freeze"></animate>
                      <title>2</title></rect>
                    <rect id="bar-id-13" fill="#ffffff" x="265.2857142857143" y="0" width="8"
                          height="53.1" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="53.1" dur="0.5s"
                               fill="freeze"></animate>
                      <title>9</title></rect>
                    <rect id="bar-id-14" fill="#ffffff" x="285.57142857142856" y="0" width="8"
                          height="0" rx="2" ry="2">
                      <animate attributeName="height" from="0" to="0" dur="0.5s"
                               fill="freeze"></animate>
                      <title>0</title></rect>
                  </g>
                </svg>
                <h2>
                  <v-icon
                      class="mdi mdi-human-female" color="white"/>
                  <span class="white--text">34</span>
                  <v-icon
                      class="mdi mdi-percent" color="white"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<v-icon
                    class="mdi mdi-human-male" color="white"/>
                  <span class="white--text">66</span>
                  <v-icon
                      class="mdi mdi-percent" color="white"/>
                </h2>
              </div>
            </div>
          </div>
        </v-flex>
        <v-flex xs12 md4 :class="$vuetify.breakpoint.smAndDown ? 'mb-2' : 'mb-2 pl-1'">
          <div class="box palette-Orange-300 bg">
            <div class="box-header palette-Orange-300 bg">
              <div class="pull-right white--text box-tools">
                <v-icon
                    class="mdi mdi-account-multiple mdi-48px" color="white"/>
              </div>
              <h2 class="box-title"><span class="white--text">REPARTITION LICENCES</span></h2></div>
            <div class="box-body">
              <div class="wrap-no-pad">
                <svg width="100%" height="25%" viewBox="0 0 300 75">
                  <g transform="scale(1,-1) translate(0,-67)" id="vue-bars-109-path">
                    <rect id="bar-id-0" fill="#ffffff" x="1.5714285714285712" y="0" width="8"
                          height="5.9" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="5.899999999999999" dur="0.5s"
                               fill="freeze"></animate>
                      <title>1</title></rect>
                    <rect id="bar-id-1" fill="#ffffff" x="21.857142857142854" y="0" width="8"
                          height="11.8" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="11.799999999999997" dur="0.5s"
                               fill="freeze"></animate>
                      <title>2</title></rect>
                    <rect id="bar-id-2" fill="#ffffff" x="42.14285714285714" y="0" width="8"
                          height="29.5" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="29.5" dur="0.5s"
                               fill="freeze"></animate>
                      <title>5</title></rect>
                    <rect id="bar-id-3" fill="#ffffff" x="62.42857142857143" y="0" width="8"
                          height="53.1" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="53.1" dur="0.5s"
                               fill="freeze"></animate>
                      <title>9</title></rect>
                    <rect id="bar-id-4" fill="#ffffff" x="82.71428571428571" y="0" width="8"
                          height="29.5" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="29.5" dur="0.5s"
                               fill="freeze"></animate>
                      <title>5</title></rect>
                    <rect id="bar-id-5" fill="#ffffff" x="102.99999999999999" y="0" width="8"
                          height="59" rx="2" ry="2">
                      <animate attributeName="height" from="0" to="59" dur="0.5s"
                               fill="freeze"></animate>
                      <title>10</title></rect>
                    <rect id="bar-id-6" fill="#ffffff" x="123.28571428571429" y="0" width="8"
                          height="17.7" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="17.700000000000003" dur="0.5s"
                               fill="freeze"></animate>
                      <title>3</title></rect>
                    <rect id="bar-id-7" fill="#ffffff" x="143.57142857142858" y="0" width="8"
                          height="29.5" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="29.5" dur="0.5s"
                               fill="freeze"></animate>
                      <title>5</title></rect>
                    <rect id="bar-id-8" fill="#ffffff" x="163.85714285714286" y="0" width="8"
                          height="11.8" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="11.799999999999997" dur="0.5s"
                               fill="freeze"></animate>
                      <title>2</title></rect>
                    <rect id="bar-id-9" fill="#ffffff" x="184.14285714285714" y="0" width="8"
                          height="29.5" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="29.5" dur="0.5s"
                               fill="freeze"></animate>
                      <title>5</title></rect>
                    <rect id="bar-id-10" fill="#ffffff" x="204.42857142857142" y="0" width="8"
                          height="5.9" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="5.899999999999999" dur="0.5s"
                               fill="freeze"></animate>
                      <title>1</title></rect>
                    <rect id="bar-id-11" fill="#ffffff" x="224.71428571428572" y="0" width="8"
                          height="47.2" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="47.2" dur="0.5s"
                               fill="freeze"></animate>
                      <title>8</title></rect>
                    <rect id="bar-id-12" fill="#ffffff" x="245" y="0" width="8" height="11.8" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="11.799999999999997" dur="0.5s"
                               fill="freeze"></animate>
                      <title>2</title></rect>
                    <rect id="bar-id-13" fill="#ffffff" x="265.2857142857143" y="0" width="8"
                          height="53.1" rx="2"
                          ry="2">
                      <animate attributeName="height" from="0" to="53.1" dur="0.5s"
                               fill="freeze"></animate>
                      <title>9</title></rect>
                    <rect id="bar-id-14" fill="#ffffff" x="285.57142857142856" y="0" width="8"
                          height="0" rx="2" ry="2">
                      <animate attributeName="height" from="0" to="0" dur="0.5s"
                               fill="freeze"></animate>
                      <title>0</title></rect>
                  </g>
                </svg>
                <h2><span class="white--text">29<v-icon
                    class="mdi mdi-percent" color="white"/>
                  TRADI. 71<v-icon
                      class="mdi mdi-percent" color="white"/>
                  PROMO.</span>
                </h2>
              </div>
            </div>
          </div>
        </v-flex>
      </v-layout>
      <v-flex xs12 mb-2>
        <v-card dark primary>
          <v-card-text px-0 class="text-xs-center">
            <h2>Saison en cours
              <span v-if="nbjoueurs">{{ nbjoueurs }} Licenciés</span>
            </h2>
          </v-card-text>
        </v-card>
      </v-flex>

      <slot v-if="joueursDetails.length === 0" transition="fade" name="loading-content">
        <v-flex xs12 class="secondary pa-3"><h2 class="text-xs-center white--text text-uppercase">
          Chargement des du club recherché</h2>
          <v-progress-linear :indeterminate="true" color="error"
                             height="10"
                             value="75"></v-progress-linear>
        </v-flex>
      </slot>
      <slot v-else transition="fade">
        <v-layout wrap row>
          <v-flex xs12 md4 :class="$vuetify.breakpoint.smAndDown ? 'mb-2' : 'mb-2 pr-1'" v-if="optionsSexe">
            <v-card>
              <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin primary py-4"><h2><span
                  v-if="$vuetify.breakpoint.xsOnly">Répartition </span>hommes {{ this.nbh }}/femmes {{ this.nbf }}</h2></span>
              </v-card-title>
              <v-card-text style="padding: 0; padding-top: 20px;">
                <highcharts :options="optionsSexe"></highcharts>
              </v-card-text>
            </v-card>
          </v-flex>

          <v-flex xs12 sm4 :class="$vuetify.breakpoint.smAndDown ? 'mb-2' : 'mb-2 px-1'" v-if="optionsType">
            <v-card>
              <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin primary py-4"><h2><span
                  v-if="$vuetify.breakpoint.xsOnly === true">Répartition des </span>licences</h2></span>
              </v-card-title>
              <v-card-text style="padding: 0; padding-top: 20px;">
                <highcharts :options="optionsType"></highcharts>
              </v-card-text>
            </v-card>
          </v-flex>

          <v-flex xs12 sm4 :class="$vuetify.breakpoint.smAndDown ? 'mb-2' : 'mb-2 pl-2'" v-if="optionsTypeSexe">
            <v-card>
              <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin primary py-4"><h2><div
                  v-if="$vuetify.breakpoint.mdAndUp">Répartition </div>par licences & hommes/femmes</h2></span>
              </v-card-title>
              <v-card-text style="padding: 0; padding-top: 20px;">
                <highcharts :options="optionsTypeSexe"></highcharts>
              </v-card-text>
            </v-card>
          </v-flex>

          <v-flex xs12 sm6 :class="$vuetify.breakpoint.smAndDown ? 'mb-2' : 'pr-1'" v-if="optionsCategorie">
            <v-card>
              <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin primary py-4"><h2><span
                  v-if="$vuetify.breakpoint.xsOnly">Répartition </span>par Categorie</h2></span>
              </v-card-title>
              <v-card-text style="padding: 0; padding-top: 20px;">
                <highcharts :options="optionsCategorie"></highcharts>
              </v-card-text>
            </v-card>
          </v-flex>

          <v-flex xs12 sm6 :class="$vuetify.breakpoint.smAndDown ? 'mb-2' : 'pl-1'" v-if="optionsClassement">
            <v-card>
              <v-card-title class="no-padding text-xs-center">
              <span
                  class="label pointing-down white--text fit no-margin primary py-4"><h2>Licences traditionnelles par Classement</h2></span>
              </v-card-title>
              <v-card-text style="padding: 0; padding-top: 20px;">
                <highcharts :options="optionsClassement"></highcharts>
              </v-card-text>
            </v-card>
          </v-flex>
        </v-layout>
      </slot>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Inject } from 'vue-property-decorator'
import { RawLocation } from 'vue-router'
import Banner from '../Banner.vue'
import { GetterDrawer, MutationDrawer } from '@/store/drawer'
import { MutationSnackbar, SnackbarEntry } from '@/store/snackbar'
import { GetterAuth } from '@/store/auth'
import ApiService from '@/services/api'
import ClubDetailModel from '@/api/model/clubDetail'
import JoueursDetailModel from '@/api/model/joueurDetail'
import FfttResource from '@/api/resources/fftt'
import forEach from 'lodash/forEach'
import find from 'lodash/find'
import VueHighcharts from 'vue-highcharts'

@Component({ components: { Banner, VueHighcharts } })
export default class Statistiques extends Vue {
  @GetterDrawer
  DrawerMini: boolean | null

  @GetterDrawer
  DrawerDisplay: boolean | null

  @MutationDrawer
  setDrawer: { (drawer: boolean): void }

  @Inject()
  ffttResource: FfttResource

  @Inject()
  api: ApiService

  @MutationSnackbar
  setSnackbarEntry: (entry: SnackbarEntry) => void

  @GetterAuth
  authenticated: boolean

  // Variables du Chart Sexe
  optionsSexe: any | null = null
  // Variables du Chart Type
  optionsType: any | null = null
  // Variables du Chart Type et Sexe
  optionsTypeSexe: any | null = null
  // Variables du Chart Categorie
  optionsCategorie: any | null = null
  dataCategorieTotal: any[] = []
  dataCategorieFemmes: any[] = []
  dataCategorieHommes: any[] = []
  // Variables du Chart Classement
  optionsClassement: any | null = null
  dataClassementTotal: any[] = []
  dataClassementFemmes: any[] = []
  dataClassementHommes: any[] = []

  clubId: string = ''
  clubDetail: ClubDetailModel | null = null
  joueursDetails: JoueursDetailModel[] = []
  clubClassement: any[] = [
    { classement: '5', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '6', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '7', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '8', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '9', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '10', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '11', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '12', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '13', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '14', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '15', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '16', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '17', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '18', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '19', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: '20', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { classement: 'N°', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 }
  ]

  clubCategorie: any[] = [
    { categorie: 'Poussin', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { categorie: 'Benjamin', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { categorie: 'Minime', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { categorie: 'Cadet', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { categorie: 'Junior', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { categorie: 'Sénior', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    { categorie: 'Vétéran', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 }
    // { categorie: 'Vétéran 2', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    // { categorie: 'Vétéran 3', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 },
    // { categorie: 'Vétéran 4+', tradih: 0, tradif: 0, tradi: 0, promoh: 0, promof: 0, promo: 0 }
  ]
  nbtradi: number = 0
  nbtradih: number = 0
  nbtradif: number = 0
  nbpromo: number = 0
  nbpromoh: number = 0
  nbpromof: number = 0
  nbjoueurs: number = 0
  nbh: number = 0
  nbf: number = 0
  point: any = ''

  async beforeMount () {
    if (this.$route.params.clubId) {
      this.clubId = this.$route.params.clubId
    } else {
      this.clubId = '04450026'
    }
    await this.rechercheClub(this.clubId)
  }

  async rechercheClub (clubId: any) {
    if (!this.authenticated && this.clubId !== '04450026') {
      Vue.nextTick(() => {
        this.setSnackbarEntry({
          color: 'error',
          icon: 'mdi-alert-decagram',
          message: `Vous devez être connecté pour voir les statistiques de ce club !`
        })
      })
      this.$router.push({ name: 'Home' } as RawLocation)
    } else {
      this.clubDetail = await this.ffttResource.clubdetail(this.clubId)
      this.joueursDetails = await this.ffttResource.joueursDetailsByClub(this.clubId)
      this.nbtradi = 0
      this.nbtradih = 0
      this.nbtradif = 0
      this.nbpromo = 0
      this.nbpromoh = 0
      this.nbpromof = 0
      this.nbjoueurs = 0
      this.nbh = 0
      this.nbf = 0
      let tmpClassement = ''
      let tmpCategorie = ''
      forEach(this.joueursDetails, (item, key) => {
        if (item) {
          if (item.classement !== null && item.classement !== undefined && item.classement.substr(0, 1) !== 'N') {
            tmpClassement = item.classement
          } else {
            tmpClassement = 'N°'
          }
          if (item.categorie !== null && item.categorie !== undefined) {
            tmpCategorie = item.categorie.split(' ')[0]
          }
          // console.log(item.categorie)
          // console.log(tmpCategorie)
          if (item.type === 'Traditionnelle') {
            this.nbtradi++
            this.clubClassement.find(i => i.classement === tmpClassement).tradi++
            this.clubCategorie.find(i => i.categorie === tmpCategorie).tradi++
            if (item.isHomme) {
              this.nbtradih++
              this.clubClassement.find(i => i.classement === tmpClassement).tradih++
              this.clubCategorie.find(i => i.categorie === tmpCategorie).tradih++
            } else {
              this.nbtradif++
              this.clubClassement.find(i => i.classement === tmpClassement).tradif++
              this.clubCategorie.find(i => i.categorie === tmpCategorie).tradif++
            }
          } else if (item.type === 'Promotionnelle') {
            this.nbpromo++
            this.clubClassement.find(i => i.classement === tmpClassement).promo++
            this.clubCategorie.find(i => i.categorie === tmpCategorie).promo++
            if (item.isHomme) {
              this.nbpromoh++
              this.clubClassement.find(i => i.classement === tmpClassement).promoh++
              this.clubCategorie.find(i => i.categorie === tmpCategorie).promoh++
            } else {
              this.nbpromof++
              this.clubClassement.find(i => i.classement === tmpClassement).promof++
              this.clubCategorie.find(i => i.categorie === tmpCategorie).promof++
            }
          }
          this.nbjoueurs++
          if (item.isHomme) {
            this.nbh++
          } else {
            this.nbf++
          }
        }
      })

      forEach(this.clubClassement, (item, key) => {
        this.dataClassementTotal.push({ name: item.classement, y: item.promo + item.tradi })
        this.dataClassementFemmes.push({ name: item.classement, y: item.promof + item.tradif })
        this.dataClassementHommes.push({ name: item.classement, y: item.promoh + item.tradih })
      })

      forEach(this.clubCategorie, (item, key) => {
        this.dataCategorieTotal.push({ name: item.categorie, y: item.promo + item.tradi })
        this.dataCategorieFemmes.push({ name: item.categorie, y: item.promof + item.tradif })
        this.dataCategorieHommes.push({ name: item.categorie, y: item.promoh + item.tradih })
      })

      this.optionsSexe = {
        credits: {
          enabled: false
        },
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
        },
        title: {
          text: null
        },
        tooltip: {
          pointFormat: '<b>{point.y}</b>'
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            innerSize: 100,
            depth: 45,
            dataLabels: {
              enabled: true,
              distance: -50,
              format: '<b>{point.percentage:.1f}% {point.name}</b>',
              style: {
                fontWeight: 'bold',
                color: 'white'
              }
            }
          }
        },
        series: [{
          name: null,
          colorByPoint: true,
          data: [{
            name: 'Femmes',
            y: this.nbf,
            color: '#E91E63'
          }, {
            name: 'Hommes',
            y: this.nbh,
            color: '#2196F3'
          }]
        }]
      }

      this.optionsType = {
        credits: {
          enabled: false
        },
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
        },
        title: {
          text: null
        },
        tooltip: {
          pointFormat: '<b>{point.y}</b>'
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            innerSize: 100,
            depth: 45,
            dataLabels: {
              enabled: true,
              distance: -50,
              format: '<b>{point.percentage:.1f}% {point.name}</b>',
              style: {
                fontWeight: 'bold',
                color: 'white'
              }
            }
          }
        },
        series: [{
          name: null,
          colorByPoint: true,
          data: [{
            name: 'Licences Promotionnelles',
            y: this.nbpromo
          }, {
            name: 'Licences Traditionnelles',
            y: this.nbtradi
          }]
        }]
      }

      this.optionsTypeSexe = {
        credits: {
          enabled: false
        },
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
        },
        title: {
          text: null
        },
        tooltip: {
          pointFormat: '<b>{point.y}</b>'
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            innerSize: 100,
            depth: 45,
            dataLabels: {
              enabled: true,
              distance: -50,
              format: '<b>{point.percentage:.1f}% {point.name}</b>',
              style: {
                fontWeight: 'bold',
                color: 'white'
              }
            }
          }
        },
        series: [{
          name: null,
          colorByPoint: true,
          data: [{
            name: 'Hommes Lic. Promo.',
            y: this.nbpromoh,
            color: '#42A5F5'
          }, {
            name: 'Hommes Lic. Tradi.',
            y: this.nbtradih,
            color: '#1565C0'
          }, {
            name: 'Femmes Lic. Promo.',
            y: this.nbpromof,
            color: '#EC407A'
          }, {
            name: 'Femmes Lic. Tradi.',
            y: this.nbtradif,
            color: '#AD1457'
          }]
        }]
      }

      this.optionsCategorie = {
        credits: {
          enabled: false
        },
        chart: {
          type: 'column',
          spacingBottom: 15,
          spacingTop: 10,
          spacingLeft: 10,
          spacingRight: 10,
          // Explicitly tell the width and height of a chart
          width: null,
          height: '300px'
        },
        title: null,
        xAxis: {
          categories: [
            'Poussin',
            'Benjamin',
            'Minime',
            'Cadet',
            'Junior',
            'Sénior',
            'Vétéran 1',
            'Vétéran 2',
            'Vétéran 3',
            'Vétéran 4+'
          ],
          type: 'category',
          labels: {
            rotation: -45,
            style: {
              fontSize: '13px',
              fontFamily: 'Verdana, sans-serif'
            }
          }
        },
        yAxis: {
          min: 0,
          allowDecimals: false,
          title: {
            text: 'Nombre de licenciés'
          }
        },
        // tooltip: {
        //   formatter: function () {
        //     return '<b>' + this.series.name + '</b><br/>' +
        //       this.point.y + ' - ' + this.point.name.toLowerCase()
        //   }
        // },
        series: [{
          name: 'Total',
          data: this.dataCategorieTotal,
          color: '#FF3434',
          dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
              fontSize: '10px',
              fontFamily: 'Verdana, sans-serif'
            }
          }
        }, {
          name: 'Femmes',
          data: this.dataCategorieFemmes,
          color: '#E91E63',
          dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
              fontSize: '10px',
              fontFamily: 'Verdana, sans-serif'
            }
          }
        }, {
          name: 'Hommes',
          data: this.dataCategorieHommes,
          color: '#2196F3',
          dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
              fontSize: '10px',
              fontFamily: 'Verdana, sans-serif'
            }
          }
        }]
      }

      const listClassement = [
        '5',
        '6',
        '7',
        '8',
        '9',
        '10',
        '11',
        '12',
        '13',
        '14',
        '15',
        '16',
        '17',
        '18',
        '19',
        '20',
        'N°'
      ]
      this.optionsClassement = {
        credits: {
          enabled: false
        },
        chart: {
          type: 'bar'
        },
        title: null,
        xAxis: [{
          categories: listClassement,
          reversed: false,
          labels: {
            step: 1
          }
        }, { // mirror axis on right side
          opposite: true,
          reversed: false,
          categories: listClassement,
          linkedTo: 0,
          labels: {
            step: 1
          }
        }],
        yAxis: {
          title: {
            text: null
          }
          // labels: {
          //   formatter: function () {
          //     return Math.abs({value}) + '%'
          //   }
          // }
        },

        plotOptions: {
          series: {
            stacking: 'normal'
          }
        },
        // tooltip: {
        //   formatter: function () {
        //     return '<b>' + this.series.name + ', classé(e)s ' + this.point.category + '</b><br/>' +
        //       this.point.y
        //   }
        // },
        series: [{
          name: 'Femmes',
          data: this.dataClassementFemmes,
          color: '#E91E63'
        }, {
          name: 'Hommes',
          data: this.dataClassementHommes,
          color: '#2196F3'
        }]
      }
    }
  }
}
</script>

<style lang="scss" scoped>
h2 {
  -webkit-box-flex: 1;
  -ms-flex: 1 1 auto;
  flex: 1 1 auto;
  text-transform: uppercase;
}
</style>
