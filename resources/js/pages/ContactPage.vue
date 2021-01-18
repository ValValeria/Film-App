<template>
  <BasicLayout :isSection="true" class="main-cards">
    <template v-slot:title>Обратная связь</template>
    <template #descr>Свяжитесь с нами в любое удобное для вся время</template>
    <template v-slot:content>
      <div class="w-100 center">
        <div class="form__area">
          <v-card flat class="shadow w-100">
            <v-card-text class="p-4 w-100">
              <form class="w-100">
                <v-text-field
                  v-model="name"
                  :error-messages="nameErrors"
                  :counter="10"
                  label="Имя"
                  required
                  @input="$v.name.$touch()"
                  @blur="$v.name.$touch()"
                ></v-text-field>
                <v-text-field
                  v-model="email"
                  :error-messages="emailErrors"
                  label="Имейл"
                  required
                  @input="$v.email.$touch()"
                  @blur="$v.email.$touch()"
                ></v-text-field>

                <v-checkbox
                  v-model="checkbox"
                  :error-messages="checkboxErrors"
                  label="Я даю согласие на обработку пресональных данных"
                  required
                  @change="$v.checkbox.$touch()"
                  @blur="$v.checkbox.$touch()"
                ></v-checkbox>

                <v-btn class="mr-4" color="error" block flat @click="submit">
                  Отправить
                </v-btn>
              </form>
            </v-card-text>
          </v-card>
        </div>
      </div>
    </template>
  </BasicLayout>
</template>

<script>
import BasicLayout from "../layouts/VBasicLayout";
import { validationMixin } from "vuelidate";
import { required, maxLength, email } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],
  components: {
    BasicLayout,
  },
  validations: {
    name: { required, maxLength: maxLength(10) },
    email: { required, email },
    checkbox: {
      checked(val) {
        return val;
      },
    },
  },
  data: function () {
    return {
      name: "",
      email: "",
      checkbox: false,
    };
  },
  computed: {
    checkboxErrors() {
      const errors = [];
      if (!this.$v.checkbox.$dirty) return errors;
      !this.$v.checkbox.checked && errors.push("You must agree to continue!");
      return errors;
    },
    selectErrors() {
      const errors = [];
      if (!this.$v.select.$dirty) return errors;
      !this.$v.select.required && errors.push("Item is required");
      return errors;
    },
    nameErrors() {
      const errors = [];
      if (!this.$v.name.$dirty) return errors;
      !this.$v.name.maxLength &&
        errors.push("Name must be at most 10 characters long");
      !this.$v.name.required && errors.push("Name is required.");
      return errors;
    },
    emailErrors() {
      const errors = [];
      if (!this.$v.email.$dirty) return errors;
      !this.$v.email.email && errors.push("Must be valid e-mail");
      !this.$v.email.required && errors.push("E-mail is required");
      return errors;
    },
  },
  methods: {
    submit() {
      this.$v.$touch();
    },
    clear() {
      this.$v.$reset();
      this.name = "";
      this.email = "";
      this.select = null;
      this.checkbox = false;
    },
  },
};
</script>

<style scoped>
.form__area {
  max-width: 600px;
  width:100%;
}
</style>