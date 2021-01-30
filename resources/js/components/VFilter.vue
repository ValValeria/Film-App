<template>
  <div class="product__search-form">
    <v-card flat class="shadow">
      <v-list rounded>
        <v-tabs
          color="error"
          next-icon="mdi-arrow-right-bold-box-outline"
          prev-icon="mdi-arrow-left-bold-box-outline"
          centered
          show-arrows
          v-model="activeItem"
        >
          <v-tab> Категории </v-tab>
          <v-tab>Цена</v-tab>
          <v-tab>Вес</v-tab>
          <v-tab>Другие опции</v-tab>
          <v-tab>Хочу с </v-tab>
        </v-tabs>

        <v-tabs-items v-model="activeItem">
          <v-tab-item>
            <div class="product__search-category">
              <v-overflow-btn
                class="my-2"
                :items="categories"
                label="Доступные категории"
                item-value="text"
                v-on:change="sort('category',$event)"
              ></v-overflow-btn>
            </div>
          </v-tab-item>
          <v-tab-item>
            <div class="product__search-category">
              <div flat class="w-100">
                <div class="pt-1 w-100">
                  <v-slider
                    v-model="activeWeight"
                    step="50"
                    min="50"
                    :max="max_weight"
                    v-on:change="sort('weight',$event)"
                  ></v-slider>
                </div>
                <v-subheader class="w-100 text-center">
                  Максимальный вес {{ activeWeight }} гр
                </v-subheader>
              </div>
            </div>
          </v-tab-item>
          <v-tab-item>
            <div class="product__search-category">
              <div flat class="w-100">
                <div class="pt-1 w-100">
                  <v-slider
                    v-model="activePrice"
                    step="50"
                    min="50"
                    :max="max_price"
                    v-on:change="sort('price',$event)"
                  ></v-slider>
                </div>
                <v-subheader class="w-100 text-center">
                  Найти товары по цене от {{ activePrice }} грн
                </v-subheader>
              </div>
            </div>
          </v-tab-item>
          <v-tab-item>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>
                  <v-checkbox
                    v-model="sortByAsc"
                    label="От дорогих к дешевым"
                    color="orange"
                    value="warning"
                    hide-details
                  ></v-checkbox>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>
                  <v-checkbox
                    v-model="sortByDesc"
                    label="От дешевых к дорогим товарам"
                    color="orange"
                    value="warning"
                    hide-details
                  ></v-checkbox>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-tab-item>

          <v-tab-item>
            <div class="product__igredients flex-wrap">
              <div v-for="food in ingredients" :key="food" class="center">
                <v-checkbox
                  v-on:change="foodToIncludes.push(food);sort('ingredients',foodToIncludes)"
                  :label="food"
                  color="error"
                  value="warning"
                  hide-details
                ></v-checkbox>
              </div>
            </div>
          </v-tab-item>
        </v-tabs-items>
      </v-list>
    </v-card>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  data: function () {
    return {
      sortByDesc: true,
      sortByAsc: false,
      foodToIncludes: [],
      activeItem: 0,
      activePrice: 200,
      activeWeight: 250,
      sortQuery:{}
    };
  },
  computed: mapState({
    categories: (state) =>
      state.sortData.categories.map((v) => v.toLowerCase()),
    ingredients: (state) =>
      state.sortData.ingredients.map((v) => v.toLowerCase()),
    max_weight: (state) => state.sortData.max_weight,
    max_price: (state) => state.sortData.max_price,
  }),
  mounted() {
    this.$store.dispatch("getAdditionalData");
  },
  methods:{
    sort(type,$event){
      this.sortQuery[type]=$event;
      this.$store.dispatch("getSortedProducts",this.sortQuery)
    }
  }
};
</script>

<style lang="scss">
.product__search-category {
  padding: 10px 20px;
}

.product__igredients > div{
  flex: 1 1 33%;
}

.product__igredients{
  display:flex;
  align-items: center;
  justify-content: center;
  padding:1rem 0;
}

@media screen and (max-width:800px){
  .product__igredients{
    flex-wrap:wrap;
  }
}
</style>