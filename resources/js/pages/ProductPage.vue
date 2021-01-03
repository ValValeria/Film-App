<template>
  <div class="w-100 first-slide">
      Hello
    <BasicLayout :isSection="true">
      <template v-slot:title> 
         {{product().title}}
      </template>
      <template #descr> Самое вкусное, самое ароматное </template>
      <template v-slot:content> </template>
    </BasicLayout>
  </div>
</template>

<script>
import BasicLayout from "../layouts/VBasicLayout";

export default {
  name: "ProductPage",
  computed:{
      id: function(){
         return this.$route.params.id;
      },
      product:function(){
          return this.$store.getters.getProduct(this.id)
      }
  },
  components:{
      BasicLayout
  }
};
</script>