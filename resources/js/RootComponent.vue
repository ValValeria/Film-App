<template>
  <v-app>
    <v-navigation-drawer app>
       <HeaderComponent/>
    </v-navigation-drawer>
        
    <v-app-bar app>
    </v-app-bar>

    <v-main>
      <v-container fluid>
        <BannerComponent/>
      </v-container>
    </v-main>

    <v-footer app>
    </v-footer>
  </v-app>
</template>

<script>
import HeaderComponent from './components/VHeader'
import BannerComponent from './components/VBanner'

export default {
  components:{
    HeaderComponent,
    BannerComponent
  }
};
</script>
