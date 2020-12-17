<template>
  <v-parallax
    dark
    src="/images/pizza_banner.jpg"
  >
    <v-row align="center" justify="center">
      <v-col class="text-center" cols="12">
        <h1 class="display-1 font-weight-thin mb-4">
            Всё самое вкусное 
        </h1>
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
</style>