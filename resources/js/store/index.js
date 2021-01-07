import Vue from 'vue';
import Vuex from 'vuex';
import { router } from '../routes/routes';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state:{
        products:[]
    },
    mutations:{
        addProducts(state,products){
            state.products.push(...products);
        }
    },
    getters:{
        getProduct:(state)=>(id)=>{
            const elem = state.products.find(v => v.id == id);

            if(!elem){
                store.dispatch({
                    type:'getProductAsync',
                    id
                });
            }

            return elem;
        }
    },
    actions:{
        async getProductAsync({commit},obj){
             const response = await fetch(`/admin/product/${obj.id}/?isjson=true`);

             if(response.ok){
                 const data = await response.json();
                 commit('addProducts',[data]);
             } else{
                 router.replace('/')
             }
        }
    }
});