<template>
  <div>
    <v-list-item-group color="primary" class="center flex-row">
      <v-list-item v-for="link in links" :key="link+Math.random(0,60)">
        <v-list-item-content>
          <v-list-item-title>
            <v-btn text>
              <router-link :to="link.path">{{ link.name }}</router-link>
            </v-btn>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list-item-group>
  </div>
</template>

<script>
export default {
  name: "HeaderLinks",
  data: function () {
    return {
      links: [
        { path: "/", name: "Главная" },
        { path: "/orders-list", name: "Мой заказы" },
        { path: "/pizza", name: "Пицца" },
        { path: "/food", name: "Салаты" },
      ],
    };
  },
};
</script>

<style scoped>
  a{
    color:white !important;
  }
</style>