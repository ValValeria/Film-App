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
          <v-tab>Поиск по названию</v-tab>
          <v-tab>Категории</v-tab>
          <v-tab>Вес</v-tab>
          <v-tab>Цена</v-tab>
          <v-tab>Хочу с </v-tab>
        </v-tabs>

        <v-tabs-items v-model="activeItem">
          <v-tab-item>
            <div class="product__search-category center flex-row">
              <v-text-field
                outlined
                clearable
                label="поиск"
                type="text"
                v-model="searchText"
                v-on:input="find()"
              >
                <template v-slot:append>
                  <v-fade-transition leave-absolute>
                    <v-progress-circular
                      v-if="loading"
                      size="24"
                      color="info"
                      indeterminate
                    ></v-progress-circular>
                  </v-fade-transition>
                </template>
                <template v-slot:append-outer>
                  <div class="w-100 center">
                    <v-btn color="error" v-on:click="sort('text', searchText)">
                      Найти
                    </v-btn>
                  </div>
                </template>
                <template v-slot:label>
                  Найди <strong>своё блюдо</strong>
                  <v-icon style="vertical-align: middle">
                    mdi-file-find
                  </v-icon>
                </template>
              </v-text-field>
            </div>
          </v-tab-item>
          <v-tab-item>
            <div class="product__search-category">
              <v-overflow-btn
                class="my-2"
                :items="categories"
                label="Доступные категории"
                item-value="text"
                v-on:change="sort('category', $event)"
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
                    v-on:change="sort('weight', $event)"
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
                    v-on:change="sort('price', $event)"
                  ></v-slider>
                </div>
                <v-subheader class="w-100 text-center">
                  Найти товары по цене от {{ activePrice }} грн
                </v-subheader>
              </div>
            </div>
          </v-tab-item>

          <v-tab-item>
            <div class="product__search-category center flex-row">
              <div class="product__igredients flex-wrap">
                <div v-for="food in ingredients" :key="food" class="center">
                  <v-checkbox
                    v-on:change="
                      foodToIncludes.push(food);
                      sort('ingredients', foodToIncludes);
                    "
                    :label="food"
                    color="error"
                    value="warning"
                    hide-details
                  ></v-checkbox>
                </div>
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
      sortQuery: {},
    };
  },
  computed: {
    ...mapState({
      categories: (state) =>
        state.sortData.categories.map((v) => v.toLowerCase()),
      ingredients: (state) =>
        state.sortData.ingredients.map((v) => v.toLowerCase()),
      max_weight: (state) => state.sortData.max_weight,
      max_price: (state) => state.sortData.max_price,
      loading: (state) => state.pagination.loading,
      searchText:state=>state.word.toLowerCase()
    }),
  },
  mounted() {
    this.$store.dispatch("getAdditionalData");
  },
  methods: {
    sort(type, $event) {
      this.sortQuery[type] = $event;
      this.$store.commit("changePage", 1);
      this.$store.dispatch("getSortedProducts", this.sortQuery);
    },
  },
  watch:{
    searchText(value){
      if(value.length){
        this.$store.commit("updateWord", value);
        this.sort('text',this.searchText);
      }
    }
  }
};
</script>

<style lang="scss">
.product__search-category {
  padding: 10px 20px;
  margin: 0 auto;
  margin-top: 20px;
  max-width: 900px;
  width: 88%;
  margin-top: 20px;
}

.product__igredients > div {
  flex: 1 1 33%;
}

.product__search-category .v-input__append-outer {
  margin-top: 10px !important;
}

.product__igredients {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1rem 0;
  width:100%;
}

@media screen and (max-width: 800px) {
  .product__igredients {
    flex-wrap: wrap;
  }
}
</style>