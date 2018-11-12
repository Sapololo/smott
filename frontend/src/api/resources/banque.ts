import ApiClient from '@/services/api'
import { AbstractDataResource, AxiosResponseExt } from '@/api/resources'
import BanqueModel from '@/api/model/banque'

export default class BanqueResource extends AbstractDataResource<BanqueModel> {
  constructor (api: ApiClient) {
    super(api, 'banque')
  }

  releves (): Promise<BanqueModel[] & AxiosResponseExt> {
    let path = '/api/releves'
    return this.wrapPromise(this.api.axios.get(path)) as Promise<BanqueModel[] & AxiosResponseExt>
  }
}
