<template>
  <v-avatar color="error" size="40" v-if="isAuth" v-on:click.prevent.stop="click" >
    <span class="white--text headline">{{ firstletter }}</span>
  </v-avatar>
</template>

<script>
import { mapState } from "vuex";
export default {
  name: "ProfileIconComponent",
  props: {
    content: {
      type: Number,
      default: 0,
    },
  },
  computed: mapState({
    firstletter: (state) => {
      const username = state.user.username;

      return username ? username.slice(0, 1).toUpperCase() : "";
    },
    isAuth:state=>state.user.isAuth
  }),
  methods:{
    click(){
      this.$router.push({name:"admin"})
    }
  }
};
</script>

<style>
</style>