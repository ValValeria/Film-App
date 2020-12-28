import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state:{
        products:[
            {title:"", image:"", category: '', price: '', weight: 0}
        ]
    }
});