<template>
  <div class="w-100">
    <BasicLayout
      :isSection="true"
      :isFirstSlide="true"
      :isFullContent="true"
      class="main-cards admin"
      v-if="isAuth"
    >
      <template v-slot:title> Ваши заказы </template>
      <template #descr> Самое вкусное, самое ароматное </template>
      <template v-slot:content>
        <div class="center w-100">
          <div class="admin__alerts w-100">
            <v-card class="v-card w-100 p-4" outlined>
              <v-card-title class="w-100 text-center center mb-4">
                Общая информация
              </v-card-title>
              <v-card-text class="center flex-row">
                <GridLayout>
                  <template #content>
                    <v-alert
                      border="right"
                      type="success"
                      color="blue-grey"
                      dark
                      class="w-100"
                    >
                      За всё время вы приобрели {{ user.orders.length }} товаров
                    </v-alert>
                    <v-alert border="right" class="w-100" type="warning" dark>
                      У вас в корзине находиться
                      {{ product_list.length }} товаров
                    </v-alert>
                    <v-alert border="right" class="w-100" type="success" dark>
                      Вы являетесь нашим покупателем больше 1 года
                    </v-alert>
                  </template>
                </GridLayout>
              </v-card-text>
            </v-card>
          </div>
          <div
            class="center admin__content w-100 align-items-start position-relative"
          >
            <v-card outlined class="admin__info center p-4">
              <v-card-title class="w-100">
                <div class="text-center w-100">Пользователь</div>
              </v-card-title>
              <v-divider></v-divider>
              <v-card-text>
                <v-list dense>
                  <v-subheader>Ваши данные</v-subheader>
                  <v-list-item-group color="primary">
                    <v-list-item>
                      <v-list-item-icon>
                        <v-icon v-text="'alternate_email'"></v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title>
                          {{ user.email }}
                        </v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-icon>
                        <v-icon v-text="'remove_red_eye'"></v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title>
                          {{ user.password }}
                        </v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>
                  </v-list-item-group>
                </v-list>
              </v-card-text>
            </v-card>
            <div class="admin__orders center">
              <v-card outlined class="p-4 w-100">
                <v-card-title class="text-center h3 w-100 center">
                  Ваша корзина
                </v-card-title>
                <v-card-text>
                  <v-simple-table>
                    <template v-slot:default>
                      <thead>
                        <tr>
                          <th class="text-left">№</th>
                          <th class="text-left">Название</th>
                          <th class="text-left">Цена</th>
                          <th class="text-left">Количество</th>
                          <th class="text-left">Дата</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="item in product_list"
                          :key="item.title + Math.random()"
                        >
                          <td class="center text-center">
                            <v-checkbox
                              color="orange"
                              value="orange"
                              hide-details
                              v-on:change="selectItems(item.id)"
                              class="mt-0"
                            ></v-checkbox>
                          </td>
                          <td>
                            <router-link
                              :to="'/product/' + item.product_id"
                              style="color: #212121"
                            >
                              {{ item.title }}
                            </router-link>
                          </td>
                          <td>{{ item.price }}</td>
                          <td>
                            <v-text-field
                              type="number"
                              outlined
                              dense
                              color="orange"
                              style="max-width: 100px"
                              v-on:change="
                                changeNum(item.id, $event.target.value)
                              "
                              :value="item.quantity"
                              counter="2"
                            >
                            </v-text-field>
                          </td>
                          <td>{{ item.date }}</td>
                        </tr>
                      </tbody>
                    </template>
                  </v-simple-table>
                </v-card-text>
                <v-card-text v-if="product_list.length">
                  <v-text-field
                    v-model="location"
                    persistent-hint
                    hint="Укажите ваш правильный адрес"
                    outlined
                  >
                    <template #label> Ваш адрес </template>
                  </v-text-field>
                </v-card-text>
                <v-card-text
                  class="center justify-content-end w-100"
                  v-if="product_list.length"
                >
                  <div class="admin__btns">
                    <v-btn depressed color="orange" @click="checkOrder()">
                      Потвердить заказ
                    </v-btn>
                    <v-btn
                      depressed
                      color="error"
                      @click="deleteUncheckedOrders()"
                      v-if="selectedItems.length"
                    >
                      Удалить {{ selectedItems.length }} тв.
                    </v-btn>
                  </div>
                </v-card-text>
              </v-card>
              <v-card outlined class="mt-4 p-4 w-100">
                <v-card-title class="w-100 center"
                  >Приготовленные заказы</v-card-title
                >
                <v-card-text>
                  <v-simple-table>
                    <template v-slot:default>
                      <thead>
                        <tr>
                          <th class="text-left">№</th>

                          <th class="text-left">Название</th>
                          <th class="text-left">Цена</th>
                          <th class="text-left">Количество</th>
                          <th class="text-left">Дата</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(item, index) in unactiveOrders"
                          :key="item.title + Math.random()"
                        >
                          <td>
                            {{ index + 1 }}
                          </td>
                          <td>
                            <router-link
                              :to="'/product/' + item.product_id"
                              style="color: #212121"
                            >
                              {{ item.title }}
                            </router-link>
                          </td>
                          <td>{{ item.price }}</td>
                          <td>{{ item.quantity.slice(1, -1) }}</td>
                          <td>{{ item.date }}</td>
                        </tr>
                      </tbody>
                    </template>
                  </v-simple-table>
                </v-card-text>
              </v-card>
              <v-card outlined class="mt-4 p-4 w-100">
                <v-card-title class="w-100 center"
                  >Заказы, которые ещё готовяться</v-card-title
                >
                <v-card-text>
                  <v-simple-table>
                    <template v-slot:default>
                      <thead>
                        <tr>
                          <th class="text-left">№</th>
                          <th class="text-left">Название</th>
                          <th class="text-left">Цена</th>
                          <th class="text-left">Количество</th>
                          <th class="text-left">Дата</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(item, index) in activeOrders"
                          :key="item.title + Math.random()"
                        >
                          <td>
                            {{ index + 1 }}
                          </td>
                          <td>
                            <router-link
                              :to="'/product/' + item.product_id"
                              style="color: #212121"
                            >
                              {{ item.title }}
                            </router-link>
                          </td>
                          <td>{{ item.price }}</td>
                          <td>{{ item.quantity }}</td>
                          <td>{{ item.date.slice(1, -1) }}</td>
                        </tr>
                      </tbody>
                    </template>
                  </v-simple-table>
                </v-card-text>
              </v-card>
            </div>
          </div>
        </div>
      </template>
    </BasicLayout>
    <template v-else>
      <BasicLayout
        :isSection="true"
        :isFirstSlide="true"
        class="main-cards admin"
      >
        <div class="center w-100">
          <v-progress-circular
            indeterminate
            color="amber"
            :size="140"
          ></v-progress-circular>
        </div>
      </BasicLayout>
    </template>
  </div>
