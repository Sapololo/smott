<template>
  <div id="banner">
    <div class="page-banner">
      <h1>{{ title }}</h1></div>
  </div>
</template>

<script lang="ts">
import { Component, Vue, Watch } from 'vue-property-decorator'
import { Route } from 'vue-router'

@Component
export default class Banner extends Vue {
  title: string = ''

  @Watch('$route', { immediate: true })
  onRouteChange (value: Route | Route) {
    this.title = value.meta.title
  }
}
</script>

<style lang="scss" scoped>
.page-banner {
  position: relative;
  height: 100px;
  margin: -30px;
  margin-top: -30px;
  margin-bottom: 20px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  background-image: url('../assets/img/page-heading.jpg');
  background-size: cover;
  background-position: center center;

  h1 {
    white-space: nowrap;
    font-size: 70px;
    font-weight: 700;
    color: rgba(255, 255, 255, 0.90);
    font-family: Montserrat;
    text-transform: uppercase;
    visibility: inherit;
    -webkit-transition: none;
    transition: none;
    line-height: 60px;
    border-width: 0px;
    margin: 0px;
    margin-left: -30px;
    padding: 0px;
    letter-spacing: 2px;
    min-height: 0px;
    min-width: 0px;
    max-height: none;
    max-width: none;
    opacity: 1;
    -webkit-transform-origin: 50% 50% 0px;
    transform-origin: 50% 50% 0px;
    -webkit-transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
    transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
    text-shadow: black 0.1em 0.1em 0.2em;
  }
}

@media only screen and (max-width: 599px) {
  .page-banner {
    margin-bottom: 1px;
    h1 {
      font-size: 30px;
      font-weight: 400;
      margin-left: 0;
    }
  }
}

@media only screen and (max-width: 959px) {
  .page-banner {
    margin-bottom: 2px;
    h1 {
      font-size: 40px;
      font-weight: 500;
      margin-left: 0;
    }
  }
}
</style>
