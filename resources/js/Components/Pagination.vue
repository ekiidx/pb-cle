<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  links: [],
});
</script>

<template>
  <div class="flex">
    <template v-for="(link, key) in links" :key="key">
      <div
        v-if="link.url === null"
        v-html="link.label"
        class="
          mb-1
          mr-1
          px-4
          py-3
          text-gray-400 text-sm
          leading-4
          border
          rounded
        "
      ></div>
      <Link
        v-else
        :href="link.url"
        v-html="link.label"
        class="
          mb-1
          mr-1
          px-4
          py-3
          text-white text-sm
          leading-4
          border
          rounded
          focus:text-indigo-500 focus:border-indigo-500
        "
        :class="{ 'bg-darkorchid': link.active }"
      ></Link>
    </template>
  </div>
</template>