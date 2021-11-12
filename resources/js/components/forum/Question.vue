<template>
  <v-card class="mb-5">
    <v-card-title>
      <h3>
        <router-link :to="question.path">{{question.title}}</router-link>

      </h3>
    </v-card-title>
    <v-card-subtitle v-html="question.body"></v-card-subtitle>
    <v-card-text>

      {{ question.created_at }}
    </v-card-text>

  </v-card>
</template>
<script>
export default {
  name: "Question",
  props: ["question"],
};
</script>
