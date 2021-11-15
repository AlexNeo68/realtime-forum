<template>
  <v-card class="mt-4">
    <v-card-title>{{reply.author}} said {{  reply.created_at }}</v-card-title>
    <EditReply
      v-if="editing"
      :reply="reply"
      @cancel-edit-reply="editing = false"
      @reply-edited="editReply"
    />
    <div v-else>
      <v-card-text v-html="reply.reply"></v-card-text>
      <v-card-actions v-if="own">
        <v-btn
          icon
          color="orange"
          @click="editing = true;"
        >
          <v-icon>mdi-pencil</v-icon>
        </v-btn>
        <v-btn
          icon
          color="red"
          @click="destroy"
        >
          <v-icon>mdi-delete</v-icon>
        </v-btn>
      </v-card-actions>
    </div>

  </v-card>
</template>
<script>
import EditReply from "./EditReply.vue";
export default {
  components: { EditReply },
  name: "Reply",
  props: ["reply"],
  data() {
    return {
      editing: false,
    };
  },
  computed: {
    own() {
      return User.own(this.reply.user_id);
    },
  },
  methods: {
    editReply() {
      this.$emit("reply-edited");
      this.editing = false;
    },
    async destroy() {
      try {
        const res = await axios.delete(
          `/api/questions/${this.$route.params.slug}/replies/${this.reply.id}`
        );
        this.$emit("reply-delete");
      } catch (error) {
        console.log(error.response);
      }
    },
  },
};
</script>
