<script setup>
import Guest from "@/Layouts/Guest.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
  event: Object,
});
</script>


<template>
    <Guest>
        <Head>
            <title>{{ $page.props.event.name }}</title>
        </Head>

      <h1 style="color:#ffffff;">{{ $page.props.event.name }}</h1>
      <p>{{ event.content }}</p>
      <img class="" :src="$page.props.event.flyer_front">
      <img class="" :src="$page.props.event.flyer_back">

      
       <!-- {{ $page.props.event }} -->
      
     

    </Guest>
</template>