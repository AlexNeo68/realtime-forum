<template>
  <div>
    <Reply
      @reply-delete="()=>$emit('reply-delete')"
      @reply-edited="()=>$emit('reply-edited')"
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
