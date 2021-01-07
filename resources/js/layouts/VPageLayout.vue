<template>
  <section class="product w-100 first-slide center">
    <div class="product__wrap wrap-md-pd" v-if="isLoaded">
      <div class="wrap-md">
        <div class="breadcrumps">
          <v-breadcrumbs :items="items">
            <template v-slot:divider>
              <v-icon>mdi-chevron-right</v-icon>
            </template>
          </v-breadcrumbs>
        </div>
        <div class="product__greeting">
          <div class="text-center">
            <h2 class="product__greeting-title text-center">
              <slot name="title"></slot>
            </h2>
            <p class="product__greeting-description">
              <slot name="descr"></slot>
              <v-divider></v-divider>
            </p>
          </div>
        </div>
        <div class="product__content center">
          <div class="product__image">
            <div class="row">
              <div class="col-8">
                <v-img
                  :src="'/' + product.image"
                  max-width="400px"
                  min-height="300px"
                  contain
                ></v-img>
              </div>
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
            </div>
          </div>

          <div class="product__info">
            <div>
              <v-card outlined>
                <v-card-title>
                  {{ product.title }}
                </v-card-title>
                <v-card-text>
                  {{ product.short_description }}
                </v-card-text>
                <v-card-text>
                  <v-simple-table>
                    <template v-slot:default>
                      <thead>
                        <tr>
                          <th class="text-left">Характеристики</th>
                          <th class="text-left">Значения</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr >
                          <td>Масса</td>
                          <td>{{product.weight}}</td>
                        </tr>
                      </tbody>
                    </template>
                  </v-simple-table>
                </v-card-text>
              </v-card>
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
    return { rating: 5 };
  },
  props: {
    items: {
      type: Array,
      default: [],
    },
    product: Object,
  },
  computed: {
    isLoaded: function (params) {
      return Object.values(this.product).every((v) => v);
    },
  },
};
</script>

<style scoped>
.product__title {
  margin-bottom: 2.54rem !important;
}

.product__wrap > div > div {
  padding-bottom: 1.6rem;
}

.wrap-md-pd {
  padding: 3.5rem 0 !important;
}

.product__greeting-title {
  margin: 0 auto !important;
  text-transform: uppercase;
  font-size: 45px !important;
  line-height: 1.2;
  word-break: break-word;
  width: 90%;
  font-weight: 300;
  margin-bottom: 1.54rem !important;
}

.product__greeting-description {
  font-weight: 300;
  margin: 20px 0;
  text-align: center;
  font-size: 20px;
}

@media screen and (min-width: 900px) {
  .product__content {
    flex-direction: row;
    width: 100%;
  }
  .product__content > div {
    flex: 1 1 50%;
    max-width: 50%;
  }
}
</style>