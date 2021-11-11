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
      v-model="form.password"
      label="Password"
      type="password"
      :error="errors&&errors.password ? true : false"
      :error-messages="errors&&errors.password"
      required
    ></v-text-field>

    <v-btn
      class="mr-4"
      @click="submit"
    >
      submit
    </v-btn>
    <router-link to="/signup">SignUp</router-link>
  </form>
</template>
<script>
export default {
  data: () => ({
    errors: null,
    form: {
      name: "",
      password: "",
    },
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
        await User.login(this.form);
      } catch (error) {
        this.errors =
          error.response && error.response.data && error.response.data.errors;
      }
    },
  },
};
</script>
