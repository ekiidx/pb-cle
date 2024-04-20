<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  community: Object,
  posts: Object,
});
</script>

<template>
  <div class="border rounded-lg popular-posts-box mb-3 bg-dark">
    <div class="bg-darkorchid rounded-lg p-3">
      <img class="d-inline" style="max-height: 1.45rem; max-width: 1.45rem; margin-right: 0.65rem; padding-bottom: 0.35rem" src="/assets/img/fire.svg">
      <h2 class="font-semibold text-lg text-white d-inline">
        <slot name="title" />
      </h2>
    </div>
    <ul role="list" class="divide-y divide-slate-300 dark:divide-slate-700 p-4">
      <li 
        v-for="post in posts" 
        :key="post.id" 
        class="py-3 sm:py-4"
      >
        <div class="flex items-center space-x-4">
          <Link
            :href="
              route('frontend.communities.posts.show', [
                community.slug,
                post.slug,
              ])
            "
            class="
              text-slate-800
              dark:text-slate-400
              font-semibold
              truncate
              text-sm
              hover:text-indigo-700
            "
          >
            {{ post.title }}
          </Link>
          <div>Votes({{ post.votes }})</div>
        </div>
      </li>
    </ul>
  </div>
</template>