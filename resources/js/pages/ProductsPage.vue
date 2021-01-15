<template>
  <div class="w-100">
    <BasicLayout
      :isSection="true"
      :isFlex="true"
      class="main-cards"
      :isFirstSlide="true"
    >
      <template v-slot:title> Наше меню </template>
      <template #descr> Самое вкусное, самое ароматное </template>
      <template v-slot:content>
        <GridLayout>
          <template #content>
            <template v-if="products.length">
              <CardComponent
                v-for="item in products"
                :key="item + Math.random()"
                :url="item.image"
                :title="item.title"
                :descr="item.long_description"
                :subtitle="item.short_description"
                :id="item.id"
                classes="card-ad all-width"
              />
            </template>
            <template v-else>
              <v-row>
                <div class="w-100 center">
                  <v-progress-circular
                    indeterminate
                    color="amber"
                  ></v-progress-circular>
                </div>
              </v-row>
            </template>
          </template>
        </GridLayout>
      </template>
    </BasicLayout>

    <BasicLayout
      :isSection="true"
      :isGrid="true"
      class="main-cards"
      :isFirstSlide="true"
    >
      <template v-slot:title> Только для вас </template>
      <template #descr> Самые горячие предложения </template>
      <template v-slot:content>
            <AdComponent :image="'/images/banner-img2.png'" />
            <AdComponent :image="'/images/banner-img2.png'" />
            <AdComponent :image="'/images/banner-img2.png'" />
      </template>
    </BasicLayout>
  </div>
</template>

<script lang="js">
import BasicLayout from '../layouts/VBasicLayout';
import GridLayout from '../layouts/GridLayout';
import FilterComponent from '../components/VFilter';
import CardComponent from '../components/VCard'
import AdComponent from '../components/VAd'

export default {
  data:function () {
      return {
          page: 1,
      }
  },
  components:{
      BasicLayout,
      GridLayout,
      FilterComponent,
      CardComponent,
      AdComponent
  },
  computed:{
      products:function(){
          return this.$store.state.products;
      }
  },
  beforeRouteEnter(to,from,next){
      next(vm=>{
          vm.$store.dispatch("getProducts",vm.page);
      })
  }
}
</script>

<style>
</style>