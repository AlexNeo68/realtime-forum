<template>
  <div>
    <v-card v-if="question">
      <v-card-title>
        <div>
          <h1>{{question.title}}</h1>
          <div class="text--grey">{{question.author}} said {{question.created_at}}</div>
        </div>
        <v-spacer></v-spacer>
        <v-chip
          color="green"
          text-color="white"
        >Replies 5</v-chip>
      </v-card-title>
      <v-card-text v-html="question.body">
      </v-card-text>
      <v-card-actions v-if="own">
        <v-btn
          class="ma-2"
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
    </v-card>

  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "QuestionDetail",
  data() {
    return {
      question: null,
    };
  },
  async created() {
    try {
      const res = await axios.get(`/api/questions/${this.$route.params.slug}`);
      this.question = res.data.data;
    } catch (error) {
      console.log(error.response);
    }
  },
  computed: {
    own() {
      return User.own(this.question.user_id);
    },
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
