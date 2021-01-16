<template>
  <div class="product__search-form">
    <v-card flat class="shadow">
      <v-list rounded>
        <v-subheader class="text-center w-100">
          <div class="w-100 text-center">ПОИСК</div>
        </v-subheader>
        <v-list-group :value="false" prepend-icon="mdi-account-circle">
          <template v-slot:activator>
            <v-list-item-title>Категории</v-list-item-title>
          </template>
          <div class="product__search-category">
            <v-overflow-btn
              class="my-2"
              :items="categories"
              label="Доступные категории"
              item-value="text"
            ></v-overflow-btn>
          </div>
        </v-list-group>
        <v-list-group :value="false" prepend-icon="mdi-account-circle">
          <template v-slot:activator>
            <v-list-item-title>Цена</v-list-item-title>
          </template>
          <div class="product__search-category">
            <v-slider :v-model="700" step="10" thumb-label ticks color="error"></v-slider>
          </div>
        </v-list-group>
        <v-list-group :value="false" prepend-icon="mdi-account-circle">
          <template v-slot:activator>
            <v-list-item-title>Вес</v-list-item-title>
          </template>
          <div class="product__search-category">
            <v-slider :v-model="700" step="10" thumb-label ticks color="error"></v-slider>
          </div>
        </v-list-group>
        <v-list-group :value="false" prepend-icon="mdi-account-circle">
          <template v-slot:activator>
            <v-list-item-title>Другие опции</v-list-item-title>
          </template>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>
                <v-checkbox
                  v-model="sortByAsc"
                  label="От дорогих к дешевым"
                  color="warning"
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
                  color="warning"
                  value="warning"
                  hide-details
                ></v-checkbox>
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-group>
        <v-list-group :value="false" prepend-icon="mdi-account-circle">
          <template v-slot:activator>
            <v-list-item-title>Хочу с </v-list-item-title>
          </template>
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
        </v-list-group>
        <v-list-item>
          <v-list-item-content>
            <v-btn class="bg-red" dark large depressed> Найти </v-btn>
          </v-list-item-content>
        </v-list-item>
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
    };
  },
};
</script>

<style lang="scss">
.product__search-category {
  padding: 10px 20px;
}
</style>