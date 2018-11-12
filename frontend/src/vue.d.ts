import './vue'

import Device from '@/services/device'
import Permission from '@/services/permission'
import { Vue } from 'vue/types/vue'

declare module 'vue/types/vue' {
  interface Vue {
    $device: Device,
    $permission: Permission
  }
}
