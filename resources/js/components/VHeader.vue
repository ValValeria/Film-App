<template>
  <div class="w-100">
     <v-list nav dense>
        <v-list-item link>
          <v-list-item-icon>
            <div class="img-container">
              <img src="/images/order.svg" alt="pizza" />
            </div>
          </v-list-item-icon>
          <v-list-item-title>
            <router-link to="/orders-list">Мои заказы</router-link>
          </v-list-item-title>
        </v-list-item>
        <v-list-item link>
          <v-list-item-icon>
            <div class="img-container">
              <img src="/images/pizza.svg" alt="pizza" />
            </div>
          </v-list-item-icon>
          <v-list-item-title>
            <router-link to="/orders-list">Пицца</router-link>
          </v-list-item-title>
        </v-list-item>
        <v-list-item link>
          <v-list-item-icon>
            <div class="img-container">
              <img src="/images/food.svg" alt="pizza" />
            </div>
          </v-list-item-icon>
          <v-list-item-title>
            <router-link to="/orders-list">Салаты</router-link>
          </v-list-item-title>
        </v-list-item>
      </v-list>
  </div>
</template>

<script>
export default {
  name: "HeaderComponent",
};
</script>