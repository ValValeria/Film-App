<template>
  <div class="w-100">
    <BannerComponent />
    <BasicLayout :isSection="true" :isGrid="true">
      <template v-slot:title> Наше меню </template>
      <template #descr> Самое вкусное, самое ароматное </template>
      <template v-slot:content>
        <template v-if="items.length">
          <CardComponent
            v-for="item in items"
            :key="item + Math.random()"
            :url="item.image"
            :title="item.title"
            :descr="item.long_description"
            :subtitle="item.short_description"
            :id="item.id"
            classes="card-ad all-width"
          />
        </template>
        <template v-else>
          <v-row>
            <div class="w-100 center">
              <v-progress-circular
                indeterminate
                color="amber"
              ></v-progress-circular>
            </div>
          </v-row>
        </template>
      </template>
    </BasicLayout>

    <PizzaHistoryComponent/>

    <BasicLayout :isSection="true" :isGrid="true">
      <template v-slot:title> Почему мы ? </template>
      <template v-slot:descr>
        Каждую неделю мы стараемся придумывать для вас что-то новое
      </template>
      <template v-slot:content>
        <v-card
          v-for="ad in ads"
          v-bind:key="ad + Math.random()"
          class="ad shadow p-2"
        >
          <v-card-text class="text-center ad__number">
            +{{ ad.num }}
          </v-card-text>
          <v-card-title>
            <h5 class="text-center headline-sm  pl-2 pr-2">
              {{ ad.title }}
            </h5>
          </v-card-title>
          <v-card-text class="text-center  pl-2 pr-2">
            {{ ad.l_descr }}
          </v-card-text>
        </v-card>
      </template>
    </BasicLayout>
    
    <div class="hot-ads bg-dark font-white">
      <BasicLayout :isSection="true">
        <template v-slot:title> Горячие предложения </template>
        <template v-slot:descr>
          Специальные предложения только для вас
        </template>
        <template v-slot:content>
          <Coursel :urls="urls"/>
        </template>
      </BasicLayout>
    </div>

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
import { mapState } from "vuex";
import Coursel from "../components/VCoursel";
import PizzaHistoryComponent from '../components/VPizzaHistory'


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
          num: 100,
          title: "Необыкновенное меню",
          l_descr: `Более 100 готовых блюд от нашего шеф-повара`,
        },
        {
          num: `8 лет`,
          title: "Нас любят наши клиенты",
          l_descr: `Мы работаем уже больше 8 лет и за это время мы показали себя с лучшей стороны`,
        },
      ],
      urls:[
        '/images/img1.png',
        '/images/img2.jpg'
      ]
    };
  },
  components: {
    BannerComponent,
    BasicLayout,
    CardComponent,
    Coursel,
    PizzaHistoryComponent
  },
  computed: mapState({
    items: (state) => state.products,
  }),
};
</script>


<style lang="scss">

.headline-sm{
  text-transform: uppercase;
  text-align: center !important;
  width: 100%;
  font-weight: 400;
  word-break: break-word;
  letter-spacing: 1px;
  font-size:1.325rem;
  word-break: break-word;
}

.ad__number {
  font-style: normal;
  font-weight: bold;
  font-size: 70px;
  line-height: 1.15;
  color: #f62028 !important;
  margin-right: 10px;
}

.ad {
  height: 100%;
  max-width: 400px;
}

.all-width {
  width: 100%;
  max-width: 100%;
}

.v-image__image--cover {
  background-size: contain;
}
.hot-ads{
  background-image: url(/images/bg.png);
  background-size: 300px;
  background-repeat: repeat;
  background-attachment: fixed;
}

</style>