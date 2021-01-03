<template>
 <v-parallax
    dark
    src="/images/pizza_banner.jpg"
    style="min-height:100vh;"
  >
    <v-row align="center" justify="center">
      <v-col class="text-center" cols="12">
        <h6 id="title">
            Всё самое вкусное 
        </h6>
        <p class="description">
           Пицца, салаты  и не только 
        </p>
        <v-btn depressed elevation="2" raised color="orange">Смотреть меню </v-btn>
      </v-col>
    </v-row>
  </v-parallax>
</template>

<script>
export default {
  name: "BannerComponent",
};
</script>


<style lang="scss">
.banner {
  min-height: 100vh;
  color: white;
  width: 100vw;
  background-image: url(/images/pizza_banner.jpg);
  backdrop-filter: blur(5px);
}

#title{
    margin: 0 auto !important;
    text-transform: uppercase;
    font-size: 70px !important;
    line-height: 80px;
    word-break: break-word;
    width: 90%;
    font-weight: 300;
    margin-bottom: 1.44rem !important;
}

.description{
    margin-bottom: 1.44rem !important;
    font-size: 20px;
    font-weight: 300;
}
</style>