<template>
  <v-list nav>
    <v-list-item link v-for="image in items" :key="image.text">
      <v-list-item-icon>
            <v-img :src="image.src" contain :width="40" :height="40" :min-height="40"></v-img>
      </v-list-item-icon>
      <v-list-item-content>
            <v-list-item-title>{{image.text}}</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
  </v-list>
</template>

<script>
export default {
    data:function(){
        return {
            items:[
                {src:"/images/pizza_main.svg",text:"Пицца"},
                {src:"/images/sushi.svg",text:"Суши и сетты"},
                {src:"/images/prod.svg",text:"Продукты"},            
            ]
        }
    }
};
</script>

<style>
</style>