<template>

  <form>
    <v-text-field
      v-model="form.email"
      label="E-mail"
      required
      @input="$v.email.$touch()"
      @blur="$v.email.$touch()"
    ></v-text-field>
    <v-text-field
      v-model="form.password"
      label="Password"
      type="password"
      required
      @input="$v.password.$touch()"
      @blur="$v.password.$touch()"
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
      try {
        const res = await axios.post("/api/auth/login", {
          email: this.form.email,
          password: this.form.password,
        });
        console.log(res.data);
      } catch (error) {
        console.log(error.response);
      }
    },
  },
};
</script>
