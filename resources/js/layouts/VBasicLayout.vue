<template>
    <section :class="['w-100 center',isFirstSlide?'first-slide':'',isSection?'section':'']">
         <div class="wrap-md-pd center">
             <h2 class="title text-center">
                 <slot name="title"></slot>
             </h2>
             <div class="items">
                <slot name="content"></slot>
             </div>
         </div>
    </section>
</template>

<script>
export default {
    name: 'BasicLayout',
    props:{
        isFirstSlide:{
            type: Boolean,
            required: false
        },
        isSection:{
            type: Boolean,
            required: false
        }
    }
}
</script>

<style lang="scss" scoped>
   .title{
    margin: 0 auto !important;
    text-transform: uppercase;
    font-size: 35px !important;
    line-height: 80px;
    word-break: break-word;
    width: 90%;
    font-weight: 300;
    margin-bottom: 1.44rem !important;
   }
</style>