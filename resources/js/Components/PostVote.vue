<script setup>
import { Link } from "@inertiajs/vue3";
import UpVoteLink from "./UpVoteLink.vue";
import DownVoteLink from "./DownVoteLink.vue";

defineProps({
  post: Object,
});
</script>

<template>
  <div
    class="vote-box flex flex-col h-full text-center rounded-l-lg"
  >
    <UpVoteLink
      :slug="post.slug"
      :class="{
        'text-electricgreen': post.postVotes[0] && post.postVotes[0].vote == 1,
      }"
    />
    <div
      class="font-bold"
      :class="{
        'text-electricgreen': post.postVotes[0] && post.postVotes[0].vote == 1,
        'text-darkorchid': post.postVotes[0] && post.postVotes[0].vote == -1,
      }"
    >
      {{ post.votes }}
    </div>
    <DownVoteLink
      :slug="post.slug"
      :class="{
        'text-darkorchid': post.postVotes[0] && post.postVotes[0].vote == -1,
      }"
    />
  </div>
</template>