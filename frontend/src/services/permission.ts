import store from '@/store'
import { Payload } from '@/store/auth'
import intersection from 'lodash/intersection'

// enum Roles {
//   ROLE_USER = 'ROLE_USER',
//   ROLE_ADMIN = 'ROLE_ADMIN'
// }

export default class Permission {
  private get payload (): Payload {
    return store.getters['auth/payload']
  }

  isRole (lstRoles: string[]): Boolean {
    if (this.payload) {
      return intersection(this.payload.roles, lstRoles).length > 0
    } else {
      return intersection(['ROLE_USER'], lstRoles).length > 0
    }
  }
}
