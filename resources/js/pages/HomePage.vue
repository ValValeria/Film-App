<template>
  <div class="w-100">
    <BannerComponent />
    <BasicLayout :isSection="true">
      <template v-slot:title> Наше меню </template>
      <template #descr> Самое вкусное, самое ароматное </template>
      <template v-slot:content>
        <v-item-group>
          <v-container>
            <v-row v-if="items.length">
              <v-col
                v-for="item in items"
                :key="item + Math.random()"
                :cols="4"
                :md="12"
              >
                <CardComponent
                  :url="item.image"
                  :title="item.title"
                  :descr="item.long_description"
                  :subtitle="item.short_description"
                  :id="item.id"
                />
              </v-col>
            </v-row>
            <v-row v-else>
              <div class="w-100 center">
                <v-progress-circular
                  indeterminate
                  color="amber"
                ></v-progress-circular>
              </div>
            </v-row>
          </v-container>
        </v-item-group>
      </template>
    </BasicLayout>

    <BasicLayout :isSection="true">
      <template v-slot:title> У нас большой выбор </template>
      <template v-slot:descr>
        Каждую неделю мы стараемся придумывать для вас что-то новое
      </template>
      <template v-slot:content>
        <v-container fluid></v-container>
      </template>
    </BasicLayout>

    <BasicLayout :isSection="true">
      <template v-slot:title> Нас легко найти </template>
      <template v-slot:descr> Мы находимся в самом центре Киева </template>
      <template v-slot:content> </template>
    </BasicLayout>
  </div>
</template>

<script>
import BannerComponent from "../components/VBanner";
import BasicLayout from "../layouts/VBasicLayout";
import CardComponent from "../components/VCard";
import { mapState } from 'vuex';

export default {
  name: "HomePage",
  components: {
    BannerComponent,
    BasicLayout,
    CardComponent,
  },
  computed:mapState({
      items:state=>state.products
  })
};
</script>