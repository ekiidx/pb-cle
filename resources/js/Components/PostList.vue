<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  community: Object,
  posts: Object,
});
</script>

<template>
  <div class="popular-posts-box border rounded-lg bg-dark">
    <div class="bg-darkorchid rounded-lg p-3">
      <img class="d-inline" style="max-height: 1.3rem; max-width: 1.3rem; margin-right: 0.65rem; padding-bottom: 0.35rem" src="/assets/img/fire.svg">
      <h2 class="font-semibold text-white d-inline">
        <slot name="title" />
      </h2>
    </div>
    <ul role="list" class="p-3">
      <li 
        v-for="post in posts" 
        :key="post.id" 
        class="list-component-item"
      >
        <div class="py-3 sm:py-2 flex items-center space-x-4">
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
          <div><p class="text-sm">Votes({{ post.votes }})</p></div>
        </div>
        <div class="px-3 list-border"></div>
      </li>
    </ul>
  </div>
</template>