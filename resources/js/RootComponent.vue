<template>
  <v-app>
    <v-system-bar height="72px" class="center nav-not-media only-shadow">
      <div class="wrap-md center flex-row">
        <h1 class="brand-name text-left">
          <router-link to="/">MyPizza</router-link>
        </h1>
        <HeaderLinks v-on:log-out="logout()" />
      </div>
    </v-system-bar>

    <div class="navigation-media">
      <v-expansion-panels>
        <v-expansion-panel class="center">
          <v-expansion-panel-header
            expand-icon="list"
            class="navigation-media__main position-relative"
          >
            <h1 class="brand-name text-left" v-on:click.prevent.stop>
              <router-link to="/">MyPizza</router-link>
            </h1>
            <ProfileIconComponent class="navigation-media__avatar" />
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
              <div class="w-100 mb-1">
                <v-btn text class="w-100" v-if="isAuth" v-on:click="logout">
                  Выйти
                </v-btn>
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
      <TabsComponent v-on:click="navigate($event)" />
    </v-navigation-drawer>

    <v-main>
      <router-view></router-view>
    </v-main>

    <v-footer app class="footer-wh only-shadow w-100">
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
import ProfileIconComponent from './components/VProfileIcon'
import {LINKS} from './constants/route';
import {mapState} from 'vuex';
import Vue from 'vue';


export default {
  components:{
    HeaderComponent,
    BannerComponent,
    FooterComponent,
    HeaderLinks,
    TabsComponent,
    ProfileIconComponent
  },
  computed:mapState({
    isAuth:state=>state.user.isAuth,
    uncheckedOrders: state=>state.user.uncheckedOrders
  }),
  data:function(){
    return ({drawer: false,showMenu:true, links: [...LINKS],showAvatar:true});
  },
  beforeMount() {
    window.onresize = () => {
      if (window.matchMedia("(max-width: 1160px)").matches) {
          this.showAvatar = false;
      } else {
          this.showAvatar = true;
      }
    };
  },
  created(){
    window.onbeforeunload = ()=>{
      localStorage.setItem("uncheckedOrders",JSON.stringify(this.uncheckedOrders,null,3));
    }
  },
  async mounted(){
    try {
        if(!localStorage.getItem("data").length) return ;

        const response = await fetch(`/api/login`,{
          method: 'POST',
          headers:{
            "Auth":localStorage.getItem('data')
          }
        });

        if(response.ok){
          const data = await response.json();

          if(data.status=="user"){
            this.$store.commit("authenticate",data.data);

            if(localStorage.getItem('uncheckedOrders')){
              const uncheckedOrders = JSON.parse(localStorage.getItem("uncheckedOrders"));
              this.$store.commit("addUncheckOrders", uncheckedOrders);
            }
          }
        }
    } catch (error) {
      console.log('Invalid data '+ error.message )
    }   
  },
  methods:{
    logout(){
      this.$store.commit("logout");
    },
    navigate(name){
      if(!location.pathname=="/products"){
         this.$router.push("/products")
      }
    }
  },
};
</script>


<style lang="scss">
:root {
  --paddingLeft: 56px;
}
.brand-name a {
  font-weight: 400;
  color: rgba(0, 0, 0, 0.87) !important;
}
.wrap-md-pd {
  width: 90%;
  margin: 0 auto;
  padding: 7.5rem 0 !important;
}

.v-main {
  margin-left: var(--paddingLeft) !important;
  width: calc(100% - var(--paddingLeft));
}

.only-shadow {
  box-shadow: 0 0 20px rgba(73, 77, 86, 0.127) !important;
}

.v-application--wrap > .v-system-bar {
  padding-left: var(--paddingLeft) !important;
}

.nav-not-media,
.footer-wh {
  background-color: white !important;
}

nav {
  transform: translateX(0%);
  left: 0px;
  height: 100%;
  max-height: 100% !important;
}

.v-footer {
  width: calc(100% - var(--paddingLeft)) !important;
  margin-left: var(--paddingLeft);
}

.navigation-media,
.nav-not-media {
  margin-left: var(--paddingLeft);
  width: calc(100% - var(--paddingLeft)) !important;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1000;
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

.navigation-media__main .navigation-media__avatar {
  right: 4rem;
  top: 20px;
  max-width: 40px;
  position: absolute;
}

@media (max-width: 1160px) {
  .navigation-media {
    display: block;
  }
  .nav-not-media {
    display: none;
  }
  .first-slide {
    padding-top: 72px;
  }
}

@media (max-width: 1000px) {
  .wrap-md-pd {
    padding: 4.5rem 0 !important;
  }
}

@media (max-width: 580px) {
  .wrap-md-pd,
  .wrap-md {
    width: 80%;
  }
  #title {
    font-size: 60px;
  }
  .card-ad,
  .ad,
  .empty-card,
  .product__ad {
    max-width: 300px !important;
  }
}
</style>