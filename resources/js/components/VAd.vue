<template>
  <div :class="'product__ad w-100  center' + ($attrs.class?$attrs.class:'')">
    <v-card :class="'product__ad-card shadow center d-flex' + ($attrs.classInner?$attrs.classInner:'')" outlined>
      <div v-if="image">
         <v-img :src="image" alt="..."></v-img>
      </div>
      <v-card-text class="center d-flex">
        <div class="product__ad-item center">
          <div class="product__ad-title">
            <span class="product__ad-title3">
                <slot name="title3">
                    Пицца
                </slot>
            </span>
            <span class="product__ad-title4">
                <slot name="title4">
                    из двух
                </slot>
            </span>
            <span class="product__ad-title5">
                <slot name="title5">
                    половинок
                </slot>
            </span>
          </div>
          <div class="product__ad-subtitle">
              <slot name="subtitle">
                  две пиццы в одной
              </slot>
          </div>
        </div>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
export default {
  name: "AdComponent",
  props:{
      image:{
          type: String
      }
  },
  inheritAttrs:false
};
</script>

<style scoped lang="scss">

.product__ad {
  max-width:fit-content;
  width:100%;
}

.product__ad-button a{
   display: block;
    height: 65px;
    padding: 0 10px;
    color: #fff;
    font-size: 18px;
    line-height: 63px;
    text-align: center;
    text-decoration: none;
    border: 1px solid #fff;
    border-radius: 33px;
    margin-bottom: 10px;
}

.product__ad-button a:hover{
   background-color: #fff;
   color: #623403;
}

.product__ad-card{
    background: #e98010;
    margin-top: 0;
    width:100%;
}

.product__tab-item{
  min-height:290px;
}

.product__ad-item{
      color: #623403;
    text-align: center;
    font-weight: 700;
    text-transform: uppercase;

    span{
      display:block;
      line-height: 1.3;
    }

    span:nth-child(1){
      font-size: 30px;
      line-height: 1.3;
    }

    span:nth-child(2), span:nth-child(3){
      font-size: 20px;
     line-height: 1.3;
    }

    .product__ad-subtitle{
      margin-bottom: 30px;
    margin: 0 0 41px;
    color: #fff;
    font-size: 24px;
    font-weight: 700;
    line-height: 1.3;
    text-transform: uppercase;
    }
}

</style>