import ApiClient from '@/services/api'
import { AbstractDataResource, AxiosResponseExt } from '@/api/resources'
import VideoModel from '@/api/model/video'

export default class VideoResource extends AbstractDataResource<VideoModel> {
  constructor (api: ApiClient) {
    super(api, 'video')
  }

  video (id: string): Promise<VideoModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/videos/${id}`))
    return promise as Promise<VideoModel & AxiosResponseExt>
  }

  videos (): Promise<VideoModel[] & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/videos`))
    return promise as Promise<VideoModel[] & AxiosResponseExt>
  }

  videoLast (): Promise<VideoModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/videoLast`))
    return promise as Promise<VideoModel & AxiosResponseExt>
  }
}
