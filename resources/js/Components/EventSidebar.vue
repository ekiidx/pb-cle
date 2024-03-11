<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  events: Object,
});
</script>

<template>
  <div class="bg-dark shadow-md border rounded-lg hot-events-box">
    <h2 class="font-semibold text-lg bg-darkorchid text-white rounded-lg">
      <slot name="title" />
    </h2>
    <ul role="list" class="divide-y divide-slate-300 dark:divide-slate-700 p-4">
      <li
        v-for="event in events"
        :key="event.id"
        class="py-3 sm:py-4"
      >
        <div class="flex items-center space-x-4">
          <Link
            :href="route('events.show', event.slug)"
            class="
              text-slate-800
              font-semibold
              truncate
              text-sm
            "
          >
            {{ event.name }}
          </Link>
          <!-- <div>Posts({{ community.posts_count }})</div> -->
        </div>
      </li>
    </ul>
  </div>
</template>