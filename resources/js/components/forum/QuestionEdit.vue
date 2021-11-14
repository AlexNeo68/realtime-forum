<template>
  <div v-if="question">
    <form>
      <v-card-text>
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
      </v-card-text>

      <v-card-actions>
        <v-btn
          class="ma-2"
          outlined
          @click="update"
          small
          fab
          color="teal"
        >
          <v-icon>mdi-content-save-check</v-icon>
        </v-btn>
        <v-btn
          @click="cancelEdit"
          class="ma-2"
          outlined
          small
          fab
          color="grey"
        >
          <v-icon>mdi-cancel</v-icon>
        </v-btn>
      </v-card-actions>
    </form>
  </div>
</template>
<script>
import axios from "axios";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  name: "QuestionDetail",
  props: ["question"],

  created() {
    this.getCategories();
    this.form = { ...this.question };
  },
  data() {
    return {
      errors: null,
      categories: [],
      form: {
        title: "",
        category_id: "",
        body: "",
      },
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the rich-text editor.
      },
    };
  },
  methods: {
    cancelEdit() {
      this.$emit("question-cancel-edit");
    },
    async update() {
      this.errors = null;
      try {
        const res = await axios.patch(
          `/api/questions/${this.question.slug}`,
          this.form
        );
        this.cancelEdit();
      } catch (error) {
        console.log(error);
        this.errors =
          error.response && error.response.data && error.response.data.errors;
      }
    },
    async getCategories() {
      try {
        const res = await axios.get(`/api/categories`);
        this.categories = res.data;
      } catch (error) {
        console.log(error.response);
        this.errors =
          error.response && error.response.data && error.response.data.errors;
      }
    },
  },
};
</script>
