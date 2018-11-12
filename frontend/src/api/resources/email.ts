import ApiClient from '@/services/api'
import { AbstractDataResource, AxiosResponseExt } from '@/api/resources'
import EmailModel from '@/api/model/email'

export default class EmailResource extends AbstractDataResource<EmailModel> {
  constructor (api: ApiClient) {
    super(api, 'email')
  }

  email (email: EmailModel): Promise<void & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.post(`/api/email`, email))
    return promise as Promise<void & AxiosResponseExt>
  }

  emailRecoit (email: EmailModel): Promise<void & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.post(`/api/emailRecoit`, email))
    return promise as Promise<void & AxiosResponseExt>
  }
}
