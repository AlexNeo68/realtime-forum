<template>
  <div>

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
      @click="createReply"
    >
      Reply
    </v-btn>

  </div>
</template>
<script>
import axios from "axios";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  name: "CreateReply",
  props: ["question"],
  data() {
    return {
      errors: null,
      form: { body: "" },
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the rich-text editor.
      },
    };
  },
  methods: {
    async createReply() {
      this.errors = null;
      try {
        const res = await axios.post(
          `/api/questions/${this.question.slug}/replies`,
          this.form
        );
        this.form.body = "";
        this.$emit("reply-create", res.data);
        window.scrollTo(0, 0);
      } catch (error) {
        console.log(error);
        this.errors =
          error.response && error.response.data && error.response.data.errors;
      }
    },
  },
};
</script>
