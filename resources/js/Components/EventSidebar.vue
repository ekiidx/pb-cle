<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  events: Object,
  new: Boolean
});
</script>

<template>
  <div class="border rounded-lg mb-2 bg-dark">
    <div class="bg-darkorchid rounded-lg p-3">
      <img class="d-inline" style="max-height: 1.45rem; max-width: 1.45rem; margin-right: 0.65rem; padding-bottom: 0.35rem" src="/assets/img/fire.svg">
      <h2 class="font-semibold text-lg text-white d-inline">
        <slot name="title" />
      </h2>
    </div>
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
          <p v-if="event.new" style="color:yellow; margin-left: 0.5rem; font-weight: 600; font-size: .82rem;">NEW</p>
          <!-- <div>Posts({{ community.posts_count }})</div> -->
        </div>
      </li>
    </ul>
  </div>
</template>