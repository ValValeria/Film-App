<template>
  <div class="container-fluid center">
    <BasicLayout :isSection="true">
      <template v-slot:title> 404 </template>
      <template #descr>Извините, но данной страницы не существует</template>
      <template v-slot:content>
        <div class="center flex-column w-100">
          <div class="img-container-gr center">
            <img src="/images/not-found.svg" alt="" style="min-width:200px;"/>
          </div>
        </div>
      </template>
    </BasicLayout>
  </div>
</template>

<script>
import BasicLayout from "../layouts/VBasicLayout";

export default {
  name: "NotFoundPage",
  components: {
    BasicLayout,
  },
};
</script>