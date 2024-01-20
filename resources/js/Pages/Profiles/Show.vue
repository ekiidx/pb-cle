<script setup>
import Guest from '@/Layouts/Guest.vue';
import PostCardProfile from "@/Components/PostCardProfile.vue";
import { Head } from '@inertiajs/vue3';

const props = defineProps({
  user: Object,
  posts: Object,
});
</script>

<template>
    <Guest>
        <Head>
            <title>{{ $page.props.user.username }}</title>
        </Head>

      <h1 style="color:#ffffff;">{{ user.username }}</h1>
      <img class="profile-img rounded-full object-cover" :src="$page.props.user.profile_photo_url">

      {{ $page.props.user.id }}

      <!-- {{ $page.props.posts }} -->
      
      <PostCardProfile
            v-for="post in posts.data"
            :post="post"
            :community="post.community_slug"
            :key="post.id"
          />

    </Guest>
</template>`