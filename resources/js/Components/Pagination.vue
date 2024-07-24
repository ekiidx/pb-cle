<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  links: Array,
});
</script>

<template>
  <div class="flex pagination-vue">
    <template v-for="(link, key) in links" :key="key">
      <div
        v-if="link.url === null"
      ></div>
    
      <!-- <div
        v-if="link.url === null"
        v-html="link.label"
        class="
          flex
          items-center
          mb-1
          mr-1
          px-3
          py-2.5
          text-gray-400 text-sm
          leading-4
          border
          rounded
        "
      ></div> -->
      <Link
        v-else
        :href="link.url"
        v-html="link.label"
        style=""
        class="
          pagination-vue-item
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