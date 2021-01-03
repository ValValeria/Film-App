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
                console.log('1')
            } else{
                console.log('2')
            }

            return elem;
        }
    },
    actions:{
        async getProductAsync({commit},id){
             const response = await fetch(`/admin/product/${id}`);

             if(response.ok){
                 const data = await response.json();
                 commit('addProducts',[data]);
             } else{
                 router.replace('/')
             }
        }
    }
});