</template>

<script>
import BasicLayout from "../layouts/VBasicLayout";
import { mapGetters, mapState } from "vuex";
import GridLayout from "../layouts/GridLayout";

export default {
  components: {
    BasicLayout,
    GridLayout,
  },
  data: function () {
    return { location: "", selectedItems: [] };
  },
  computed: {
    ...mapState({
      user: (state) => state.user,
      isAuth: (state) => state.user.isAuth,
      product_list: (state) => state.user.uncheckedOrders,
    }),
    ...mapGetters({
      unactiveOrders: "getUnactiveOrders",
      activeOrders: "getActiveOrders",
    }),
  },
  async mounted() {
    if (typeof parseInt(this.user.id, 10) == "number" && this.isAuth) {
      const response = await fetch(`/api/view-orders/?isjson=true`, {
        headers: {
          Auth: localStorage.getItem("data"),
        },
      });

      if (response.ok) {
        const data = await response.json();
        this.$store.commit("clearOrders");
        this.$store.commit("addOrders", data.data || []);
      }
    } else {
      this.$router.push({ name: "login" });
    }
  },
  methods: {
    checkOrder() {
      this.$store.dispatch("addOrderToServer", { location: this.location });
    },
    changeNum(id, quantity) {
      this.$store.commit("changeOrderQuantity", {
        id: id,
        quantity: +quantity,
      });
    },
    selectItems(id) {
      const order = this.$store.state.user.uncheckedOrders.find(
        (v) => v.id == id
      );
      const index = this.selectedItems.findIndex((v) => v == order);

      if (index == -1) {
        this.selectedItems.push(order);
      } else {
        this.selectedItems.splice(index, 1);
      }
    },
    deleteUncheckedOrders() {
      this.$store.commit("deleteUncheckedOrders", this.selectedItems);
    },
  },
};
</script>

<style lang="scss">
.admin__info {
  flex: 1 1 30%;
}

.admin__btns {
  max-width: 300px;

  button {
    width: 100%;
    margin-bottom: 8px;
    transition-property: width;
    transition-duration: 1s;
  }
}

.admin__orders {
  flex: 1 1 70%;

  > div {
    width: 100%;
  }
}

.admin__content > div {
  margin: 8px;
}

.admin__alerts {
  margin: 0 auto;
  margin-bottom: 16px;
  width: calc(100% - 16px) !important;
}

.admin__content {
  flex-direction: row !important;
}

@media (max-width: 900px) {
  .admin__content {
    flex-direction: column !important;

    .admin__info,
    .admin__orders {
      flex: 1 1 100%;
      width: calc(100% - 16px);
    }

    .v-list-item-group {
      display: flex;
    }

    .admin__alerts {
      margin-bottom: 10px;
    }
  }
}
</style>