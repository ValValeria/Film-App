<template>
  <div class="w-100">
    <BannerComponent />
    <BasicLayout :isSection="true" :isGrid="true">
      <template v-slot:title> Наше меню </template>
      <template #descr> Самое вкусное, самое ароматное </template>
      <template v-slot:content>
        <CardComponent
          v-for="item in items"
          :key="item + Math.random()"
          :url="item.image"
          :title="item.title"
          :descr="item.long_description"
          :subtitle="item.short_description"
          :id="item.id"
          classes="card-ad"
        />
        <v-row v-if="!items.length">
          <div class="w-100 center">
            <v-progress-circular
              indeterminate
              color="amber"
            ></v-progress-circular>
          </div>
        </v-row>
      </template>
    </BasicLayout>

    <BasicLayout :isSection="true" :isGrid="true">
      <template v-slot:title> У нас большой выбор </template>
      <template v-slot:descr>
        Каждую неделю мы стараемся придумывать для вас что-то новое
      </template>
      <template v-slot:content>
        <v-card v-for="ad in ads" v-bind:key="ad + Math.random()" class="ad">
          <v-card-text class="text-center ad__number">
            +{{ad.num}}
          </v-card-text>
          <v-card-title >
            <h5 class="text-center uppercase">
              {{ ad.title }}
            </h5>
          </v-card-title>
          <v-card-text class="text-center">
            {{ ad.l_descr }}
          </v-card-text>
        </v-card>
      </template>
    </BasicLayout>

    <BasicLayout :isSection="true">
      <template v-slot:title> Горячие предложения </template>
      <template v-slot:descr> Специальные предложения только для вас </template>
      <template v-slot:content> 
        <Coursel/>
      </template>
    </BasicLayout>

    <BasicLayout :isSection="true">
      <template v-slot:title> Нас легко найти </template>
      <template v-slot:descr> Мы находимся в самом центре Киева </template>
      <template v-slot:content> 

      </template>
    </BasicLayout>
  </div>
</template>

<script>
import BannerComponent from "../components/VBanner";
import BasicLayout from "../layouts/VBasicLayout";
import CardComponent from "../components/VCard";
import { mapState } from "vuex";
import Coursel from '../components/VCoursel'

export default {
  name: "HomePage",
  data: function () {
    return {
      ads: [
        {
          num: 1100,
          title: "Качественная доставка",
          l_descr: `Больше 1100 заказов через доставку было выполнено`,
        },
        {
          num:100,
          title: "Необыкновенное меню",
          l_descr: `Более 100 готовых блюд от нашего шеф-повара`,
        },
        {
          num: `8 лет`,
          title: "Нас любят наши клиенты",
          l_descr: `Мы работаем уже больше 8 лет и за это время мы показали себя с лучшей стороны`,
        },
      ],
    };
  },
  components: {
    BannerComponent,
    BasicLayout,
    CardComponent,
    Coursel
  },
  computed: mapState({
    items: (state) => state.products,
  }),
};
</script>


<style lang="scss">
.uppercase{
    text-transform: uppercase;
    text-align: center !important;
    width: 100%;
    font-weight: 400;
    word-break: break-word;
}
.ad__number{
    font-size: 2.6rem;
    line-height: 1;
    color: #231F20;
    font-weight: 300;
    padding-top: 2rem;
    padding-bottom: 1rem;
}

.ad{
  height:100%;
  max-width:400px;
}
</style>