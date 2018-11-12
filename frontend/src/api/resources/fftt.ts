import ApiClient from '@/services/api'
import { AbstractDataResource, AxiosResponseExt } from '@/api/resources'
import ClubDetailModel from '@/api/model/clubDetail'
import JoueurDetailModel from '@/api/model/joueurDetail'
import ClassementModel from '@/api/model/classement'
import PartieModel from '@/api/model/partie'
import UnValidatedPartieModel from '@/api/model/unvalidatedPartie'
import HistoriqueModel from '@/api/model/historique'
import EquipeModel from '@/api/model/equipe'
import EquipePouleModel from '@/api/model/equipePoule'
import RencontreModel from '@/api/model/rencontre'
import ActualiteModel from '@/api/model/actualite'
import ClubModel from '@/api/model/club'
import OrganismeModel from '@/api/model/organisme'
import RechercheByNomModel from '@/api/model/rechercheByNom'

export default class FfttResource extends AbstractDataResource<ClubDetailModel> {
  constructor (api: ApiClient) {
    super(api, 'fftt')
  }

  clubdetail (clubId: string): Promise<ClubDetailModel & AxiosResponseExt> {
    // let path = '/fftt/clubdetail'
    // return this.wrapPromise(this.api.axios.get(path)) as Promise<ClubDetailModel & AxiosResponseExt>
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/clubdetail/${clubId}`))
    return promise as Promise<ClubDetailModel & AxiosResponseExt>
  }

  joueursByNom (recherche: RechercheByNomModel): Promise<JoueurDetailModel[] & AxiosResponseExt> {
    // let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/joueursByNom`, recherche))
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/joueursByNom`))
    return promise as Promise<JoueurDetailModel[] & AxiosResponseExt>
  }

  JoueurDetailsByLicence (licence: string): Promise<JoueurDetailModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/JoueurDetailsByLicence/${licence}`))
    return promise as Promise<JoueurDetailModel & AxiosResponseExt>
  }

  joueursDetailsByClub (clubId: string): Promise<JoueurDetailModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/joueursDetailsByClub/${clubId}`))
    return promise as Promise<JoueurDetailModel[] & AxiosResponseExt>
  }

  ClassementJoueurByLicence (licence: string): Promise<ClassementModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/ClassementJoueurByLicence/${licence}`))
    return promise as Promise<ClassementModel & AxiosResponseExt>
  }

  PartiesJoueurByLicence (licence: string): Promise<PartieModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/PartiesJoueurByLicence/${licence}`))
    return promise as Promise<PartieModel[] & AxiosResponseExt>
  }

  UnvalidatedPartiesJoueurByLicence (licence: string): Promise<UnValidatedPartieModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/UnvalidatedPartiesJoueurByLicence/${licence}`))
    return promise as Promise<UnValidatedPartieModel[] & AxiosResponseExt>
  }

  HistoriqueJoueurByLicence (licence: string): Promise<HistoriqueModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/HistoriqueJoueurByLicence/${licence}`))
    return promise as Promise<HistoriqueModel[] & AxiosResponseExt>
  }

  VirtualPoints (licence: string): Promise<any & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/virtualpoints/${licence}`))
    return promise as Promise<any & AxiosResponseExt>
  }

  lesequipes (clubId: string, type?: string): Promise<EquipeModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/equipes/${clubId}/${type}`))
    return promise as Promise<EquipeModel[] & AxiosResponseExt>
  }

  rencontrePoule (lienDivision: string): Promise<RencontreModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/rencontrePoule/${lienDivision}`))
    return promise as Promise<RencontreModel[] & AxiosResponseExt>
  }

  equipeClassementPoule (lienDivision: string): Promise<EquipePouleModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/equipeClassementPoule/${lienDivision}`))
    return promise as Promise<EquipePouleModel[] & AxiosResponseExt>
  }

  detailsRencontre (lienDivision: string, clubEquipeA: string, clubEquipeB: string): Promise<[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/detailsRencontre/${lienDivision}/${clubEquipeA}/${clubEquipeB}`))
    return promise as Promise<[] & AxiosResponseExt>
  }

  ClubsByDepartement (departement: string): Promise<ClubModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/ClubsByDepartement/${departement}`))
    return promise as Promise<ClubModel[] & AxiosResponseExt>
  }

  Organismes (type: string): Promise<OrganismeModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/organisme/${type}`))
    return promise as Promise<OrganismeModel[] & AxiosResponseExt>
  }

  actualite (): Promise<ActualiteModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/actualite`))
    return promise as Promise<ActualiteModel[] & AxiosResponseExt>
  }

  brulages (clubId: string): Promise<ActualiteModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/fftt/brulages/${clubId}`))
    return promise as Promise<ActualiteModel[] & AxiosResponseExt>
  }
}
