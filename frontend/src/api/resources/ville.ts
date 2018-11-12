import ApiClient from '@/services/api'
import { AbstractDataResource, AxiosResponseExt } from '@/api/resources'
import VilleModel from '@/api/model/ville'

export default class VilleResource extends AbstractDataResource<VilleModel> {
  constructor (api: ApiClient) {
    super(api, 'ville')
  }

  ville (id: string): Promise<VilleModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/ville/${id}`))
    return promise as Promise<VilleModel & AxiosResponseExt>
  }

  villes (): Promise<VilleModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/villes`))
    return promise as Promise<VilleModel[] & AxiosResponseExt>
  }
}
