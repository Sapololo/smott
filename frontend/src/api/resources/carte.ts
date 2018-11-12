import ApiClient from '@/services/api'
import { AbstractDataResource, AxiosResponseExt } from '@/api/resources'
import CarteModel from '@/api/model/carte'

export default class CarteResource extends AbstractDataResource<CarteModel> {
  constructor (api: ApiClient) {
    super(api, 'carte')
  }

  carte (clubId: string): Promise<CarteModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/carte/${clubId}`))
    return promise as Promise<CarteModel & AxiosResponseExt>
  }

  cartes (): Promise<CarteModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/cartes`))
    return promise as Promise<CarteModel[] & AxiosResponseExt>
  }
}
