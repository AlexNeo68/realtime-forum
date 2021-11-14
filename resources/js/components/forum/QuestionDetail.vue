<template>
  <div>
    <v-card v-if="question">
      <QuestionEdit
        :question="question"
        v-if="editing"
        @question-cancel-edit="editing=false"
      />
      <QuestionInfo
        v-else
        :question="question"
        @question-edit="editing=true"
      />
    </v-card>

  </div>
</template>
<script>
import axios from "axios";
import QuestionInfo from "./QuestionInfo";
import QuestionEdit from "./QuestionEdit";
export default {
  name: "QuestionDetail",
  components: { QuestionInfo, QuestionEdit },
  data() {
    return {
      question: null,
      editing: false,
    };
  },
  async created() {
    this.listen();
    this.getQuestion();
  },

  methods: {
    listen() {},
    async getQuestion() {
      try {
        const res = await axios.get(
          `/api/questions/${this.$route.params.slug}`
        );
        this.question = res.data.data;
      } catch (error) {
        console.log(error.response);
      }
    },
  },
};
</script>
