<template>
  <v-card class="mx-auto">
    <v-toolbar
      color="cyan"
      dark
    >
      <v-toolbar-title>Categories</v-toolbar-title>

    </v-toolbar>

    <v-list>
      <template v-for="category in categories">

        <v-list-item :key="category.id">

          <v-list-item-title v-html="category.name"></v-list-item-title>

        </v-list-item>
      </template>
    </v-list>
  </v-card>
</template>
<script>
export default {
  name: "QuestionCategories",
  data() {
    return {
      categories: [],
    };
  },
  async created() {
    try {
      const res = await axios.get(`/api/categories`);
      this.categories = res.data;
    } catch (error) {
      console.log(error.response);
      this.errors =
        error.response && error.response.data && error.response.data.errors;
    }
  },
};
</script>
