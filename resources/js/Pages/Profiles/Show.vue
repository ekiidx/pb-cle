<script setup>
import Guest from '@/Layouts/Guest.vue';

const props = defineProps({
  user: Object,
});
</script>


<template>
    <Guest>
        <Head>
            <title>{{ user.username }}</title>
        </Head>

      <h1>{{ user.username }}</h1>
      <img class="profile-img rounded-full object-cover" :src="$page.props.user.profile_photo_url">
      <p></p>
    </Guest>
</template>