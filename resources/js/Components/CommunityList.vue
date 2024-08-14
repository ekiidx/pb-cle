<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  communities: Object,
});
</script>

<template>
  <div class="top-communities-box border bg-dark rounded-lg">
    <div class="bg-darkorchid rounded-lg p-3">
      <img class="d-inline" style="max-height: 1.2rem; max-width: 1.4rem; margin-right: 0.65rem; padding-bottom: 0.23rem" src="/assets/img/top.svg">
      <h2 class="font-semibold text-white d-inline">
        <slot name="title" />
      </h2>
    </div>
    <ul role="list" class="divide-y divide-slate-300 dark:divide-slate-700 p-3">
      <li
        v-for="community in communities"
        :key="community.id"
        class="py-3"
      >
        <div class="flex items-center space-x-4">
          <Link
            :href="route('frontend.communities.show', community.slug)"
            class="
              text-slate-800
              font-semibold
              truncate
              text-sm
            "
          >
            {{ community.name }}
          </Link>
          <div><p class="text-sm">Posts({{ community.posts_count }})</p></div>
        </div>
      </li>
    </ul>
  </div>
</template>