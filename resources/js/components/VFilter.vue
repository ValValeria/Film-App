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
              ></v-overflow-btn>
            </div>
          </v-tab-item>
          <v-tab-item>
            <div class="product__search-category">
              <v-slider
                :v-model="activeWeight"
                step="50"
                min="50"
                max="500"
                ticks
                :hint="'Максимальные вес ' + activeWeight"
              ></v-slider>
            </div>
          </v-tab-item>
          <v-tab-item>
            <div class="product__search-category">
              <v-slider
                :v-model="activePrice"
                step="50"
                max="900"
                min="50"
                :hint="'Найти товары по цене от ' + activePrice"
                ticks
              ></v-slider>
            </div>
          </v-tab-item>
          <v-tab-item>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>
                  <v-checkbox
                    v-model="sortByAsc"
                    label="От дорогих к дешевым"
                    color="error"
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
                    color="error"
                    value="warning"
                    hide-details
                  ></v-checkbox>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-tab-item>

          <v-tab-item>
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>
                  <v-checkbox
                    v-on:change="foodToIncludes.push('cheese')"
                    label="Сыр моцарелла"
                    color="error"
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
                    v-on:change="foodToIncludes.push('mauran')"
                    label="Соус майоран"
                    color="error"
                    value="warning"
                    hide-details
                  ></v-checkbox>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-tab-item>
        </v-tabs-items>
      </v-list>
    </v-card>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      sortByDesc: true,
      sortByAsc: false,
      categories: ["Пицца", "Салаты"],
      foodToIncludes: [],
      activeItem: 0,
      activePrice: 200,
      activeWeight: 250,
    };
  },
};
</script>

<style lang="scss">
.product__search-category {
  padding: 10px 20px;
}
</style>