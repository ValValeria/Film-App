<template>
  <v-card
    class="mx-auto card-sm"
    max-width="344"
  >
    <v-img
      :src="url"
      height="200px"
    ></v-img>

    <v-card-title class="text-center">
      <div class="w-100 text-center">
        {{title}}
      </div>
    </v-card-title>

    <v-card-subtitle class="text-center pt-2">
      {{subtitle}}
    </v-card-subtitle>

    <v-card-actions class="center pb-4">
      <v-btn
        color="warning lighten-2"
        dark
        large
        :href="'/product/'+id"
        depressed
      >
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
        id:String
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
</style>