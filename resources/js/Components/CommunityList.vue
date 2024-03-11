<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  communities: Object,
});
</script>

<template>
  <div class="bg-dark shadow-md border top-communities-box rounded-lg">
    <h2 class="font-semibold text-lg bg-darkorchid text-white rounded-lg">
      <slot name="title" />
    </h2>
    <ul role="list" class="divide-y divide-slate-300 dark:divide-slate-700 p-4">
      <li
        v-for="community in communities"
        :key="community.id"
        class="py-3 sm:py-4"
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
          <div>Posts({{ community.posts_count }})</div>
        </div>
      </li>
    </ul>
  </div>
</template>