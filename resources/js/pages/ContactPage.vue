<template>
  <div class="w-100">
    <v-snackbar :value="snackBar">
      {{ snackBar }}

      <template v-slot:action="{ attrs }">
        <v-btn color="error" text v-bind="attrs" @click="snackBar = ''">
          Close
        </v-btn>
      </template>
    </v-snackbar>
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
                  v-model="message"
                  :error-messages="messageErrors"
                  name="input-7-4"
                  label="Ваше сообщение"
                  auto-grow
                  clearable
                  @input="$v.message.$touch()"
                  @blur="$v.message.$touch()"
                  rows="11"
                  clear-icon="mdi-close-circle"
                  ref="textarea"
                  color="grey darken-2"
                  prepend-inner-icon="mdi-comment"
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
  </div>
</template>

<script>
import FormLayout from "../layouts/FormLayout";
import { validationMixin } from "vuelidate";
import { required, maxLength, email,minLength } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],
  components: {
    FormLayout,
  },
  validations: {
    name: { required, maxLength: maxLength(10) },
    email: { required, email },
    message: { required, maxLength:maxLength(200),minLength:minLength(10) },
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
      snackBar: "",
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
    messageErrors() {
      const errors = [];
      if (!this.$v.message.$dirty) return errors;

      if(this.message.length < 10){
        errors.push("Must be valid message");
      }

      if(this.message.length > 200){
        errors.push("Message must be less than 200 character");
      }
    },
  },
  methods: {
    async submit() {
      this.$v.$touch();

      if (
        this.message.length < 200 &&
        !this.emailErrors.length &&
        !this.nameErrors.length &&
        this.checkbox
      ) {
        const formdata = new FormData();
        formdata.append("message", this.message);
        formdata.append("email", this.email);
        formdata.append("username", this.name);

        const response = await fetch("/api/errors", {
          method: "POST",
          body: formdata,
        });

        if (response.ok) {
          this.snackBar = "Ваше сообщение отправлено.";

          setTimeout(()=>{
             this.$router.push("/")
          },1000);
        } else {
          this.snackBar = "Что-то плохое случилось попробуйте ещё раз";
        }
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

