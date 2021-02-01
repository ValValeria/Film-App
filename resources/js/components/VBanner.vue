<template>
  <section class="section center first-slide position-relative">
    <div class="banner">
      <div class="banner__items center flex-row">
        <div class="banner__item hot-ads"></div>
      </div>
    </div>
    <div class="section__content center w-100 position-relative">
      <div class="wrap-md-pd  center">
        <h6 id="title" class="text-center">Всё самое вкусное</h6>
        <p class="h5 text-center" style="font-weight:400">Пицца, салаты и не только</p>
        <v-btn depressed x-large elevation="2"  raised class="bg-red text-white mt-3"
          >Смотреть меню</v-btn>
      </div>
    </div>
  </section>
</template>


<script>
export default {
  name: "BannerComponent",
};
</script>


<style lang="scss" scoped>
.banner {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.section {
  min-height: 100vh;
}

.banner__items {
  width: 100%;
  height: 100%;
}

.banner .banner__item:nth-child(1) {
  height: 100%;
  width: 100%;
  flex: 1 1 100%;
}

#title {
  margin: 0 auto !important;
  text-transform: uppercase;
  font-size: 70px !important;
  line-height: 80px;
  word-break: break-word;
  width: 90%;
  font-weight: 300;
  margin-bottom: 1.44rem !important;
}

.description {
  margin-bottom: 1.44rem !important;
  font-size: 20px;
  font-weight: 300;
}


@media(max-width:580px){
 #title{
   font-size:60px  !important;
 }
}
</style>