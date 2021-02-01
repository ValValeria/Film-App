import Vue from 'vue';
import Vuex from 'vuex';
import { router } from '../routes/routes';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        products: [],
        user: {
            isAuth: false,
            email: '',
            password: '',
            username: "",
            id: 0,
            orders: [],
            uncheckedOrders: []
        },
        sortData: {
            ingredients: [],
            max_price: 0,
            min_price: 0,
            max_weight: 0,
            min_weight: 0,
            categories: [],
        },
        isSortTouched: false,
        pagination: {
            per_page: 4,
            page: 1,
            total_amount: 0,
            loading: false,
        },
        word: ''
    },
    mutations: {
        updateWord(state,word){
          state.word = word;
        },
        updateLoadingState(state, bool) {
            state.pagination.loading = bool;
        },
        deleteUncheckedOrders(state, orders) {
            orders.forEach(v => {
                const uncheckedOrders = state.user.uncheckedOrders;

                if (uncheckedOrders.includes(v)) {
                    uncheckedOrders.splice(uncheckedOrders.indexOf(v), 1);
                }
            });
        },
        changeOrderQuantity(state, { id, quantity }) {
            const uncheckedOrders = state.user.uncheckedOrders;
            const product = uncheckedOrders.find(v => Number(id) == Number(v.id));

            if (product) {
                product.quantity = quantity;
            }
        },
        addProducts(state, obj) {
            const data = obj.data || [];

            if(Array.isArray(data)){
                data.forEach(v => {
                    const id = v.id;
                    const index = state.products.findIndex(v => v.id == id);

                    if (index == -1) {
                        state.products.push(v);
                    }
                });
                state.pagination.total_amount = obj.total;
            }
        },
        clearStore(state) {
            state.products.splice(0, state.products.length);
        },
        authenticate(state, data) {
            state.user.email = data.email;
            state.user.password = data.password;
            state.user.username = data.username;
            state.user.isAuth = true;
            state.user.id = data.id;
            localStorage.setItem("data", JSON.stringify(data));
        },
        logout(state) {
            state.user.email = "";
            state.user.password = "";
            state.user.username = "";
            state.user.isAuth = false;
            state.user.id = 0;
            localStorage.removeItem("data");
        },
        addOrders(state, data) {
            state.user.orders.push(...data);
        },
        clearOrders(state) {
            state.user.orders.splice(0, state.user.orders.length);
        },
        addUncheckOrders(state, data) {
            const ids = state.user.uncheckedOrders.map(v => v.id);

            for (const item of data) {
                if (ids.includes(item.id)) {
                    state.user.uncheckedOrders.splice(ids.findIndex(v => Number(v.id) == Number(item.id)), 1);
                }
                state.user.uncheckedOrders.push(item);
            }
        },
        clearUncheckOrders(state, id) {
            if (!id) {
                state.user.uncheckedOrders.splice(0, state.user.uncheckedOrders.length);
            } else {
                state.user.uncheckedOrders.splice(id, 1);
            }
        },
        addAdditionalData(state, data) {
            state.sortData = data;
        },
        isSortTouched(state, data) {
            state.isSortTouched = data;
        },
        changePage(state, page) {
            state.pagination.page = page;
        }
    },
    getters: {
        getProduct: (state) => (id) => {
            const elem = state.products.find(v => v.id == id);

            if (!elem) {
                store.dispatch({
                    type: 'getProductAsync',
                    id
                });
            }

            return elem;
        },
        getActiveOrders(state) {
            return state.user.orders.filter(v => v.status == "active");
        },
        getUnactiveOrders(state) {
            return state.user.orders.filter(v => v.status == "unactive");
        },
    },
    actions: {
        async getSortedProducts({ commit }, data) {
            const params = new URLSearchParams();
            commit('isSortTouched', true);
            commit('updateLoadingState', true);
            commit('clearStore');
            Object.entries(data || {}).forEach(([prop, value]) => {
                params.append('sortBy', prop);
                if (!Array.isArray(value)) {
                    params.append(prop, value);
                } else {
                    value.forEach(v => {
                        params.append(`${prop}[]`, v);
                    });
                }
            });

            const response = await fetch(`/api/product-sort/?${params.toString()}`);

            if (response.ok) {
                commit('updateLoadingState', false);
                const data = await response.json();
                commit('addProducts', data);
            }
        },
        async getAdditionalData({ commit }) {
            const response = await fetch('/api/get-ingredients');

            if (response.ok) {
                const data = await response.json();

                commit('addAdditionalData', data.data);
            }
        },
        async getProductAsync({ commit }, obj) {
            const response = await fetch(`/admin/product/${obj.id}/?isjson=true`);

            if (response.ok) {
                const data = await response.json();
                commit('addProducts', { data: data });
            } else {
                router.replace('/');
            }
        },

        async getProducts({ commit, state }) {
            const page = state.pagination.page;
            const per_page = state.pagination.per_page;
            const response = await fetch(`/admin/products/?page=${page}&isjson=true&per_page=${per_page}`);

            if (response.ok) {
                const json = await response.json();
                commit('addProducts', json);
            }
        },
        async getOrders({ commit, state }) {
            if (state.user.isAuth) {
                const response = await fetch(`/view-orders/${state.user.id}/?isjson=true`);

                if (response.ok) {
                    const json = await response.json();
                    commit('clearOrders');
                    commit('addOrders', json["data"]);
                }
            }
        },
        async addOrderToServer({ commit, state }, location) {
            if (state.user.isAuth) {

                const orders = [...state.user.uncheckedOrders.map(v => Object.assign(v, { location: location }))];
                orders.forEach(async (v) => {
                    const response = await fetch(`/api/addorder/?productId=${v.id}&quantity=${v.quantity}&isjson=true`, {
                        headers: {
                            Auth: localStorage.getItem('data')
                        }
                    });

                    if (response.ok) {
                        const data = await response.json();

                        if (data.status == "ok") {
                            commit("clearUncheckOrders", v.id);
                            commit("addOrders", [v]);
                        }
                    }
                });
            }
        }
    }
});