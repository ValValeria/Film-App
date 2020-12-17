import Vue from 'vue';
import VueRouter from 'vue-router';
import HomePage from '../pages/HomePage.vue';


const routes = [
    {path:"", component: HomePage}
];

export const router = new VueRouter({
    mode: 'history',
    routes
});

Vue.use(VueRouter);