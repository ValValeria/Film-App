<template>
  <v-row>
    <v-col v-for="url in urls" :key="url" class="d-flex child-flex" cols="4">
      <v-dialog :v-model="diaglog" width="75vw">
        <template v-slot:activator="{ on, attrs }">
          <v-img
            :src="url"
            :lazy-src="url"
            aspect-ratio="1"
            class="shadow bg-white"
            v-on:click.prevent="
              diaglog = true;
              active = url;
            "
            v-bind="attrs"
            v-on="on"
            contain
          >
            <template v-slot:placeholder>
              <v-row class="fill-height ma-0" align="center" justify="center">
                <v-progress-circular
                  indeterminate
                  color="grey lighten-5"
                ></v-progress-circular>
              </v-row>
            </template>
          </v-img>
        </template>
        <div class="center">
          <v-img :src="active" height="60vh" width="70vw"></v-img>
        </div>
      </v-dialog>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: "ImagesComponent",
  data: function () {
    return { diaglog: false, active: this.urls[0] | "" };
  },
  props: {
    urls: Array,
  },
};
</script>

