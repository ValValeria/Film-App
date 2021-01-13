<template>
  <section
    :class="[
      'w-100 center',
      isFirstSlide ? 'first-slide' : '',
      isSection ? 'section' : '',
    ]"
  >
    <div :class="isSection ? 'wrap-md-pd center' : 'wrap-md center pt-2 pb-2'">
      <slot name="breadcrumps"></slot>
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
            <GridLayout>
                <template #content>
                   <slot name="content"></slot>
                </template>
            </GridLayout>
          </template>
          <template v-else-if="isTwoCols">
            <div class="container-fluid center flex-col-2">
              <slot name="content"></slot>
            </div>
          </template>
          <slot name="content" v-else></slot>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import GridLayout from './GridLayout';

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
    isTwoCols: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
  components:{
    GridLayout
  }
};
</script>

<style lang="scss" scoped>
.title {
  margin: 0 auto !important;
  text-transform: uppercase;
  font-size: 50px !important;
  line-height: 1.2;
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

.flex-col-2 > div:nth-child(1),
.flex-col-2 > div:nth-child(2) {
  margin: 10px;
}

@media screen and (min-width: 900px) {
  .flex-col-2 {
    flex-direction: column;
  }
}
</style>