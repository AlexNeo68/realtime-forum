<template>

  <form>
    <v-text-field
      v-model="form.email"
      autocomplete="true"
      label="E-mail"
      required
    ></v-text-field>
    <v-text-field
      v-model="form.name"
      autocomplete="true"
      label="Name"
      required
    ></v-text-field>
    <v-text-field
      v-model="form.password"
      label="Password"
      type="password"
      required
    ></v-text-field>
    <v-text-field
      v-model="form.password_confirmation"
      label="Password Confirm"
      type="password"
      required
    ></v-text-field>

    <v-btn
      class="mr-4"
      @click="submit"
    >
      submit
    </v-btn>
    <router-link to="/login">LogIn</router-link>
  </form>
</template>
<script>
export default {
  data: () => ({
    form: {
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    },
  }),
  methods: {
    async submit() {
      User.signup(this.form);
    },
  },
};
</script>
