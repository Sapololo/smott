import MobileDetect from 'mobile-detect'

export default class Device {
  private md: MobileDetect

  constructor () {
    this.md = new MobileDetect(window.navigator.userAgent)
  }

  get mobile (): boolean {
    return !!this.md.mobile()
  }

  get phone (): boolean {
    return !!this.md.phone()
  }

  get tablet (): boolean {
    return !!this.md.tablet()
  }
}
