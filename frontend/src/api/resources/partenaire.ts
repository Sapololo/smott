import ApiClient from '@/services/api'
import { AbstractDataResource, AxiosResponseExt } from '@/api/resources'
import PartenaireModel from '@/api/model/partenaire'

export default class PartenaireResource extends AbstractDataResource<PartenaireModel> {
  constructor (api: ApiClient) {
    super(api, 'partenaire')
  }

  partenaire (id: string): Promise<PartenaireModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/partenaire/${id}`))
    return promise as Promise<PartenaireModel & AxiosResponseExt>
  }

  category (categoryId: number): Promise<PartenaireModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.post(`/api/partenaires/category/${categoryId}`))
    return promise as Promise<PartenaireModel[] & AxiosResponseExt>
  }
}
