import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Login from './components/Login.vue';
import Signup from './components/Signup.vue';

// Create the app instance
const app = createApp({});

// Register the components globally
app.component('login', Login);
app.component('signup', Signup);

// Mount the app
app.mount('#app');

// Set the app name from environment variables
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// Initialize Inertia.js
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
