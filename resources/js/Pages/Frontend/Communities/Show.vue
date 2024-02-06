<script setup>
import Guest from "@/Layouts/Guest.vue";
import { Link, Head } from "@inertiajs/vue3";
import PostCard from "@/Components/PostCard.vue";
import Pagination from "@/Components/Pagination.vue";
import CommunityList from "@/Components/CommunityList.vue";

defineProps({
  community: Object,
  posts: Object,
  communities: Object,
});
</script>

<template>
  <Guest>
    <div class="main-container">
      <Head>
        <title>{{ community.name }}</title>
      </Head>

      <div class="flex justify-between p-3">
        <h2 class="font-semibold text-xl text-white leading-tight">
          /{{ community.name }}
        </h2>
        <Link
          v-if="$page.props.auth.user.username"
          :href="route('communities.posts.create', community.slug)"
          class="px-3 py-2 rounded bg-darkorchid hover:bg-electricgreen text-white"
          >Create Post</Link
        >
      </div>

      <div class="row">
        <!-- Main Column -->
        <div class="col-lg-8">
          <PostCard
            v-for="post in posts.data"
            :post="post"
            :community="community.slug"
            :key="post.id"
          />

          <!-- Pagination -->
          <div class="mt-4 p-2">
            <Pagination :links="posts.meta.links" />
          </div>
        </div>

        <!-- Side Column -->
        <div class="col-lg-4">
          <div>
            <h2
              class="
                font-semibold
                text-lg
                p-6
                bg-dark
                border
                rounded-t-lg
                text-white
              "
            >
              About {{ community.name }}
            </h2>
            <p class="bg-white p-4 rounded-b-lg">{{ community.description }}</p>
          </div>
          <CommunityList class="mt-4" :communities="communities.data">
            <template #title>Latest Communities</template>
          </CommunityList>
        </div>
      </div>
    </div>
  </Guest>
</template>