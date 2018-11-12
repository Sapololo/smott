import ApiClient from '@/services/api'
import { AbstractDataResource, AxiosResponseExt } from '@/api/resources'
import ArticleModel from '@/api/model/article'

export default class ArticleResource extends AbstractDataResource<ArticleModel> {
  constructor (api: ApiClient) {
    super(api, 'article')
  }

  article (id: string): Promise<ArticleModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/article/${id}`))
    return promise as Promise<ArticleModel & AxiosResponseExt>
  }

  articles (): Promise<ArticleModel[] & AxiosResponseExt> {
    let path = '/api/articles'
    return this.wrapPromise(this.api.axios.get(path)) as Promise<ArticleModel[] & AxiosResponseExt>
  }

  home (): Promise<ArticleModel[] & AxiosResponseExt> {
    let path = '/api/articles/home'
    return this.wrapPromise(this.api.axios.get(path)) as Promise<ArticleModel[] & AxiosResponseExt>
  }
}
