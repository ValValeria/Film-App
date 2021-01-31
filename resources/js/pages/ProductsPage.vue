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
          <div class="products__search">
            <FilterComponent />
          </div>
          <div class="products__content center w-100">
            <div class="alert-card w-100" hidden>
              <v-alert type="warning">
                В среднем на один заказ уходит <strong>27 минут</strong> и
                <strong>15 минут</strong> на доставку в зависимости от места
                назначения
              </v-alert>
            </div>
            <GridLayout class="products__result">
              <template #content>
                <template v-if="(products||[]).length">
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
                  <PaginationComponent class="products__pagination"/>
                </template>
                <template v-if="!(products||[]).length && !isSortTouched">
                  <v-row>
                    <div class="w-100 center">
                      <v-progress-circular
                        indeterminate
                        color="amber"
                      ></v-progress-circular>
                    </div>
                  </v-row>
                </template>
                <template v-if="isSortTouched">
                  <div class="products__result-404 center">
                    <h5 class="h4 text-center">
                      Извините, но у нас нет блюд, которые подходят под ваши
                      критерии
                    </h5>
                    <v-img
                      src="/images/search.webp"
                      max-width="500"
                      max-height="300"
                    >
                      <template v-slot:placeholder>
                        <v-row
                          class="fill-height ma-0"
                          align="center"
                          justify="center"
                        >
                          <v-progress-circular
                            indeterminate
                            color="grey lighten-5"
                          ></v-progress-circular>
                        </v-row>
                      </template>
                    </v-img>
                  </div>
                </template>
              </template>
            </GridLayout>
          </div>
        </div>
      </template>
    </BasicLayout>
  </div>
</template>

<script lang="js">
import BasicLayout from '../layouts/VBasicLayout';
import GridLayout from '../layouts/GridLayout';
import FilterComponent from '../components/VFilter';
import CardComponent from '../components/VCard';
import {mapState} from 'vuex';
import PaginationComponent from '../components/VPagination'
import {chunk} from 'lodash';

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
      isTouched:true,
      per_page: 2
      }
  },
  components:{
      BasicLayout,
      GridLayout,
      FilterComponent,
      CardComponent,
      PaginationComponent
  },
  computed:{
      ...mapState({
        isSortTouched:state=>state.isSortTouched,
        products:state=>{
          const result = chunk(state.products||[],state.pagination.per_page);
          if(result.length) return result[state.pagination.page-1];
          return result||[];
        }
      })
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

.products__result-404{
    width: 60% !important;
    padding-top: 3rem;
}

.products__content {
  width: 60%;
  flex: 1 1 60%;
}

.products__result {
  grid-template-columns: repeat(auto-fit, minmax(250px, 350px));
  align-content: center;
  justify-content: center;
}

.empty-card-sm {
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

.products__pagination{
  grid-column: 1/-1;
}

@media screen and (max-width: 900px) {
}
</style>
