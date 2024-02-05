<script setup>
import Guest from "@/Layouts/Guest.vue";
import EventCard from "@/Components/EventCard.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
  events: Object,
});
</script>

<template>
    <Guest>
      <Head title="Events" />

      <div class="main-container">
        <div class="row">
          <div class="col-lg-8">
              <h1 style="color:#ffffff;">Events</h1>
              <EventCard
                  v-for="event in events"
                  :event="event"
                  :key="event.id"
                />
          </div>

          <!-- {{ $page.props.events }} -->

          <div class="col-lg-4">
          
          </div>
        </div>
      </div>
    </Guest>
</template>