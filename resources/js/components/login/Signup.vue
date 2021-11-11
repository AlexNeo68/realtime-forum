<template>

  <form>
    <v-text-field
      v-model="form.email"
      autocomplete="true"
      label="E-mail"
      :error="errors&&errors.email ? true : false"
      :error-messages="errors&&errors.email"
      required
    ></v-text-field>
    <v-text-field
      v-model="form.name"
      autocomplete="true"
      label="Name"
      required
      :error="errors&&errors.name ? true : false"
      :error-messages="errors&&errors.name"
    ></v-text-field>
    <v-text-field
      v-model="form.password"
      label="Password"
      type="password"
      :error="errors&&errors.password ? true : false"
      :error-messages="errors&&errors.password"
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
    errors: null,
  }),
  created() {
    if (User.loggedIn()) {
      this.$router.push({ name: "forum" });
    }
  },
  methods: {
    async submit() {
      this.errors = null;
      try {
        await User.signup(this.form);
      } catch (error) {
        this.errors = error.response.data.errors;
      }
    },
  },
};
</script>
