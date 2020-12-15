<template>
<div class="allspace">
<v-system-bar
  color="primary"
  height='72px'
>
     <h1 class="text-center brand-name w-100">MyPizza</h1>
</v-system-bar>
<v-navigation-drawer
  permanent
  expand-on-hover>
    <v-list
          nav
          dense
        >
          <v-list-item link>
            <v-list-item-icon>
              <v-icon>mdi-folder</v-icon>
            </v-list-item-icon>
            <v-list-item-title>
               <router-link to="/orders-list">Мои заказы</router-link>
            </v-list-item-title>
          </v-list-item>
          <v-list-item link>
            <v-list-item-icon>
              <v-icon>mdi-account-multiple</v-icon>
            </v-list-item-icon>
            <v-list-item-title>
                <router-link to="/orders-list">Пицца</router-link>
            </v-list-item-title>
          </v-list-item>
          <v-list-item link>
            <v-list-item-icon>
              <v-icon>mdi-star</v-icon>
            </v-list-item-icon>
            <v-list-item-title>
              <router-link to="/orders-list">Салаты</router-link>
            </v-list-item-title>
          </v-list-item>
      </v-list>
</v-navigation-drawer>
</div>
</template>

<script>
export default {
    name: 'HeaderComponent'
}
</script>