<template>
  <v-app>
    <v-system-bar 
     height="72px"
     style="background-color:#231F20"
     class="center"
     >
         <div class="wrap-md center flex-row">
            <h1 class="brand-name text-left">MyPizza</h1>
            <HeaderLinks/> 
         </div>
    </v-system-bar>

    <v-navigation-drawer
     app
     permanent
     expand-on-hover
     v-if="false"
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
import HeaderLinks from './components/VHeaderLinks';

export default {
  components:{
    HeaderComponent,
    BannerComponent,
    FooterComponent,
    HeaderLinks
  },
  data:function(){
    return ({drawer: false});
  }
};
</script>

