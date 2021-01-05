<template>
  <v-card
    v-bind:class="'mx-auto shadow card-sm'+classes"
    max-width="344"
  >
    <v-img
      :src="url"
      height="200px"
    ></v-img>

    <v-card-title class="text-center">
      <div class="w-100 text-center card-sm-title">
        {{title}}
      </div>
    </v-card-title>

    <v-card-text class="text-center pt-2">
      {{subtitle}}
    </v-card-text>

    <v-card-actions class="center pb-4" v-if="showAction">
      <v-btn
        color="warning lighten-2"
        dark
        large
        depressed
        rounded
      >
       <router-link :to="'product/'+id"></router-link>
        Подробнее
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
    name: 'Card',
    props:{
        url: String,
        title: String,
        descr: String,
        subtitle: String,
        id: String | Number,
        classes: {
          type: String,
          default: '',
          required: false
        },

        showAction:{
          type: Boolean,
          default: true,
          required: false
        }
    },
    data: function(){
      return {show: false}
    }
}
</script>

<style lang="scss">
  .card-sm .v-image__image{
     background-size:contain !important;
  }

  .shadow{
    box-shadow: 0 0 20px rgba(73,77,86,0.127021) !important;
    border-radius: 25px !important;
}
</style>