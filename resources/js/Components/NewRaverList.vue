<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  users: Object,
});
</script>

<template>
  <div class="new-raver-box border rounded-lg bg-dark">
    <div class="bg-darkorchid rounded-lg p-3">
      <img class="d-inline" style="max-height: 1.25rem; max-width: 1.4rem; margin-right: 0.65rem; padding-bottom: 0.35rem" src="/assets/img/fire.svg">
      <h2 class="font-semibold text-white d-inline">
        <slot name="title" />
      </h2>
    </div>

    <ul role="list" class="py-2 px-3">
      <li
        v-for="user in users"
        :key="user.id"
        class="list-component-item"
      >
        <div class="py-2 flex items-start items-center space-x-4">
          <Link
            :href="route('ravers.show', user.slug)"
          >
            <img class="profile-img rounded-full border object-cover" :src="user.profile_photo_url">
          </Link>
          <Link
            :href="route('ravers.show', user.slug)"
            class="
              font-semibold
              text-sm
              text-white
            "
          >
            {{ user.username }}
          </Link>
         </div>
         <div class="px-3 list-border"></div>
      </li>
    </ul>
  </div>
</template>