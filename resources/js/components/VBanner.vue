<template>
  <section class="section center first-slide position-relative">
    <div class="banner">
      <div class="banner__items center flex-row">
          <div class="banner__item"></div>
          <div class="banner__item hot-ads bg-dark"></div>
      </div>
    </div>
    <div class="section__content center w-100 position-relative">
      <div class="wrap-md-pd font-white center">
        <h6 id="title" class="text-center">Всё самое вкусное</h6>
        <p class="description">Пицца, салаты и не только</p>
        <v-btn depressed elevation="2" raised color="orange">Смотреть меню</v-btn>
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
.banner{
  position: absolute;
  top:0;
  left:0;
  width:100%;
  height:100%;
}

.section{
  min-height:100vh;
}

.banner .banner__item{
  height: 100%;
  width: 50%;
  flex: 1 1 50%;
}

.banner__items{
  width:100%;
  height:100%;
}

.banner .banner__item:nth-child(1){
  background-image: url(/images/pizza_banner.jpg);
  backdrop-filter: blur(5px);
  background-size: cover;
  background-position: center;
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

</style>