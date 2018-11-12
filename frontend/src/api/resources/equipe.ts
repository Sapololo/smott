import ApiClient from '@/services/api'
import { AbstractDataResource, AxiosResponseExt } from '@/api/resources'
import EquipeModel from '@/api/model/equipe'

export default class EquipeResource extends AbstractDataResource<EquipeModel> {
  constructor (api: ApiClient) {
    super(api, 'equipe')
  }

  equipes (): Promise<EquipeModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/equipes`))
    return promise as Promise<EquipeModel[] & AxiosResponseExt>
  }

  updateEquipes (): Promise<void & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/updateequipes`))
    return promise as Promise<void & AxiosResponseExt>
  }
}
