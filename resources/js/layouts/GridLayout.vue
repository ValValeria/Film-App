<template>
  <div class="container-fluid grid">
    <slot name="content"></slot>
  </div>
</template>

<script>
export default {
  name: "GridLayout",
};
</script>

<style lang="scss" scoped>
.grid {
  display: grid;
  grid-auto-rows: auto;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  align-items: center;
  justify-items: center;
  grid-gap: 24px;
}
</style>