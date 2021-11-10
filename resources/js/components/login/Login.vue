<template>

  <form>
    <v-text-field
      v-model="form.email"
      autocomplete="true"
      label="E-mail"
      required
    ></v-text-field>
    <v-text-field
      v-model="form.password"
      label="Password"
      type="password"
      required
    ></v-text-field>

    <v-btn
      class="mr-4"
      @click="submit"
    >
      submit
    </v-btn>
  </form>
</template>
<script>
import axios from "axios";
export default {
  data: () => ({
    form: {
      name: "",
      password: "",
    },
  }),
  methods: {
    async submit() {
      User.login(this.form);
    },
  },
};
</script>
