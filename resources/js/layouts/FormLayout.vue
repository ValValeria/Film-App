<template>
  <div class="form w-100">
    <div class="first-slide wrap-md-pd center">
      <div class="wrap-md">
        <div class="form__area center">
          <div class="form__container w-100 center">
            <div class="form__wrap shadow p-4">
              <div class="p-4">
                <h2 class="form__title text-center">
                  <slot name="title"></slot>
                </h2>
                <div class="form__subtitle w-100">
                  <slot name="form__subtitle"></slot>
                </div>
                <div class="form__content w-100">
                  <div class="w-100 center">
                    <div class="form__items w-100">
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
  </div>
</template>

<script>
import BasicLayout from "../layouts/VBasicLayout";

export default {
  components: {
    BasicLayout,
  },
};
</script>

<style scoped>
.form__wrap {
  max-width: 600px;
  width: 100%;
  padding: 1.6rem;
}

.form {
  background: white;
}

.form__content {
  background-color: transparent;
}

.layout-content {
  box-shadow: 0 0 20px rgba(73, 77, 86, 0.127021) !important;
  border-radius: 25px !important;
}

.form__subtitle {
  margin: 10px 0;
  margin-top: 30px;
}

.form__container {
  padding: 2.5rem 0;
}

.form__title {
  margin-bottom: 1.54rem !important;
  margin: 0 0 25px;
  font-size: 36px;
  line-height: 42px;
  font-weight: 300;
}

.form__card {
  background-color: white;
}

@media screen and (max-width: 900px) {
}
</style>