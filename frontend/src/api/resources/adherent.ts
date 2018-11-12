import ApiClient from '@/services/api'
import { AbstractDataResource, AxiosResponseExt } from '@/api/resources'
import AdherentModel from '@/api/model/adherent'

export default class AdherentResource extends AbstractDataResource<AdherentModel> {
  constructor (api: ApiClient) {
    super(api, 'adherent')
  }

  adherents (): Promise<AdherentModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/adherents`))
    return promise as Promise<AdherentModel[] & AxiosResponseExt>
  }

  updateAdherents (): Promise<string & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/updateadherents`))
    return promise as Promise<string & AxiosResponseExt>
  }

  initVirtualPointAdherents (): Promise<string & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/initVirtualPoint`))
    return promise as Promise<string & AxiosResponseExt>
  }

  saveAdherent (adh: AdherentModel): Promise<AdherentModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.put(`/api/adherent`, adh))
    return promise as Promise<AdherentModel & AxiosResponseExt>
  }
}
