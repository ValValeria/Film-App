<template>
  <FormLayout>
    <template #title> Обратная связь </template>
    <template #form>
      <div class="w-100">
        <v-card flat class="w-100 form__card p-4">
          <div class="w-100">
            <form class="w-100">
              <v-text-field
                v-model="name"
                :error-messages="nameErrors"
                :counter="10"
                label="Имя"
                required
                @input="$v.name.$touch()"
                @blur="$v.name.$touch()"
                prepend-inner-icon="assignment_turned_in"
              ></v-text-field>
              <v-text-field
                v-model="email"
                :error-messages="emailErrors"
                label="Имейл"
                required
                @input="$v.email.$touch()"
                @blur="$v.email.$touch()"
                prepend-inner-icon="alternate_email"
              ></v-text-field>
              <v-textarea
                name="input-7-4"
                label="Ваше сообщение"
                auto-grow
                clearable
                rows="11"
                clear-icon="mdi-close-circle"
                ref="textarea"
                color="grey darken-2"
                prepend-inner-icon="mdi-comment"
                v-model="message"
              ></v-textarea>
              <v-checkbox
                v-model="checkbox"
                :error-messages="checkboxErrors"
                label="Я даю согласие на обработку пресональных данных"
                required
                @change="$v.checkbox.$touch()"
                @blur="$v.checkbox.$touch()"
              ></v-checkbox>
              <div class="w-100 pt-2 center">
                <v-btn
                  class="mr-4 bg-red text-center"
                  dark
                  depressed
                  @click="submit"
                >
                  Отправить
                </v-btn>
              </div>
            </form>
          </div>
        </v-card>
      </div>
    </template>
  </FormLayout>
</template>

<script>
import FormLayout from "../layouts/FormLayout";
import { validationMixin } from "vuelidate";
import { required, maxLength, email } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],
  components: {
    FormLayout,
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
      message: "",
      snackBar: false,
    };
  },
  mounted() {
    this.$nextTick(() => {
      this.$refs.textarea.focus();
    });
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

      if (!this.message.length) {
        this.snackBar = true;
      }
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

