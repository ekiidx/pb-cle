<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  events: Object,
  new: Boolean
});
</script>

<template>
  <div class="hot-events-box border rounded-lg bg-dark">
    <div class="bg-darkorchid rounded-lg p-3">
      <img class="d-inline" style="max-height: 1.25rem; max-width: 1.4rem; margin-right: 0.65rem; padding-bottom: 0.35rem" src="/assets/img/fire.svg">
      <h2 class="font-semibold text-white d-inline">
        <slot name="title" />
      </h2>
    </div>
    <ul role="list" class="p-3">
      <li
        v-for="event in events"
        :key="event.id"
        class="list-component-item"
      >
        <div class="py-2 flex items-start items-center space-x-4">

        <div style="width: 2.25rem;">
          <Link
            :href="route('events.event.show', event.slug)"
            class="
              font-semibold
              truncate
              text-sm
              text-white
            "
          >
            <div style="width: 2.25rem; border: 1px #9932cc solid; border-radius: 0.35rem;">
              <div style="background: #9932cc; border-radius: 0.2rem 0.2rem 0rem 0rem;">
                <span class="text-gray-100" style="display: flex; justify-content: center; margin-bottom: -0.35rem; font-weight: 800; font-size: 0.6rem; padding-top: 0rem; padding-bottom: 0rem; text-transform: uppercase;">{{ event.month_date_format }}</span>
              </div>
              <span class="text-gray-300" style="display:flex; justify-content: center; font-weight: 800; font-size: 0.6rem; padding-top: 0.2rem; padding-bottom: 0rem;">{{ event.day_date_format }}</span>
            </div>
          </Link>
        </div>
          <Link
            :href="route('events.event.show', event.slug)"
            class="
              font-semibold
              truncate
              text-sm
              text-white
            "
          >
            {{ event.name }}
          </Link>
          <p v-if="event.new" style="color:yellow; margin-left: 0.5rem; font-weight: 600; font-size: .82rem;">NEW</p>
          <!-- <div>Posts({{ community.posts_count }})</div> -->
        </div>
        <div class="px-3 list-border"></div>
      </li>
    </ul>
  </div>
</template>