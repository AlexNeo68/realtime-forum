<template>
  <div>
    <form>
      <v-text-field
        v-model="form.title"
        autocomplete="true"
        label="Title"
        :error="errors&&errors.title ? true : false"
        :error-messages="errors&&errors.title"
        required
      ></v-text-field>

      <v-select
        :items="categories"
        item-text="name"
        item-value="id"
        label="Category"
        v-model="form.category_id"
        :error="errors&&errors.category_id ? true : false"
        :error-messages="errors&&errors.category_id"
      ></v-select>
      <div class="mb-10 mt-6">
        <ckeditor
          :editor="editor"
          v-model="form.body"
          :config="editorConfig"
        ></ckeditor>
        <div
          v-if="errors&&errors.body"
          class="v-text-field__details mt-2"
        >
          <div
            class="v-messages theme--light error--text"
            role="alert"
          >
            <div class="v-messages__wrapper">
              <div class="v-messages__message">{{ errors.body[0] }}</div>
            </div>
          </div>
        </div>
      </div>

      <v-btn
        class="mr-4"
        @click="create"
      >
        Ask
      </v-btn>
    </form>
  </div>
</template>
<script>
import axios from "axios";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  name: "QuestionAsk",
  data() {
    return {
      errors: null,
      form: {
        title: "",
        category_id: null,
      },
      categories: [],
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the rich-text editor.
      },
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
  methods: {
    async create() {
      this.errors = null;
      try {
        const res = await axios.post(`/api/questions`, this.form);
        this.$router.push(res.data.path);
      } catch (error) {
        console.log(error);
        this.errors =
          error.response && error.response.data && error.response.data.errors;
      }
    },
  },
};
</script>
