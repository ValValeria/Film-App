<template>
  <div class="w-100 first-slide">
     <ProductLayout
     :items="items"
     :product="product"
     >
     </ProductLayout>
  </div>
</template>

<script>
import ProductLayout from "../layouts/VPageLayout.vue";

export default {
  name: "ProductPage",
  data:function(){
    return {items:[{
            text:"Главная",
            disabled:false,
            href:"/"
          },
          {
            text:"Меню",
            disabled:false,
            href:"/products"
          },
           {
            text:"Пицца",
            disabled:true,
            href:"./"
          }]};
  },
  computed:{
      id: function(){
         return this.$route.params.id;
      },
      product:function(){
          return this.$store.getters.getProduct(this.id)||{}
      },
  },
  components:{
      ProductLayout
  }
};
</script>