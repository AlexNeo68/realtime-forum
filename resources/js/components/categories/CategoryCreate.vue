<template>
  <div>
    <form @submit.prevent="submit">
      <v-text-field
        v-model="form.name"
        autocomplete="true"
        label="Category Name"
        :error="errors&&errors.name ? true : false"
        :error-messages="errors&&errors.name"
      ></v-text-field>
      <v-btn
        v-if="editing"
        class="mt-4"
        type="submit"
        color="orange"
        dark
      >
        Update
      </v-btn>
      <v-btn
        v-else
        class="mt-4"
        type="submit"
      >
        Create
      </v-btn>
    </form>

    <v-card class="mt-6">
      <v-toolbar
        dense
        color="indigo"
        dark
      >
        <v-toolbar-title>Categories</v-toolbar-title>
      </v-toolbar>

      <v-list v-if="categories.length">
        <v-list-item
          v-for="category in categories"
          :key="`category-${category.id}`"
        >
          <v-list-item-icon>
            <v-btn @click.prevent="update(category)">
              <v-icon>mdi-pencil</v-icon>
            </v-btn>
          </v-list-item-icon>
          <v-list-item-title>{{category.name}}</v-list-item-title>
          <v-list-item-icon>
            <v-btn @click="destroy(category.slug)">
              <v-icon>mdi-delete</v-icon>
            </v-btn>
          </v-list-item-icon>
        </v-list-item>

      </v-list>

    </v-card>
  </div>

</template>
<script>
export default {
  name: "CategoryCreate",
  data() {
    return {
      errors: null,
      editing: null,
      form: {
        name: "",
      },
      categories: [],
    };
  },
  created() {
    this.getCateries();
    if (!User.isAdmin()) {
      this.$router.push({ name: "forum" });
    }
  },
  methods: {
    async submit() {
      this.errors = null;
      try {
        if (this.editing) {
          const res = await axios.patch(
            `/api/categories/${this.editing.slug}`,
            this.form
          );
        } else {
          const res = await axios.post(`/api/categories`, this.form);
        }
        this.editing = null;
        this.form.name = "";
        this.getCateries();
      } catch (error) {
        console.log(error);
        this.errors =
          error.response && error.response.data && error.response.data.errors;
      }
    },
    update(category) {
      this.form.name = category.name;
      this.editing = category;
      this.categories = this.categories.filter((c) => c.id !== category.id);
    },
    async getCateries() {
      try {
        const res = await axios.get(`/api/categories`);
        this.categories = res.data;
      } catch (error) {
        console.log(error.response);
        this.errors =
          error.response && error.response.data && error.response.data.errors;
      }
    },
    async destroy(slug) {
      try {
        const res = await axios.delete(`/api/categories/${slug}`);
        this.getCateries();
      } catch (error) {
        console.log(error.response);
        this.errors =
          error.response && error.response.data && error.response.data.errors;
      }
    },
  },
};
</script>
