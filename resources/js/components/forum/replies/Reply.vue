<template>
  <v-card class="mt-4">
    <v-card-title>{{reply.author}} said {{  reply.created_at }}</v-card-title>
    <v-card-text v-html="reply.reply"></v-card-text>
    <v-card-actions v-if="own">
      <v-btn
        icon
        color="orange"
      >
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
      <v-btn
        icon
        color="red"
      >
        <v-icon>mdi-delete</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>
<script>
export default {
  name: "Reply",
  props: ["reply"],
  computed: {
    own() {
      return User.own(this.reply.user_id);
    },
  },
};
</script>
