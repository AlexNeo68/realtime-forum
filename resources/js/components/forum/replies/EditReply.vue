<template>
  <v-card-text>

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
      @click="editReply"
    >
      Edit
    </v-btn>
    <v-btn
      class="mr-4"
      @click="$emit('cancel-edit-reply')"
    >
      Cancel
    </v-btn>

  </v-card-text>
</template>
<script>
import axios from "axios";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  name: "EditReply",
  props: ["reply"],
  data() {
    return {
      errors: null,
      form: { body: this.reply.reply },
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the rich-text editor.
      },
    };
  },
  methods: {
    async editReply() {
      this.errors = null;
      try {
        const res = await axios.patch(
          `/api/questions/${this.$route.params.slug}/replies/${this.reply.id}`,
          this.form
        );
        this.$emit("reply-edited", res.data);
      } catch (error) {
        console.log(error);
        this.errors =
          error.response && error.response.data && error.response.data.errors;
      }
    },
  },
};
</script>
