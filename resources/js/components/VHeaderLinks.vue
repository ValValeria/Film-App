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
    </v-list-item-group>
  </div>
</template>

<script>
import {LINKS} from '../constants/route';

export default {
  name: "HeaderLinks",
  data: function () {
    return {
      links: [...LINKS]
    };
  },
  props:{
    isCol:{
      type:Boolean,
      default: false
    }
  }
};
</script>

<style scoped>
a {
  color: rgba(0,0,0,.87) !important;
}
</style>