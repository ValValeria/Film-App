<template>
  <v-list nav>
    <v-list-item link v-for="image in items" :key="image.text">
      <v-list-item-icon>
          <div style="width:30px;min-width:30px;height:30px;" class="center">
             <img :src="image.src" alt="..." class="img-contain">
          </div>
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
.img-contain{
  width:100%;
  object-fit: contain;
}
nav{
  min-width:66px !important;
}
</style>