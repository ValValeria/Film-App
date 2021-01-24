<template>
  <div class="product w-100 first-slide center">
    <v-snackbar v-model="snackbar">
      Добавлено в корзину

      <template v-slot:action="{ attrs }">
        <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">
          Close
        </v-btn>
      </template>
    </v-snackbar>
    <BasicLayout :isSection="true" class="main-cards" v-if="isLoaded">
      <template #breadcrumps>
        <div class="breadcrumps wrap-md">
          <v-breadcrumbs :items="items" divider="/" large> </v-breadcrumbs>
        </div>
      </template>
      <template v-slot:title> Наше меню </template>
      <template #descr> Самое вкусное, самое ароматное </template>
      <template v-slot:content>
        <div class="product__wrap w-100" v-if="isLoaded">
          <div class="product__content center">
            <div class="shadow pl-0 pr-0 w-100">
              <div class="product__main-content wrap-md">
                <div class="product__image">
                  <div class="row h-100">
                    <div class="col-2 center">
                      <div class="stars center" v-for="n in 5" :key="n">
                        <v-img
                          src="/images/star.svg"
                          width="25px"
                          height="25px"
                          class="m-1"
                        >
                        </v-img>
                      </div>
                    </div>
                    <div class="col-8">
                      <v-img
                        :src="'/' + product.image"
                        contain
                        min-width="100%"
                        height="100%"
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
                  </div>
                </div>

                <div class="product__info">
                  <div class="product__card">
                    <div class="product__title">
                      {{ product.title }}
                    </div>
                    <div class="product__available">В наличии</div>
                    <div class="product__short-text">
                      {{ product.short_description }}
                    </div>
                    <div class="product__price">
                      <span>{{ product.price }} ₴</span>
                      /
                      <span>{{ product.weight }} грамм</span>
                    </div>
                    <div class="product__btn">
                      <v-btn
                        color="bg-red"
                        dark
                        x-large
                        depressed
                        block
                        @click="addToOrders(product)"
                        >В корзину</v-btn
                      >
                    </div>
                  </div>
                </div>
              </div>

              <div class="product__long-descr wrap-md">
                <h5 class="title-sm center">Описание</h5>
                <div class="product__expensions">
                  <v-expansion-panels focusable>
                    <v-expansion-panel>
                      <v-expansion-panel-header expand-icon="fastfood">
                        <div class="product__expension-text">
                          Полное описание
                        </div>
                      </v-expansion-panel-header>
                      <v-expansion-panel-content>
                        <div class="product__expension-text">
                          {{ product.long_description }}
                        </div>
                      </v-expansion-panel-content>
                    </v-expansion-panel>
                    <v-expansion-panel>
                      <v-expansion-panel-header expand-icon="local_drink">
                        <div class="product__expension-text">Состав</div>
                      </v-expansion-panel-header>
                      <v-expansion-panel-content>
                        <div class="product__expension-text"></div>
                      </v-expansion-panel-content>
                    </v-expansion-panel>
                  </v-expansion-panels>
                </div>
              </div>

              <div class="product__ads wrap-md">
                <h5 class="title-sm center">Попробуйте также</h5>
                <div class="product__ads-content">
                  <v-container fluid>
                    <div class="product__ads-items center">
                      <GridLayout>
                        <template #content v-if="!otherProducts.length">
                          <v-sheet
                            :color="`grey ${
                              theme.isDark ? 'darken-2' : 'lighten-4'
                            }`"
                            class="pa-3 w-100"
                            v-for="number in 3"
                            :key="number"
                          >
                            <v-skeleton-loader
                              class="mx-auto"
                              max-width="300"
                              type="card"
                            ></v-skeleton-loader>
                          </v-sheet>
                        </template>
                        <template #content v-else>
                          <CardComponent
                            v-for="item in otherProducts"
                            :key="item + Math.random()"
                            :url="item.image"
                            :title="item.title"
                            :descr="item.long_description"
                            :subtitle="item.short_description"
                            :id="item.id"
                            classes="card-ad all-width"
                          />
                        </template>
                      </GridLayout>
                    </div>
                  </v-container>
                </div>
              </div>
            </div>
          </div>
        </div>
      </template>
    </BasicLayout>
    <div class="center w-100 wrap-md-pd" v-else>
      <v-progress-circular
        :size="100"
        color="amber"
        indeterminate
      ></v-progress-circular>
    </div>
  </div>
</template>

<script>
import BasicLayout from "./VBasicLayout";
import GridLayout from "./GridLayout";
import CardComponent from "../components/VCard";

export default {
  name: "PageLayoutComponent",
  inject: {
    theme: {
      default: { isDark: false },
    },
  },
  data: function () {
    return {
      rating: 5,
      tab: null,
      products: [
        "Курица",
        "Сыр пармиан",
        "Мука пшеничная",
        "Молоко",
        "Кетчуп",
        "Оливковое масло",
      ],
      selectedItem: 2,
      snackbar:false
    };
  },
  props: {
    items: {
      type: Array,
      default: [],
    },
    product: Object,
    product_ad_class: {
      default: "",
      type: String,
    },
    otherProducts: {
      type: Array,
      default: [],
    },
  },
  computed: {
    isLoaded: function (params) {
      return Object.values(this.product).every((v) => v);
    },
  },
  components: {
    BasicLayout,
    GridLayout,
    CardComponent,
  },
  methods: {
    addToOrders(product) {
      this.$store.commit("addUncheckOrders", [product]);
      this.snackbar = true;
    },
  },
};
</script>

<style  lang="scss">
.product__title,
.title-sm {
  margin-bottom: 2.54rem !important;
  margin: 0 0 25px;
  font-size: 36px;
  line-height: 42px;
  font-weight: 300;
}

.product__image,
.product__info {
  width: 100%;
  grid-column: span 2;
}

.product__info {
  padding: 1rem;
}

.product__main-content {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-auto-rows: auto auto;
  grid-gap: 10px;
}

.product__long-descr,
.product__main-content,
.product__ads {
  padding: 2.5rem 0;
}

.product__long-info {
  grid-column: span 2;
  margin-top: 1.7rem;
  padding: 0 15px;
}

.product__available {
  color: #00bb16;
  font-size: 16px;
  font-weight: 400;
  /* font-family: 'GothamPro', 'geometria', Arial, Helvetica, sans-serif; */
  line-height: 30px;
}

.product__wrap > div > div {
  padding: 1.6rem;
}

.product__short-text {
  margin: 0 0 39px;
  font-size: 18px;
  line-height: 34px;
}

.product__expension-text {
  font-size: 18px;
  line-height: 34px;
  margin: 20px 0;
}

.product__price {
  margin: 0 0 41px;
  font-size: 18px;
  line-height: 30px;

  > span:nth-child(1) {
    font-size: 30px;
  }

  > span:nth-child(2) {
    font-size: 18px;
  }
}

.wrap-md-pd {
  padding: 3.5rem 0 !important;
}

.product__ads {
  grid-column: 1/-1;
  padding: 2.5rem 0;
}

.breadcrumps {
  margin-bottom: 2.5rem;
}

@media screen and (min-width: 1000px) {
  .product__tab-item {
    min-height: 280px;
  }
}
</style>