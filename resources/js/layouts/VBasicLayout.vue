<template>
  <section
    :class="[
      'w-100 center',
      isFirstSlide ? 'first-slide' : '',
      isSection ? 'section' : '',
    ]"
  >
    <div :class="isSection ?'wrap-md-pd center' :'wrap-md center pt-2 pb-2'">
      <h2 class="title text-center">
        <slot name="title"></slot>
      </h2>
      <p class="description-sm">
        <slot name="descr"></slot>
        <v-divider></v-divider>
      </p>
      <div class="items w-100 center">
        <div class="wrap-md">
          <template v-if="isGrid">
            <div class="container-fluid grid">
              <slot name="content"></slot>
            </div>
          </template>
          <slot name="content" v-else></slot>
          <slot name="slider">
              
          </slot>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "BasicLayout",
  props: {
    isFirstSlide: {
      type: Boolean,
      required: false,
    },
    isSection: {
      type: Boolean,
      required: false,
    },
    isGrid: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
};
</script>

<style lang="scss" scoped>
.title {
    margin: 0 auto !important;
    text-transform: uppercase;
    font-size: 50px !important;
    line-height: 40px;
    word-break: break-word;
    width: 90%;
    font-weight: 300;
    margin-bottom: 1.54rem !important;
}

.description-sm {
  font-weight: 300;
  margin: 20px 0;
  text-align: center;
  font-size: 20px;
}

.items {
  padding-top: 1.5rem;
}


.grid {
  display: grid;
  grid-auto-rows: auto;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  align-items: center;
  justify-items: center;
  grid-gap: 24px;
}
</style>