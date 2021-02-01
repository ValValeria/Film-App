<template>
  <v-list nav>
    <v-list-item link v-for="image in items" :key="image.text" v-on:click="click(image.searchText)">
      <v-list-item-icon>
          <div style="width:30px;min-width:30px;height:30px;" class="center">
             <img :src="image.src" alt="..." class="img-contain">
          </div>
      </v-list-item-icon>
      <v-list-item-content>
            <v-list-item-title >{{image.text}}</v-list-item-title>
      </v-list-item-content>
    </v-list-item>
  </v-list>
</template>

<script>
export default {
    data:function(){
        return {
            items:[
                {src:"/images/pizza_main.svg",text:"Пицца",searchText:"пицца"},
                {src:"/images/sushi.svg",text:"Суши",searchText:"суши"},
                {src:"/images/prod.svg",text:"Салаты",searchText:"салат"},            
            ]
        }
    },
    methods:{
      click(name){
       this.$store.commit('updateWord',name);
       this.$emit('click',name)
      }
    }
};
</script>

<style>
.img-contain{
  width:100%;
  object-fit: contain;
}
nav{
  min-width:66px !important;
}
</style>