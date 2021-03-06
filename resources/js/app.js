/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap';

window.Vue = require('vue');

import vuetify from './vuetify';
import {router} from './routes/routes'
import App from './RootComponent.vue';
import {store} from './store/index'

const app = new Vue({
    vuetify,
    router,
    store,
    render: h => h(App),
    el: '#app',
});