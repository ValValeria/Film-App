<template>
  <v-app>
    <v-system-bar 
     height="72px"
     class="center bg-dark"
     >
         <div class="wrap-md center flex-row">
            <h1 class="brand-name text-left">
              <router-link to="/">MyPizza</router-link>
            </h1>
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

    <v-footer app class="bg-dark">
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


<style lang="scss">
.brand-name a{
  color: white !important;
}
</style>