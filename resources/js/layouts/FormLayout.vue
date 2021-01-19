<template>
  <div class="w-100 grey-background">
    <div class="first-slide wrap-md-pd center">
      <div class="wrap-md">
        <div class="contact__area">
          <div class="contact__card shadow p-4">
            <div class="p-4">
              <h2 class="contact__title text-center">
                  <slot name="title"></slot>
              </h2>
              <div class="contact__form">
                <div class="w-100 center">
                  <div class="form">
                    <slot name="form"></slot>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BasicLayout from "../layouts/VBasicLayout";

export default {
   components:{
       BasicLayout
   }
}
</script>

<style scoped>
.form__area {
  max-width: 750px;
  min-width: 100%;
}

.form {
  width: 100%;
  max-width: 750px;
  padding: 1.6rem;
  background: white;
  padding-top:0;
}

.form__content {
  background-color: transparent;
}

.layout-content {
  box-shadow: 0 0 20px rgba(73, 77, 86, 0.127021) !important;
  border-radius: 25px !important;
}

.contact__title {
  margin-bottom: 2.54rem !important;
  margin: 0 0 25px;
  font-size: 36px;
  line-height: 42px;
  font-weight: 300;
}

.contact__card{
  background-color: white;
}

@media screen and (max-width: 900px) {
  .form__area {
    flex-direction: column;
    align-items: center;
  }
}
</style>