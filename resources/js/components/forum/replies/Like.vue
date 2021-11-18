<template>
  <div>
    <v-btn
      icon
      @click="likeIt"
    >
      <v-icon :color="color">mdi-heart</v-icon>
      {{ count }}
    </v-btn>

  </div>
</template>

<script>
export default {
  name: "Like",
  props: ["reply"],
  data() {
    return {
      count: this.reply.likes_count,
      liked: this.reply.liked,
    };
  },
  computed: {
    color() {
      return this.liked ? "cyan" : "cyan lighten-4";
    },
  },
  created() {
    Echo.channel("LikeChannel").listen("LikeEvent", (e) => {
      if (e.id == this.reply.id) {
        return e.type == 1 ? this.count++ : this.count--;
      }
    });
  },
  methods: {
    async likeIt() {
      if (User.loggedIn()) {
        try {
          if (this.liked) {
            const res = await axios.delete(`/api/likes/${this.reply.id}`);
            this.decr();
          } else {
            const res = await axios.post(`/api/likes/${this.reply.id}`);
            this.incr();
          }
          this.liked = !this.liked;
        } catch (error) {
          console.log(error);
          this.errors =
            error.response && error.response.data && error.response.data.errors;
        }
      }
    },
    decr() {
      this.count--;
    },
    incr() {
      this.count++;
    },
  },
};
</script>
