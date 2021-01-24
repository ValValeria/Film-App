import Vue from 'vue';
import Vuex from 'vuex';
import { router } from '../routes/routes';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state:{
        products:[],
        user:{
            isAuth:false,
            email: '3725@gm.com',
            password: '122344',
            username:"",
            id: 1,
            orders:[
            ],
            uncheckedOrders:[

            ]
        }
    },
    mutations:{
        addProducts(state,products){
            state.products.push(...products);
        },
        clearStore(state){
            state.products.splice(0,state.products.length)
        },
        authenticate(state,data){
            state.user.email = data.email;
            state.user.password = data.password;
            state.user.username = data.username;
            state.user.isAuth = true;
        },
        addOrders(state,data){
            state.user.orders.push(...data);
        },
        clearOrders(state){
            state.user.orders.splice(0,state.user.orders.length);
        },
        addUncheckOrders(state,data){
            state.user.uncheckedOrders.push(...data);
        },
        clearUncheckOrders(state,id){
            if(!id){
                state.user.uncheckedOrders.splice(0, state.user.uncheckedOrders.length);      
            }else{
                state.user.uncheckedOrders.splice(id,0);
            }   
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
        },
        getActiveOrders(state){
            return state.user.orders.filter(v=>v.status=="active");
        },
        getUnactiveOrders(state) {
            return state.user.orders.filter(v => v.status == "unactive");
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
        },
        
        async getProducts({commit},page = 1){
            const response = await fetch(`/admin/products/?page=${page}&isjson=true`);

            if (response.ok) {
                const json = await response.json();
                commit('addProducts', json["data"]);
            }
        },

        async getOrders({commit,state}){
            if(state.user.isAuth){
                const response = await fetch(`/view-orders/${state.user.id}/?isjson=true`);

                if (response.ok) {
                    const json = await response.json();
                    commit('clearOrders');
                    commit('addOrders', json["data"]);
                }
            }
        },
        async addOrderToServer({ commit, state },) {
            if (state.user.isAuth) {

                const orders = [...state.user.uncheckedOrders]
                orders.forEach(async(v) => {
                    const response = await fetch(`/addorder/?productId=${v.id}&quantity=1`);

                    if(response.ok){
                        const data = await response.json();

                        if(data.status=="ok"){
                            commit("clearUncheckOrders", v.id);
                            commit("addOrders",[v]);
                        }
                    }
                });
            }
        }
    }
});