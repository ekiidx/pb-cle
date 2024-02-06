<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  event: Object
});
</script>

<template>

  <!-- {{ event.data }} -->
   <a :href="'../events/'+ event.slug">{{ event.name }}</a>
  <p>{{ event.content }}</p>
</template>
