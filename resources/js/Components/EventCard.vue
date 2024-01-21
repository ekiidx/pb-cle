<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  event: Object
});
</script>

<template>

  <!-- {{ event.data }} -->
  <h2 style="color: #ffffff;">{{ event.name }}</h2>
  <p>{{ event.content }}</p>
</template>
