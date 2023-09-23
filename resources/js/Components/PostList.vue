<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
  community: Object,
  posts: Object,
});
</script>

<template>
  <div class="w-full bg-dark shadow-md border rounded-lg">
    <h2 class="font-semibold bg-darkorchid text-lg p-6 text-white rounded-lg">
      <slot name="title" />
    </h2>
    <ul role="list" class="divide-y divide-slate-300 dark:divide-slate-700 p-4">
      <li v-for="post in posts" :key="post.id" class="py-3 sm:py-4">
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