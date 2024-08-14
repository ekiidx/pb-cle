<script setup>
import CommentUpVoteLink from "./CommentUpVoteLink.vue";
import CommentDownVoteLink from "./CommentDownVoteLink.vue";

defineProps({
  comment: Object
});
</script>

<template>
  <div
    class="flex align-items-center"
  >
    <CommentUpVoteLink
      :id="comment.id"
      :class="{
        'text-electricgreen': comment.comment_votes[0] && comment.comment_votes[0].vote ==1,
      }"
    />
    <div
      class="font-bold"
      style="margin-left: 0.5rem; margin-right: 0.5rem;"
      :class="{
        'text-electricgreen': comment.comment_votes[0] && comment.comment_votes[0].vote == 1,
        'text-darkorchid': comment.comment_votes[0] && comment.comment_votes[0].vote == -1,
      }"
    >
      {{ comment.votes }}
    </div>
    <CommentDownVoteLink
      :id="comment.id"
      :class="{
       'text-darkorchid': comment.comment_votes[0] && comment.comment_votes[0].vote == -1,
      }"
    />
  </div>
</template>