import Vue from 'vue';
import VueRouter from 'vue-router';
import HomePage from '../pages/HomePage.vue';
import NotFoundPage from '../pages/NotFoundPage.vue';
import {store} from '../store/index';
import ProductPage from '../pages/ProductPage.vue';
import ProductsPage from '../pages/ProductsPage.vue';
import ContactPage from '../pages/ContactPage.vue'
import AuthPage from '../pages/AuthPage.vue';
import OrderListPage from '../pages/OrderListPage'

const routes = [
    {path:"/", component: HomePage, name:'home'},
    {path:"/product/:id", component: ProductPage},
    {path: "/products", component: ProductsPage },
    {path: "/contacts", component: ContactPage },
    { path:'/orders-list', component: OrderListPage, beforeEnter:function(to,from,next){
       if(!store.state.user.isAuth) {
          return next('/login')
       }  
       return next();
    }},
    {path:"/login",component: AuthPage, meta: {isLogin:true}},
    {path:"/signup", component: AuthPage, meta: {isLogin:false}},
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