<template>
  <div class="w-100">
    <BannerComponent />

    <BasicLayout :isSection="true" :isGrid="true" class="main-cards">
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
            <h5 class="text-center headline-sm pl-2 pr-2">
              {{ ad.title }}
            </h5>
          </v-card-title>
          <v-card-text class="text-center pl-2 pr-2">
            {{ ad.l_descr }}
          </v-card-text>
        </v-card>
      </template>
    </BasicLayout>

    <PizzaHistoryComponent />

    <div>
      <BasicLayout :isSection="true" :isGrid="true" class="section_white">
        <template #title> Доставка </template>
        <template #descr> у нас вы можете заказать </template>
        <template #content>
          <div class="empty-card-sm" v-for="del in delivery" :key="del.text">
            <div class="empty-card w-100">
              <div class="empty-card__img">
                <img :src="del.url" alt="..." srcset="" />
              </div>
              <div class="empty-card__body">
                <div class="empty-card__title">
                  {{ del.text }}
                </div>
              </div>
            </div>
          </div>
        </template>
      </BasicLayout>
    </div>

    <BasicLayout :isSection="true" :isGrid="true" class="main-cards">
      <template v-slot:title>Наши идеи</template>
      <template #descr> Интересные для вас предложения</template>
      <template v-slot:content>
        <AdComponent :image="'/images/banner-img2.png'" />
        <AdComponent :image="'/images/banner-img2.png'" />
        <AdComponent :image="'/images/banner-img2.png'" />
      </template>
    </BasicLayout>
  </div>
</template>

<script>
import BannerComponent from "../components/VBanner";
import BasicLayout from "../layouts/VBasicLayout";
import CardComponent from "../components/VCard";
import { mapState } from "vuex";
import Coursel from "../components/VCoursel";
import PizzaHistoryComponent from "../components/VPizzaHistory";
import ImagesComponent from "../components/VImages";
import AdComponent from "../components/VAd";

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
      urls: ["/images/img1.png", "/images/img2.jpg"],
      delivery: [
        {
          text: "Пицца",
          url: "/images/pizza_2.svg",
        },
        {
          text: "Десерты",
          url: "/images/cake_2.svg",
        },
        {
          text: "Суши и сеты",
          url: "/images/sushi_2.svg",
        },
        {
          text: "Салаты и закуски",
          url: "/images/salad_2.svg",
        },
      ],
    };
  },
  components: {
    BannerComponent,
    BasicLayout,
    CardComponent,
    Coursel,
    PizzaHistoryComponent,
    ImagesComponent,
    AdComponent,
  },
  computed: mapState({
    items: (state) => state.products,
  }),
  mounted(){
    this.$store.dispatch('getProducts')
  }
};
</script>


<style lang="scss">
.headline-sm {
  text-transform: uppercase;
  text-align: center !important;
  width: 100%;
  font-weight: 400;
  word-break: break-word;
  letter-spacing: 1px;
  font-size: 1.325rem;
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

.about-us__content {
  background-image: url(/images/about-top.jpg);
  background-size: cover;
  background-attachment: fixed;
  background-position: center;
  position: relative;
}

.about-us__text {
  position: relative;
  z-index: 2;
}

.about-us__content::after {
  content: "";
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #000;
  opacity: 0.5;
}

.ad {
  height: 100%;
  max-width: 400px;
}

.all-width {
  width: 100%;
  max-width: 100%;
}

.hot-ads {
  background-image: url(/images/bg.png);
  background-size: 300px;
  background-repeat: repeat;
  background-attachment: fixed;
}
</style>

<style lang="scss">
.v-main {
  padding: 0 !important;
}
</style>