<script setup>
import EventCard from "@/Components/EventCard.vue";

defineProps({
  events: Object,
});
</script>

<template>
  <div class="bg-dark shadow-md border rounded-lg">
    <h2 class="font-semibold text-lg p-6 bg-darkorchid text-white rounded-lg">
      <slot name="title" />
    </h2>
    <EventCard
      v-for="event in events"
      :event="event"
      :key="event.id"
    />
  </div>
</template>