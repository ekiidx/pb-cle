<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  slug: String,
});
</script>

<template>
  <Link
    :href="route('posts.upVote', slug)"
    method="post"
    as="button"
    type="button"
    class="up-vote-arrow flex justify-center my-2"
    preserve-scroll
    ><svg
      xmlns="http://www.w3.org/2000/svg"
      class="h-5 w-5"
      fill="none"
      viewBox="0 0 24 24"
      stroke="currentColor"
      stroke-width="3"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M5 10l7-7m0 0l7 7m-7-7v18"
      />
    </svg>
  </Link>
</template>