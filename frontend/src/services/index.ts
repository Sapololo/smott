import Vue from 'vue'
import Api from './api'
import AccessService from './access'
import config from '../config'
import router from '../router'
import store from '../store'
import Permission from '@/services/permission'
import Device from '@/services/device'

import AdhrentResource from '@/api/resources/adherent'
import ArticleResource from '@/api/resources/article'
import BanqueResource from '@/api/resources/banque'
import CarteResource from '@/api/resources/carte'
import EcritureResource from '@/api/resources/ecriture'
import EquipeResource from '@/api/resources/equipe'
import EmailResource from '@/api/resources/email'
import EventResource from '@/api/resources/event'
import FfttResource from '@/api/resources/fftt'
import PartenaireResource from '@/api/resources/partenaire'
import UserResource from '@/api/resources/user'
import VideoResource from '@/api/resources/video'
import VilleResource from '@/api/resources/ville'

const bus = new Vue()
const api = new Api(config.api, store)
const access = new AccessService(router, api)
const permission = new Permission()
const device = new Device()
const adherentResource = new AdhrentResource(api)
const articleResource = new ArticleResource(api)
const banqueResource = new BanqueResource(api)
const carteResource = new CarteResource(api)
const ecritureResource = new EcritureResource(api)
const equipeResource = new EquipeResource(api)
const emailResource = new EmailResource(api)
const eventResource = new EventResource(api)
const ffttResource = new FfttResource(api)
const partenaireResource = new PartenaireResource(api)
const userResource = new UserResource(api)
const videoResource = new VideoResource(api)
const villeResource = new VilleResource(api)

export default {
  bus,
  api,
  access,
  permission,
  device,
  adherentResource,
  articleResource,
  banqueResource,
  carteResource,
  ecritureResource,
  equipeResource,
  emailResource,
  eventResource,
  ffttResource,
  partenaireResource,
  userResource,
  videoResource,
  villeResource
}
