<template>
  <div class="w-100 products">
    <BasicLayout
      :isSection="true"
      :isTwoCols="true"
      class="main-cards"
      :isFirstSlide="true"
      :cssFlex="cssFlex"
    >
      <template #breadcrumps>
        <div class="breadcrumps wrap-md">
          <v-breadcrumbs :items="items" divider="/" large> </v-breadcrumbs>
        </div>
      </template>
      <template v-slot:title> Наше меню </template>
      <template #descr> Самое вкусное, самое ароматное </template>
      <template #carousel>
        <v-carousel>
          <v-carousel-item
            v-for="(item, i) in images"
            :key="i"
            :src="item"
            reverse-transition="fade-transition"
            transition="fade-transition"
            class="bg-dark font-white"         
          ></v-carousel-item>
        </v-carousel>
      </template>
      <template v-slot:content>
        <div class="products__content">
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
        </div>
        <div class="products__search" v-if="products.length">
          <FilterComponent />
        </div>
      </template>
    </BasicLayout>
  </div>
</template>

<script lang="js">
import BasicLayout from '../layouts/VBasicLayout';
import GridLayout from '../layouts/GridLayout';
import FilterComponent from '../components/VFilter';
import CardComponent from '../components/VCard'

export default {
  data:function () {
      return {
          page: 1,
          items: [
        {
          text: "Главная",
          disabled: false,
          href: "/",
        },
        {
          text: "Меню",
          disabled: true,
          href: "/products",
        },
      ],
      cssFlex:{
        "align-items":"start"
      },
      images:["/images/slide1.png","/images/slide2.png"]
      }
  },
  components:{
      BasicLayout,
      GridLayout,
      FilterComponent,
      CardComponent,
  },
  computed:{
      products:function(){
          return this.$store.state.products;
      }
  },
  beforeRouteEnter(to,from,next){
      next(vm=>{
          vm.$store.commit('clearStore');
          vm.$store.dispatch("getProducts",vm.page);
      });
  }
}
</script>

<style lang="scss" scoped>
.flex-col-2 {
  flex-direction: row !important;
  align-items: flex-start !important;
}

.products__content {
  width: 60%;
  flex: 1 1 60%;
}

.products__search {
  width: 40%;
  flex: 1 1 40%;
  position: sticky;
  top: 1rem;
  left: 0;
}

@media screen and (max-width:900px){
.products__content {
  width: 50%;
  flex: 1 1 50%;
}

.products__search {
  width: 50%;
  flex: 1 1 50%;
}
}
</style>
