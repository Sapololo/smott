import ApiClient from '@/services/api'
import { AxiosPromise, AxiosResponse, CancelTokenSource } from 'axios'
import { IdData } from '@/api/model'

export interface AxiosResponseExt {
  $axios: AxiosResponse
}

/**
 * Accès à une resource d'API, en utilisant vue-notifications pour la gestion des erreurs, et une promesse des données
 * au lieu de la promesse Axios.
 *
 * La réponse Axios reste disponible via la propriété `$axios`.
 */
export abstract class AbstractResource {
  protected api: ApiClient

  constructor (api: ApiClient) {
    this.api = api
  }

  protected wrapPromise (axiosPromise: AxiosPromise) {
    return new Promise((resolve, reject) => {
      axiosPromise.then((axiosResponse: AxiosResponse) => {
        (axiosResponse.data as AxiosResponseExt).$axios = axiosResponse
        resolve(axiosResponse.data)
      }).catch(reject)
    })
  }
}

export abstract class AbstractGetEntityResource<T, K> extends AbstractResource {
  private prefix: string

  constructor (api: ApiClient, prefix: string) {
    super(api)
    this.prefix = prefix
  }

  getPath (id?: K): string {
    if (id === undefined) {
      return this.prefix
    } else {
      let idPath = this.getIdPathRepresentation(id)
      return `${this.prefix}/${idPath}`
    }
  }

  getIdPathRepresentation (id: K): string {
    return id.toString()
  }

  get (id: K, cancelTokenSource?: CancelTokenSource): Promise<T & AxiosResponseExt> {
    let path = this.getPath(id)
    let cancelOptions = cancelTokenSource ? { cancelToken: cancelTokenSource.token } : undefined
    let promise = this.wrapPromise(this.api.axios.get(path, cancelOptions))
    return promise as Promise<T & AxiosResponseExt>
  }
}

export abstract class AbstractEntityResource<T, K> extends AbstractGetEntityResource<T, K> {
  abstract getObjectId (object: T): K

  getPathFromObject (object?: T) {
    if (object === undefined) {
      return this.getPath()
    } else {
      let id = this.getObjectId(object)
      return this.getPath(id)
    }
  }

  getFromObject (object: T): Promise<T & AxiosResponseExt> {
    return this.get(this.getObjectId(object))
  }

  list (cancelTokenSource?: CancelTokenSource): Promise<T[] & AxiosResponseExt> {
    let cancelOptions = cancelTokenSource ? { cancelToken: cancelTokenSource.token } : undefined
    let promise = this.wrapPromise(this.api.axios.get(this.getPath(), cancelOptions))
    return promise as Promise<T[] & AxiosResponseExt>
  }

  create (object: T): Promise<T & AxiosResponseExt> {
    return this.wrapPromise(this.api.axios.post(this.getPath(), object)) as Promise<T & AxiosResponseExt>
  }

  deleteFromObject (object: T): Promise<T & AxiosResponseExt> {
    return this.delete(this.getObjectId(object))
  }

  delete (id: K): Promise<T & AxiosResponseExt> {
    let path = this.getPath(id)
    return this.wrapPromise(this.api.axios.delete(path)) as Promise<T & AxiosResponseExt>
  }

  update (object: T): Promise<T & AxiosResponseExt> {
    let path = this.getPathFromObject(object)
    return this.wrapPromise(this.api.axios.put(path, object)) as Promise<T & AxiosResponseExt>
  }
}

export abstract class AbstractDataResource<T extends IdData<any>> extends AbstractEntityResource<T, string> {
  getObjectId (object: T): string {
    return object.id
  }
}

export class DefaultDataResource<T extends IdData<any>> extends AbstractDataResource<T> {
  constructor (api: ApiClient, dataName: string) {
    super(api, dataName)
  }
}
