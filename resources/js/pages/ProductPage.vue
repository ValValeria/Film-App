<template>
  <div class="w-100 first-slide">
    <ProductLayout 
    :items="items"
    :product="product"
    :otherProducts="products"
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
  mounted(){
    this.$store.dispatch("getProducts");
  },
  computed: {
    id: function () {
      return this.$route.params.id;
    },
    product: function () {
      return this.$store.getters.getProduct(this.id) || {};
    },
    products:function(){
      return this.$store.state.products.filter(v=>v.id!=this.id).slice(0,3);
    }
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

</style>