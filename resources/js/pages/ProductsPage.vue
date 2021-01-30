<template>
  <div class="w-100 products">
    <BasicLayout
      :isSection="true"
      class="main-cards"
      :cssFlex="cssFlex"
      :isFullContent="true"
      :isFirstSlide="true"
    >
      <template v-slot:title> Наше меню </template>
      <template #descr> Самое вкусное, самое ароматное </template>
      <template #content>
        <div class="products__area center">
          <div class="products__search" v-on:click="isTouched=true">
            <FilterComponent />
          </div>
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
        </div>
      </template>
    </BasicLayout>

    <div>
      <BasicLayout
        :isSection="true"
        :isGrid="true"
        :isFullContent="true"
        class="section_white"
      >
        <template #title> Доставка </template>
        <template #descr> у нас вы можете заказать </template>
        <template #content>
          <div class="empty-card-sm" v-for="del in delivery" :key="del.text">
            <div class="empty-card w-100">
              <div class="empty-card__img">
                <img :src="del.url" alt="..." srcset="" />
              </div>
              <div class="empty-card__body">
                <div class="empty-card__title">
                  {{ del.text }}
                </div>
              </div>
            </div>
          </div>
        </template>
      </BasicLayout>
    </div>
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
      images:["/images/slide1.jpeg","/images/slide2.jpeg"],
      delivery:[
      {
        text:"Пицца",
        url:"/images/pizza_2.svg"
      },
      {
        text:"Десерты",
        url:"/images/cake_2.svg"
      },
      {
        text:"Суши и сеты",
        url:"/images/sushi_2.svg"
      },
      {
        text:"Салаты и закуски",
        url:"/images/salad_2.svg"
      },
      ],
      isTouched:true
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

<style lang="scss">
.flex-col-2 {
  flex-direction: row !important;
  align-items: flex-start !important;
}

.products__content {
  width: 60%;
  flex: 1 1 60%;
}

.empty-card-sm{
  padding: 10px;
  text-align: center;
  width: 100%;
  height: 100%;
  max-width: 150px;

  .empty-card__title {
    margin-top: 16px;
    font-size: 18px;
    text-align: center;
  }

  img {
    height: 100%;
    width: 100%;
    object-fit: contain;
  }

  .empty-card__img {
    height: 120px;
  }
}

.products__search {
  position: sticky;
  top: 6rem;
  left: 0;
  width: 100%;
  z-index: 999;
}

.products__area {
  display: flex;
  flex-direction: column;
}

.products__search {
  margin-bottom: 2rem;
}

.products__content {
  position: relative;
  z-index: 1;
  width: 100%;
}

@media screen and (max-width: 900px) {
}
</style>
