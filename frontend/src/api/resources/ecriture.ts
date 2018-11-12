import ApiClient from '@/services/api'
import { AbstractDataResource, AxiosResponseExt } from '@/api/resources'
import EcritureModel from '@/api/model/ecriture'
import ecrRubriqueModel from '@/api/model/ecrRubrique'
import ecrTypeModel from '@/api/model/ecrType'
import CompteResultatModel from '@/api/model/compteResultat'
import RemiseModel from '@/api/model/remise'

export default class BanqueResource extends AbstractDataResource<EcritureModel> {
  constructor (api: ApiClient) {
    super(api, 'ecriture')
  }

  ecritures (): Promise<EcritureModel[] & AxiosResponseExt> {
    let path = '/api/ecritures'
    return this.wrapPromise(this.api.axios.get(path)) as Promise<EcritureModel[] & AxiosResponseExt>
  }

  ecrituresRubrique (id: string): Promise<EcritureModel[] & AxiosResponseExt> {
    let path = `/api/ecrituresRubrique/${id}`
    return this.wrapPromise(this.api.axios.get(path)) as Promise<EcritureModel[] & AxiosResponseExt>
  }

  ecrituresAdherent (licenceId: string): Promise<EcritureModel[] & AxiosResponseExt> {
    let path = `/api/ecrituresAdherent/${licenceId}`
    return this.wrapPromise(this.api.axios.get(path)) as Promise<EcritureModel[] & AxiosResponseExt>
  }

  ecrRubriques (): Promise<ecrRubriqueModel[] & AxiosResponseExt> {
    let path = '/api/ecrrubriques'
    return this.wrapPromise(this.api.axios.get(path)) as Promise<ecrRubriqueModel[] & AxiosResponseExt>
  }

  ecrTypes (): Promise<ecrTypeModel[] & AxiosResponseExt> {
    let path = '/api/ecrtypes'
    return this.wrapPromise(this.api.axios.get(path)) as Promise<ecrTypeModel[] & AxiosResponseExt>
  }

  createEcriture (ecr: EcritureModel): Promise<EcritureModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.post(`/api/ecriture`, ecr))
    return promise as Promise<EcritureModel & AxiosResponseExt>
  }

  saveEcriture (ecr: EcritureModel): Promise<EcritureModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.put(`/api/ecriture`, ecr))
    return promise as Promise<EcritureModel & AxiosResponseExt>
  }

  remises (date: string): Promise<RemiseModel[] & AxiosResponseExt> {
    let path = `/api/remise/${date}`
    return this.wrapPromise(this.api.axios.get(path)) as Promise<RemiseModel[] & AxiosResponseExt>
  }

  compteresultat (type: number): Promise<CompteResultatModel[] & AxiosResponseExt> {
    let path = `/api/compteresultat/${type}`
    return this.wrapPromise(this.api.axios.get(path)) as Promise<CompteResultatModel[] & AxiosResponseExt>
  }
}
