<script setup>
import { Link } from "@inertiajs/vue3";
import PostVote from "./PostVote.vue";

defineProps({
  post: Object,
  community: String,
});
</script>

<template>
  <div
    class="
      mb-3
      flex
      bg-dark
      rounded-lg
      border border-gray-200
      shadow-md
    "
  >
    <div class="">
      <PostVote :post="post" />
    </div>
    <div>

      <!-- Flex -->
      <div class="post-flex p-3 text-sm">
        <Link
          :href="route('frontend.communities.show', community)"
          class="font-semibold mr-3 hover:text-indigo-700"
          >r/{{ community }}</Link
        >
        <div class="flex">
          Posted by
          <span class="font-semibold mx-1 text-darkorchid">{{ post.username }}</span>
          {{ post.created_at }}
        </div>
      </div>
      <Link
        :href="route('frontend.communities.posts.show', [community, post.slug])"
      >
        <h2
          class="
            pl-3 pr-3 mb-2
            font-bold
            tracking-tight
            text-white
            whitespace-break-spaces
            post-title
          "
        >
          {{ post.title }}
        </h2>
      </Link>
      <p class="pl-3 pr-3 mb-3 font-normal text-sm text-gray-300 post-description whitespace-pre-wrap">
        {{ post.description }}
      </p>

      <!-- Flex -->
      <div class="post-flex m-2 p-2">
        <p class="mr-4 p-2">Comments({{ post.comments_count }})</p>
        <Link
          :href="
            route('frontend.communities.posts.show', [community, post.slug])
          "
          class="
            inline-flex
            items-center
            py-2
            px-3
            text-sm
            font-medium
            text-center text-white
            bg-darkorchid
            rounded-lg
            hover:bg-electricgreen
            focus:ring-4 focus:outline-none focus:ring-blue-300
            dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800
          "
        >
          Read more
          <svg
            aria-hidden="true"
            class="ml-2 -mr-1 w-4 h-4"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
              clip-rule="evenodd"
            ></path>
          </svg>
        </Link>
      </div>
    </div>
  </div>
</template>
