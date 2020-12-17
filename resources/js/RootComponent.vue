<template>
  <v-app>
    <v-system-bar  height="72px" style="background-color:#231F20">
         <h1 class="text-center brand-name w-100">MyPizza</h1>
    </v-system-bar>

    <v-navigation-drawer
     app
     permanent
     expand-on-hover
     >
      <HeaderComponent/>
    </v-navigation-drawer>

    <v-main>
        <router-view></router-view>
    </v-main>

    <v-footer app style="background-color: rgb(35, 31, 32) !important;">
       <FooterComponent/>
    </v-footer>
  </v-app>
</template>

<script lang="js">
import HeaderComponent from './components/VHeader';
import BannerComponent from './components/VBanner';
import FooterComponent from './components/VFooter';


export default {
  components:{
    HeaderComponent,
    BannerComponent,
    FooterComponent
  },
  data:function(){
    return ({drawer: false});
  }
};
</script>
