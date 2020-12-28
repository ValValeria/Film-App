import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state:{
        products:[
            { title: "Итальяская пицца", url:"/images/pizza_sm.jpg", category: 'пицца', price: '50', weight: 800, descr: 'Очень вкусная пицца'}
        ]
    }
});