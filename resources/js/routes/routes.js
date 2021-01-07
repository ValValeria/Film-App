import Vue from 'vue';
import VueRouter from 'vue-router';
import HomePage from '../pages/HomePage.vue';
import NotFoundPage from '../pages/NotFoundPage.vue';
import {store} from '../store/index';
import ProductPage from '../pages/ProductPage.vue';


const routes = [
    {path:"/", component: HomePage},
    {path:"/product/:id", component: ProductPage},
    {path: "*", component: NotFoundPage}
];

export const router = new VueRouter({
    mode: 'history',
    routes
});

router.beforeEach(async(to,from,next)=>{
   const data = store.state.products;

   if(location.pathname==="/" && !data.length){
      const response = await fetch('/admin/products/?isjson=true');

      if(response.ok){
          const json = await response.json();
          store.commit('addProducts',json["data"])
      }
   } 
   next();
});

Vue.use(VueRouter);