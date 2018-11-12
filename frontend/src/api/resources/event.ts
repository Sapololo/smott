import ApiClient from '@/services/api'
import { AbstractDataResource, AxiosResponseExt } from '@/api/resources'
import EventModel, { EventDetailModel } from '@/api/model/event'

export default class EventResource extends AbstractDataResource<EventModel> {
  constructor (api: ApiClient) {
    super(api, 'event')
  }

  event (id: string): Promise<EventModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.post(`/api/event/${id}`))
    return promise as Promise<EventModel & AxiosResponseExt>
  }

  eventById (id: string): Promise<EventModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/eventbyid/${id}`))
    return promise as Promise<EventModel & AxiosResponseExt>
  }

  events (): Promise<EventDetailModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/events`))
    return promise as Promise<EventDetailModel[] & AxiosResponseExt>
  }

  home (): Promise<EventDetailModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/events/home`))
    return promise as Promise<EventDetailModel[] & AxiosResponseExt>
  }
}
