<template>
  <v-app>
       <HeaderComponent/>
  </v-app>
</template>

<script lang="js">
import HeaderComponent from './components/VHeader';
import BannerComponent from './components/VBanner';

export default {
  components:{
    HeaderComponent,
    BannerComponent
  },
  data:function(){
    return ({drawer: false});
  }
};
</script>
