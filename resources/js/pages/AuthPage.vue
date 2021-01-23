<template>
  <div class="w-100">
    <v-snackbar v-model="showSnackBar">
      {{messageText}}

      <template v-slot:action="{ attrs }">
        <v-btn color="primary" text v-bind="attrs" @click="showSnackBar = false">
          Close
        </v-btn>
      </template>
    </v-snackbar>
    <FormLayout>
      <template #title>{{ isLogin ? "Вход" : "Регестрация" }}</template>
      <template #form>
        <div class="w-100">
          <v-card flat class="w-100 form__card p-4">
            <div class="w-100">
              <form class="w-100" @submit.prevent id="form" :v-model="isValid">
                <v-text-field
                  label="Имейл"
                  class="w-100"
                  type="email"
                  counter="30"
                  clearable
                  name="email"
                  :v-model="input.email"
                  :rules="[rules.email]"
                  required
                ></v-text-field>
                <v-text-field
                  label="Имя"
                  class="w-100"
                  type="text"
                  counter="30"
                  clearable
                  name="username"
                  :v-model="input.username"
                  :rules="[rules.username]"
                  required
                  v-if="!isLogin"
                ></v-text-field>
                <v-text-field
                  label="Пароль"
                  class="w-100"
                  type="password"
                  counter="15"
                  clearable
                  name="password"
                  :v-model="input.password"
                  :rules="[rules.password]"
                  required
                ></v-text-field>
                <v-checkbox
                  label="Я даю согласие на обработку персональных данных"
                  v-model="input.checkbox"
                  color="primary"
                  name="checkbox"
                  :rules="[rules.checkbox]"
                  required
                ></v-checkbox>
                <div class="w-100 pt-2 center">
                  <v-btn
                    class="mr-4 bg-red text-center"
                    dark
                    depressed
                    click
                    v-on:click="submit"
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

export default {
  data: function () {
    return {
      rules: {
        email(v = "") {
          const regexp = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          const isValid = v.length > 10 && v.length < 25 && regexp.test(v);
          return isValid || "Имейл должен быть больше 10 символов и меньше 25";
        },
        password(v = "") {
          return (
            (v.length > 5 && v.length < 15) ||
            "Пароль должен быть больше 5 символов и меньше 15"
          );
        },
        checkbox(v) {
          return v || "Вы должны согласиться с нашей политикой";
        },
        username(v=""){
          return (v.length > 10 && v.length < 25)||"Имя должно быть больше 10 символов и меньше 25";
        }
      },
      valid: false,
      input: {
        checkbox: true,
        email: "",
        password: "",
        username: ''
      },
      isValid: false,
      showSnackBar: false,
      messageText: ''
    };
  },
  beforeRouteEnter(to,from, next){
    next(vm=>{
      const isAuth = vm.$store.state.user.isAuth;

      if(isAuth){
          vm.$router.push({name:'home'})
      }
    })
  },
  components: {
    FormLayout,
  },
  computed: {
    isLogin() {
      return this.$route.matched.some((v) => v.meta.isLogin);
    }
  },
  methods: {
    async submit($event) {
      if (this.isValid) {
        const formdata = new FormData();

        Object.entries(this.input).forEach(([key,value])=>{
             formdata.append(key,value);
        });

        const response = await fetch(`/api/${this.isLogin?"login":"signup"}`,{
          method: 'POST',
          body: formdata
        });

        if(response.ok){
          const data = await response.json();

          if(data.status=="user"){
            this.$store.commit("authenticate",data.data);
            localStorage.setItem("data", JSON.stringify(data.data));
          } else{
            const errors = data.errors.join('. ');
            this.messageText = errors;
            this.showSnackBar = true;
          }
        }
      } else {
        this.showSnackBar = true;
        this.messageText = ' Проверьте правильность введенных данных'
      }
    },
  },
};
</script>

<style>
</style>