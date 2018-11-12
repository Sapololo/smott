import ApiClient from '@/services/api'
import { AbstractDataResource, AxiosResponseExt } from '.'
import UserModel from '../model/user'
import UserDetailModel, { UserPassword , UserChangePassword } from '@/api/model/user'

export default class UserResource extends AbstractDataResource<UserModel> {
  constructor (api: ApiClient) {
    super(api, 'user')
  }

  getObjectId (object: UserModel): string {
    return object.username
  }

  changePassword (username: string, password: string): Promise<UserModel & AxiosResponseExt> {
    let path = `/api/user/change-password/${username}`
    return this.wrapPromise(this.api.axios.post(path, new UserPassword(password))) as Promise<UserModel & AxiosResponseExt>
  }

  resetPassword (email: string): Promise<void & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.get(`/api/user/reset-password/${email}`))
    return promise as Promise<void & AxiosResponseExt>
  }

  users (): Promise<UserModel[] & AxiosResponseExt> {
    let path = '/api/users'
    return this.wrapPromise(this.api.axios.get(path)) as Promise<UserModel[] & AxiosResponseExt>
  }

  usersDetail (): Promise<UserDetailModel[] & AxiosResponseExt> {
    let path = '/api/usersDetail'
    return this.wrapPromise(this.api.axios.get(path)) as Promise<UserDetailModel[] & AxiosResponseExt>
  }

  usersBy (type: number): Promise<UserModel[] & AxiosResponseExt> {
    let path = '/api/usersBy'
    return this.wrapPromise(this.api.axios.get(`${path}/${type}`)) as Promise<UserModel[] & AxiosResponseExt>
  }

  saveUserPassword (password: string, oldPassword?: string) {
    return this.wrapPromise(this.api.axios.put('/api/user/password', new UserChangePassword(password, oldPassword))) as Promise<UserModel & AxiosResponseExt>
  }

  savePassword (password: string, oldPassword: string): Promise<UserModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.post(`/api/user/modifier-password/${password}/${oldPassword}`))
    return promise as Promise<UserModel & AxiosResponseExt>
  }

  saveUser (user: UserModel): Promise<UserModel & AxiosResponseExt> {
    let promise = this.wrapPromise(this.api.axios.put(`/api/user`, user))
    return promise as Promise<UserModel & AxiosResponseExt>
  }

  // createUser (user: UserWithPasswordModel): Promise<UserModel[] & AxiosResponseExt> {
  //   let path = '/users'
  //   return this.wrapPromise(this.api.axios.post(path, user)) as Promise<UserModel[] & AxiosResponseExt>
  // }
  //
  // editUser (user: UserModel) {
  //   let path = '/users'
  //   return this.wrapPromise(this.api.axios.put(`${path}/${user.username}`, user)) as Promise<UserModel[] & AxiosResponseExt>
  // }
  //
  // deleteUser (username: string) {
  //   let path = '/users'
  //   return this.wrapPromise(this.api.axios.delete(`${path}/${username}`)) as Promise<UserModel & AxiosResponseExt>
  // }
}
