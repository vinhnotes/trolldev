import './bootstrap'
import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'

import AppLayout from '@/Layouts/AppLayout.vue'
import VuePlyr from 'vue-plyr'
import 'vue-plyr/dist/vue-plyr.css'

import '@vueform/multiselect/themes/tailwind.css'

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import {} from '@fortawesome/free-regular-svg-icons'
import {} from '@fortawesome/free-brands-svg-icons'
import {
  faFaceSmile,
  faNewspaper,
  faSkullCrossbones,
  faGrinHearts,
  faHatWizard,
  faBolt,
  faCat,
  faBomb,
  faBook,
  faVideo
} from '@fortawesome/free-solid-svg-icons'

import { faFacebook, faGithub } from '@fortawesome/free-brands-svg-icons'

library.add(
  faFaceSmile,
  faNewspaper,
  faSkullCrossbones,
  faVideo,
  faGrinHearts,
  faHatWizard,
  faBolt,
  faCat,
  faBomb,
  faBook,
  faFacebook,
  faGithub
)
import { dom } from '@fortawesome/fontawesome-svg-core'

dom.watch()

const appName = import.meta.env.VITE_APP_NAME || 'TROLLDEV'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(VuePlyr, {
        plyr: {}
      })
      .component('InertiaHead', Head)
      .component('InertiaLink', Link)
      .component('AppLayout', AppLayout)
      .component('font-awesome-icon', FontAwesomeIcon)
      .mount(el)
  },
  progress: {
    color: '#4B5563'
  }
})
