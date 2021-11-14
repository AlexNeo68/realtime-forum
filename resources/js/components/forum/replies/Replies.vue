<template>
  <div>
    <Reply
      :reply="reply"
      :key="reply.id"
      v-for="reply in replies"
    />
  </div>
</template>
<script>
import Reply from "./Reply.vue";
export default {
  name: "Replies",
  props: ["replies"],
  components: { Reply },
};
</script>
