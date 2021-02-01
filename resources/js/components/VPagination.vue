<template>
  <v-pagination
    :length="length"
    v-model="page"
    v-if="length"
    :total-visible="5"
    color="error"
    class="pt-2"
  ></v-pagination>
</template>

<script>
import { mapState } from "vuex";

export default {
  computed: {
    ...mapState({
      length: (state) => {
        console.log(state)
        const data = state.pagination;
        const num = Math.ceil(data.total_amount / data.per_page);
        return num;
      },
    }),
    page:{
        get(){
         return this.$store.state.pagination.page;
        },
        set(value){
            this.$store.commit('changePage',value);
            this.$store.dispatch('getProducts');
        }
    }
  },
};
</script>

<style>
</style>