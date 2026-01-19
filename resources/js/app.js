import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head } from '@inertiajs/vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { pages } from './Pages/pages.js';
import { createI18n } from 'vue-i18n';
import "leaflet/dist/leaflet.css";

import en from './lang/en';
import ar from './lang/ar';

const locale = document.documentElement.lang || 'en';

const i18n = createI18n({
  legacy: false,
  locale,
  fallbackLocale: 'en',
  messages: { en, ar },
});

InertiaProgress.init();

createInertiaApp({
  resolve: name => {
    console.log('Inertia resolving page:', name);
    return pages[name]; // use the static mapping
  },
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) });
    app.use(plugin);
    app.use(i18n);
    app.component('Link', Link);
    app.component('Head', Head);
    app.mount(el);
  },
});
