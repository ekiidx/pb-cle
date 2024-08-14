<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  slug: String,
});
</script>

<template>
  <Link
    :href="route('posts.downVote', slug)"
    method="post"
    as="button"
    type="button"
    class="down-vote-arrow flex justify-center my-2"
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
        d="M19 14l-7 7m0 0l-7-7m7 7V3"
      />
    </svg>
  </Link>
</template>
