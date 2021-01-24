<template>
    <div class="">
      <BasicLayout :isSection="true" :isGrid="true">
        <template v-slot:title> Секрет нашей пиццы</template>
        <template v-slot:descr>
          Почему наша пицца такая вкусная?
        </template>
        <template v-slot:content>
            <div class="empty-card center  shadow w-100 bg-white  p-4">
                 <div class="img-card-container">
                     <img src="/images/fr.png" alt="">
                 </div>
                 <h4 class="headline-sm">
                     Только свежие продукты
                </h4> 
            </div>
            <div class="empty-card center shadow w-100 bg-white p-4">
                 <div class="img-card-container">
                     <img src="/images/t2.jpg" alt="">
                 </div>
                 <h4 class="headline-sm">
                     Всегда делаем с любовью
                </h4> 
            </div>
            <div class="empty-card center shadow w-100 bg-white p-4">
                 <div class="img-card-container">
                     <img src="/images/rt3.png" alt="">
                 </div>
                 <h4 class="headline-sm">
                    Проффесиональные шеф-повара
                </h4> 
            </div>
        </template>
      </BasicLayout>
    </div>

</template>

<script>
import BasicLayout from '../layouts/VBasicLayout'

export default {
    name: 'PizzaHistoryComponent',
    components:{
        BasicLayout
    }
}
</script>

<style scoped lang="scss">
.img-card-container{
     width: 100%;
    height: auto;
    padding-bottom: 2rem;
    max-width: 270px;

    img{
        object-fit: contain;
        width:100%;
        height:100%;
    }
}

.empty-card{
    padding:1rem;
}
</style>