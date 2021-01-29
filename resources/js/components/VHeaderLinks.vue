<template>
  <div>
    <v-list-item-group color="primary" class="center flex-row">
      <v-list-item v-for="link in links" :key="link.name + Math.random(0, 60)">
        <v-list-item-content>
          <v-list-item-title>
            <v-btn text>
              <router-link :to="link.path">{{ link.name }}</router-link>
            </v-btn>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <template v-if="isAuth">
        <v-list-item>
          <v-list-item-content>
            <v-btn text class="w-100" v-if="isAuth" v-on:click="logout">
              Выйти
            </v-btn>
          </v-list-item-content>
        </v-list-item>
        <v-list-item>
          <v-list-item-content>
            <ProfileIconComponent />
          </v-list-item-content>
        </v-list-item>
      </template>
    </v-list-item-group>
  </div>
</template>

<script>
import { mapState } from "vuex";
import { LINKS } from "../constants/route";
import ProfileIconComponent from "./VProfileIcon";

export default {
  name: "HeaderLinks",
  data: function () {
    return {
      links: [...LINKS],
    };
  },
  props: {
    isCol: {
      type: Boolean,
      default: false,
    },
  },
  computed: mapState({
    isAuth: (state) => state.user.isAuth,
  }),
  components: {
    ProfileIconComponent,
  },
  methods: {
    logout() {
      this.$emit("log-out");
    },
  },
};
</script>

<style scoped>
a {
  color: rgba(0, 0, 0, 0.87) !important;
}
</style>