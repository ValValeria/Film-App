<template>
  <div class="container-fluid grid"
  :style="`grid-template-columns: repeat(auto-fit, minmax(250px, ${maxWidth}));`">
    <slot name="content"></slot>
  </div>
</template>

<script>
export default {
  name: "GridLayout",
  props:{
    maxWidth:{
      type:String,
      default:"1fr"
    }
  }
};
</script>

<style lang="scss" scoped>
.grid {
  display: grid;
  grid-auto-rows: auto;
  align-items: center;
  justify-items: center;
  grid-gap: 24px;
}
</style>