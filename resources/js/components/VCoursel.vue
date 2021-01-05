<template>
  <v-carousel v-model="model">
    <v-carousel-item
      v-for="(color) in urls"
      :key="color"
    >
        <v-img
          :src="color"
          aspect-ratio="1.7"
        ></v-img>
    </v-carousel-item>
  </v-carousel>
</template>


<script>
  export default {
    data: () => ({
      model: 0,
    }),
    props:{
      urls:{
        type:Array,
        required:true
      }
    }
  }
</script>