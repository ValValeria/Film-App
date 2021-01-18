<template>
  <v-app>
    <v-system-bar height="72px" class="center bg-dark">
      <div class="wrap-md center flex-row">
        <h1 class="brand-name text-left">
          <router-link to="/">MyPizza</router-link>
        </h1>
        <HeaderLinks />
      </div>
    </v-system-bar>

    <v-navigation-drawer
      class="only-shadow"
      app
      expand-on-hover
      permanent
      dense
      style="z-index:99999"
    >
      <TabsComponent />
    </v-navigation-drawer>

    <v-main>
      <router-view></router-view>
    </v-main>

    <v-footer app class="bg-dark">
      <FooterComponent />
    </v-footer>
  </v-app>
</template>

<script lang="js">
import HeaderComponent from './components/VMediaHeader';
import BannerComponent from './components/VBanner';
import FooterComponent from './components/VFooter';
import HeaderLinks from './components/VHeaderLinks';
import TabsComponent from './components/VTabs'

export default {
  components:{
    HeaderComponent,
    BannerComponent,
    FooterComponent,
    HeaderLinks,
    TabsComponent
  },
  data:function(){
    return ({drawer: false});
  }
};
</script>


<style lang="scss">
:root {
  --paddingLeft: 66px;
}
.brand-name a {
  color: white !important;
}
.wrap-md-pd {
  width: 90%;
  margin: 0 auto;
  padding: 7.5rem 0 !important;
}
.v-main {
  padding-left: var(--paddingLeft) !important;
}

.only-shadow {
  box-shadow: 0 0 20px rgba(73, 77, 86, 0.127);
}

.v-application--wrap > .v-system-bar {
  padding-left: var(--paddingLeft) !important;
}
</style>


<style lang="css" scoped>
nav {
  transform: translateX(0%);
  left: 0px;
  height: 100%;
  max-height: 100% !important;
}
.v-main {
  padding-left: 66px !important;
}
</style>