<template>
  <v-app>
    <v-system-bar height="72px" class="center bg-dark nav-not-media">
      <div class="wrap-md center flex-row">
        <h1 class="brand-name text-left">
          <router-link to="/">MyPizza</router-link>
        </h1>
        <HeaderLinks />
      </div>
    </v-system-bar>

    <div class="navigation-media">
      <v-expansion-panels>
        <v-expansion-panel class="center">
          <v-expansion-panel-header expand-icon="list">
            <h1 class="brand-name text-left">
              <router-link to="/">MyPizza</router-link>
            </h1>
          </v-expansion-panel-header>
          <v-expansion-panel-content class="w-100">
            <div class="navigation-media__content">
              <div class="w-100 mb-1" v-for="obj in links" :key="obj.name">
                <router-link :to="obj.path" class="w-100">
                  <v-btn text class="w-100">
                    {{ obj.name }}
                  </v-btn>
                </router-link>
              </div>
            </div>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </div>

    <v-navigation-drawer
      class="only-shadow"
      app
      expand-on-hover
      permanent
      dense
      style="z-index: 99999"
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
import TabsComponent from './components/VTabs';
import {LINKS} from './constants/route'

export default {
  components:{
    HeaderComponent,
    BannerComponent,
    FooterComponent,
    HeaderLinks,
    TabsComponent
  },
  data:function(){
    return ({drawer: false,showMenu:true, links: [...LINKS]});
  },
};
</script>


<style lang="scss">
:root {
  --paddingLeft: 66px;
}
.brand-name a {
  color: white !important;
  font-weight:400;
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

nav {
  transform: translateX(0%);
  left: 0px;
  height: 100%;
  max-height: 100% !important;
}
.v-main {
  padding-left: 66px !important;
}

.navigation-media,
.nav-not-media {
  margin-left: 66px;
  width: calc(100% - 66px) !important;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 9;
}

.navigation-media {
  color: rgba(0, 0, 0, 0.87);
  display: none;

  .v-expansion-panel {
    border-radius: 0;
  }

  .brand-name a {
    color: rgba(0, 0, 0, 0.87) !important;
    text-align: center;
  }

  .brand-name {
    padding: 10px !important;
  }

  .v-expansion-panel,
  .v-expansion-panels {
    border-radius: 0 !important;
  }

}

@media (max-width: 1000px) {
  .navigation-media {
    display: block;
  }
  .nav-not-media {
    display: none;
  }
  .first-slide{
    padding-top:72px;
  }
}
</style>