<template>
  <div class="w-100 first-slide">
    <ProductLayout 
    :items="items"
    :product="product"
    :otherProducts="otherProducts"
    >
    </ProductLayout>
  </div>
</template>

<script>
import ProductLayout from "../layouts/VPageLayout.vue";
import AdComponent from "../components/VAd";
import { mapState } from "vuex";


export default {
  name: "ProductPage",
  data: function () {
    return {
      items: [
        {
          text: "Главная",
          disabled: false,
          href: "/",
        },
        {
          text: "Меню",
          disabled: false,
          href: "/products",
        },
        {
          text: "Пицца",
          disabled: true,
          href: "./",
        },
      ],
    };
  },
  computed: {
    id: function () {
      return this.$route.params.id;
    },
    product: function () {
      return this.$store.getters.getProduct(this.id) || {};
    },
  },
  components: {
    ProductLayout,
    AdComponent,
  },
};
</script>

<style scoped>
.product__ad {
  margin-top: 1.7rem;
  flex: 1 1 33%;
  width: 33% !important;
}

.product__inner-section h5 {
  font-size: 36px;
  line-height: 42px;
  font-weight: 300;
  margin: 1.2rem;
}

.product__inner-section{
  padding: 2.5rem 1.6rem;
}

.product__ads-bg{
  
}
</style>