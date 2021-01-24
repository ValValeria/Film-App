<template>
    <v-row
      justify="center"
      no-gutters
    >
      <v-col
        class=" py-4 text-center"
        cols="12"
      >
        {{ new Date().getFullYear() }} — <strong>MY</strong>Pizza
      </v-col>
    </v-row>
</template>

<script>
export default {
    name: 'FooterComponent',
}
</script>