<template>
  <div>
    <v-row>
      <v-col cols="9">
        <question
          :question="question"
          v-for="question in questions"
          :key="`q-${question.id}`"
        />
      </v-col>
      <v-col cols="3">
        <QuestionCategories />
      </v-col>
    </v-row>
  </div>
</template>
<script>
import Question from "./Question.vue";
import QuestionCategories from "./QuestionCategories.vue";
export default {
  name: "Forum",
  components: { Question, QuestionCategories },
  async created() {
    try {
      const res = await axios.get("/api/questions");
      this.questions = res.data.data;
    } catch (error) {
      console.log(error.response);
    }
  },
  data() {
    return {
      questions: [],
    };
  },
};
</script>
