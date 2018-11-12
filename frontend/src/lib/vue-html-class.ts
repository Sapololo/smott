import { VueRouter } from 'vue-router/types/router'
import { Route, RouteRecord } from 'vue-router'
import { PluginObject } from 'vue'
import { Vue } from 'vue/types/vue'

class VueHtmlClassController {
  htmlClass: string = ''

  install (vue: typeof Vue, router: VueRouter) {
    if (document.documentElement) {
      this.htmlClass = document.documentElement.className
    }
    this.router = router
  }

  set router (router: VueRouter) {
    router.beforeEach((to, from, next) => {
      if (document.documentElement) {
        let parent = (router as any).options.routes
        const matched = this.parseMatched(to.matched)
        let additionalClassName = ''

        if (to.path === '/') {
          additionalClassName = this.updateClassFromRoute(additionalClassName, to)
        } else if (matched.length > 0) {
          for (let index in matched) {
            let routes = parent.children ? parent.children : parent
            let found = this.findMatchInRoutesByPath(routes, matched[index])

            if (found) {
              parent = found
              additionalClassName = this.updateClassFromRoute(additionalClassName, found)
            }
          }
        }

        document.documentElement.className = (this.htmlClass + additionalClassName).trim()
        next()
      }
    })

  }

  parseMatched (matchedArray: RouteRecord[]): string[] {
    const matched: string[] = []

    for (let index in matchedArray) {
      const prev = matched.join('/')

      matched.push(
        matchedArray[index].path
          .replace(/^\/|\/$/g, '')
          .replace(prev, '')
          .replace(/^\/|\/$/g, '')
      )
    }

    return matched
  }

  findMatchInRoutesByPath (routes: Route[], matchedItem: string): Route | undefined {
    return routes.find((o) => {
      return o.path.replace(/^\/|\/$/g, '') === matchedItem
    })
  }

  getClassForRoute (route: Route) {
    return route.meta ? route.meta.htmlClass : null
  }

  updateClassFromRoute (className: string, route: Route) {
    const routeClass = this.getClassForRoute(route)

    if (routeClass) {
      let routeHtmlClass = routeClass.replace(/^!/, '')
      if (routeClass.indexOf('!') === 0) {
        className = ' ' + routeHtmlClass
      } else {
        className += ' ' + routeHtmlClass
      }
    }

    return className
  }
}

let VueHtmlClass = new VueHtmlClassController()

export default VueHtmlClass as PluginObject<VueRouter>
