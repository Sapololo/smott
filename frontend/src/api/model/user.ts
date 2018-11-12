import { IdData } from '.'

export class UserReference extends IdData<number> {
  username: string
  name: string
}

export class UserEmail {
  email: string = ''
  appBaseUrl: string = ''

  constructor (email: string, appBaseUrl: string) {
    this.email = email
    this.appBaseUrl = appBaseUrl
  }
}

export class UserPassword {
  password: string = ''

  constructor (password: string) {
    this.password = password
  }
}

export class UserChangePassword extends UserPassword {
  constructor (password: string, oldPassword?: string) {
    super(password)
    this.oldPassword = oldPassword
  }

  oldPassword?: string = ''
}

export default class UserModel extends IdData<number> {
  username: string = ''
  lastName: string = ''
  firstName: string = ''
  email: string = ''
  licenceId: string = ''
  enabled: boolean = false
  roles: Array<string> = []
}

export class UserDetailModel extends UserModel {
  nom: string = ''
  prenom: string = ''
}

export class UserWithPasswordModel extends UserModel {
  password: string = ''
}
