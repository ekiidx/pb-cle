<script setup>
import Guest from "@/Layouts/Guest.vue";
import { Head } from "@inertiajs/vue3";
// import PostVote from "@/Components/PostVote.vue";
// import PostList from "@/Components/PostList.vue";

const props = defineProps({
  users: Object,
});
</script>


<template>
    <Guest>
      <Head title="Home" />

      <div class="row">
        <div class="col-lg-8">
      <h1>Hey! You shouldn't be here.</h1>
        </div>
        <div class="col-lg-4">
        
        </div>
      </div>
    </Guest>
</template>