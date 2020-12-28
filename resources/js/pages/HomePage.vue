<template>
  <div class="w-100">
      <BannerComponent/>
      <BasicLayout :isSection="true">
          <template v-slot:title>
              Наше меню
          </template>
          <template v-slot:content>
              <div v-for="item in $store.state.products" :key="item">

              </div>
          </template>
      </BasicLayout>

      <BasicLayout :isSection="true">
          <template v-slot:title>
              У нас большой выбор
          </template>
          <template v-slot:content>

          </template>
      </BasicLayout>
  </div>
</template>

<script>
import BannerComponent from '../components/VBanner'
import BasicLayout from '../layouts/VBasicLayout'

export default {
    name: 'HomePage',
    components:{
        BannerComponent,
        BasicLayout
    }
}
</script>