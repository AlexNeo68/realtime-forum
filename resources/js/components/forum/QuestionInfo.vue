<template>
  <div v-if="question">

    <v-card-title>
      <div>
        <h1>{{question.title}}</h1>
        <div class="text--grey">{{question.author}} said {{question.created_at}}</div>
      </div>
      <v-spacer></v-spacer>
      <v-chip
        color="green"
        text-color="white"
      >Replies {{question.replies_count}}</v-chip>
    </v-card-title>
    <v-card-text v-html="question.body">
    </v-card-text>
    <v-card-actions v-if="own">
      <v-btn
        class="ma-2"
        @click="$emit('question-edit')"
        outlined
        small
        fab
        color="indigo"
      >
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
      <v-btn
        @click="destroy"
        class="ma-2"
        outlined
        small
        fab
        color="red"
      >
        <v-icon>mdi-delete</v-icon>
      </v-btn>
    </v-card-actions>
    <v-card-text>
      <Replies
        class="mt-6"
        :replies="replies"
        @reply-delete="()=>$emit('reply-delete')"
        @reply-edited="()=>$emit('reply-edited')"
      />
      <CreateReply
        :question="question"
        @reply-create="(reply) => $emit('reply-create', reply)"
      />
    </v-card-text>

  </div>
</template>
<script>
import CreateReply from "./replies/CreateReply.vue";
import Replies from "./replies/Replies.vue";
export default {
  name: "QuestionDetail",
  components: { Replies, CreateReply },
  props: ["question"],
  data() {
    return {
      replies: this.question.replies,
    };
  },
  computed: {
    own() {
      return User.own(this.question.user_id);
    },
  },
  created() {
    Echo.private("App.Models.User." + User.id()).notification(
      (notification) => {
        if (
          notification.type == "App\\Notifications\\DeleteReplyNotification"
        ) {
          this.replies = this.replies.filter(
            (reply) => reply.id !== notification.reply.id
          );
        } else {
          this.replies.unshift(notification.reply);
        }
      }
    );
  },
  methods: {
    async destroy() {
      try {
        const res = await axios.delete(
          `/api/questions/${this.$route.params.slug}`
        );
        this.$router.push({ name: "forum" });
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>
