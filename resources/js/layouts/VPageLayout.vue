<template>
  <section class="product w-100 first-slide center">
    <div class="product__wrap wrap-md-pd" v-if="isLoaded">
      <div class="center">
        <div class="breadcrumps wrap-md">
          <v-breadcrumbs :items="items" divider="/" large> </v-breadcrumbs>
        </div>
        <div class="shadow  pl-0 pr-0 w-100">
          <div class="product__content wrap-md">
            <div class="product__image">
              <div class="row h-100">
                <div class="col-2 center">
                  <div class="stars center" v-for="n in 5" :key="n">
                    <v-img
                      src="/images/star.svg"
                      width="25px"
                      height="25px"
                      class="m-1"
                    ></v-img>
                  </div>
                </div>
                <div class="col-8">
                  <v-img
                    :src="'/' + product.image"
                    contain
                    min-width="100%"
                    height="100%"
                  ></v-img>
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
                  <v-btn color="bg-red" dark x-large depressed block
                    >В корзину</v-btn
                  >
                </div>
              </div>
            </div>

            <div class="product__long-info">
              <v-card>
                <v-toolbar flat color="anchor" dark>
                  <v-toolbar-title>Описание</v-toolbar-title>
                </v-toolbar>
                <v-tabs vertical>
                  <v-tab> Состав </v-tab>
                  <v-tab> Коротко </v-tab>

                  <v-tab-item>
                    <v-card class="product__tab-item" flat>
                      <v-list shaped>
                        <v-subheader>Продукты</v-subheader>
                        <v-list-item-group v-model="selectedItem">
                          <v-list-item v-for="(item, i) in products" :key="i">
                            <v-list-item-content>
                              <v-list-item-title
                                v-text="item"
                              ></v-list-item-title>
                            </v-list-item-content>
                          </v-list-item>
                        </v-list-item-group>
                      </v-list>
                    </v-card>
                  </v-tab-item>

                  <v-tab-item>
                    <v-card flat class="product__tab-item">
                      <v-card-text>
                        <p class="product__short-text">
                          {{ product.long_description }}
                        </p>
                      </v-card-text>
                    </v-card>
                  </v-tab-item>
                </v-tabs>
              </v-card>
            </div>
            <div class="product__other-ingredients w-100 h-100"></div>
          </div>
          <div class="product__ads w-100">
               <div :class="'product__ads-bg w-100 center ' + product_ad_class">
                   <div class="product__ads-content wrap-md">
                       <slot name="ads"></slot>
                   </div>
               </div>
          </div>
        </div>
      </div>
    </div>
    <div class="center w-100 wrap-md-pd" v-else>
      <v-progress-circular
        :size="100"
        color="amber"
        indeterminate
      ></v-progress-circular>
    </div>
  </section>
</template>

<script>
export default {
  name: "PageLayoutComponent",
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
    };
  },
  props: {
    items: {
      type: Array,
      default: [],
    },
    product: Object,
    product_ad_class:{
      default:"",
      type: String
    }
  },
  computed: {
    isLoaded: function (params) {
      return Object.values(this.product).every((v) => v);
    },
  },
};
</script>

<style scoped lang="scss">
.product__title {
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

.product__content {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-auto-rows: auto auto;
  grid-gap: 10px;
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

@media screen and (min-width: 1000px) {
  .product__tab-item {
    min-height: 280px;
  }
}

@media screen and (max-width: 1000px) {
}
</style>