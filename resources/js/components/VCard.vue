<template>
  <v-card v-bind:class="'mx-auto shadow card-sm p-3' + classes" max-width="344">
    <v-snackbar v-model="snackbar">
      Добавлено в корзину

      <template v-slot:action="{ attrs }">
        <v-btn color="error" text v-bind="attrs" @click="snackbar = false">
          Close
        </v-btn>
      </template>
    </v-snackbar>
    <div class="position-relative">
      <v-btn class="card-sm__fab mx-2" fab dark color="error " small v-on:click="addProduct()" v-if="isAuth">
        <v-icon dark> mdi-plus </v-icon>
      </v-btn>
      <v-img :src="image" height="200px" class="mt-2">
        <template v-slot:placeholder>
          <v-row class="fill-height ma-0" align="center" justify="center">
            <v-progress-circular
              indeterminate
              color="error"
            ></v-progress-circular>
          </v-row>
        </template>
      </v-img>
    </div>

    <v-card-title class="text-center">
      <div class="w-100 text-center card-sm-title">
        {{ title }}
      </div>
    </v-card-title>

    <v-card-text class="text-center pt-2">
      {{ subtitle }}
    </v-card-text>

    <v-card-actions class="center pb-4" v-if="showAction">
      <router-link :to="'/product/' + id" class="text-white">
        <v-btn color="bg-red" dark large depressed class="font-white">
          Подробнее
        </v-btn>
      </router-link>
    </v-card-actions>
  </v-card>
</template>

<script>
import { mapState } from 'vuex';
export default {
  name: "Card",
  props: {
    url: String,
    title: String,
    descr: String,
    subtitle: String,
    id: String | Number,
    classes: {
      type: String,
      default: "",
      required: false,
    },

    showAction: {
      type: Boolean,
      default: true,
      required: false,
    },
  },
  data: function () {
    return { show: false ,snackbar:false};
  },
  computed: {
    image: function () {
      let image = this.url.startsWith("/") ? this.url : "/".concat(this.url);
      return image;
    },
    ...mapState({
      isAuth:state=>state.user.isAuth
    })
  },
  methods:{
    addProduct(){
      const date = new Date();
      const product = this.$store.state.products.find(v=>v.id==this.id);
      const dateString = date.toLocaleString();
      this.$store.commit("addUncheckOrders", [{...product,quantity:1,date: dateString}]);
      this.snackbar = true;
    }
  }
};
</script>

<style lang="scss">
.card-sm .v-image__image {
  background-size: contain !important;
}

.card-sm__fab{
  position: absolute;
  right:20px;
  bottom:5px;
  z-index:2;
}

.shadow {
  box-shadow: 0 0 20px rgba(73, 77, 86, 0.127021) !important;
  border-radius: 25px !important;
}
</style>