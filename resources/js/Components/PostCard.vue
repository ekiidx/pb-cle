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
      post-card
      flex
      bg-dark
      rounded-lg
      border border-gray-200
    "
  >
    <div class="">
      <PostVote :post="post" />
    </div>
    <div class="w-full" style="padding-right: 48px !important;">

      <!-- Flex -->
      <div class="post-flex p-3 text-sm">
        <Link
          :href="route('frontend.communities.show', community)"
          class="font-semibold mr-1 hover:text-indigo-700"
          >/{{ community }}</Link
        >
        <div class="post-header">
          <!-- Posted by -->
          <a :href="'/ravers/'+post.user_slug">
          <span class="font-semibold mx-1 text-darkorchid">{{ post.username }}</span></a>
          {{ post.created_at }}
        </div>
      </div>
      <Link
        :href="route('frontend.communities.posts.show', [community, post.slug])"
      >
        <h2
          class="
            pl-4 pr-3 mb-2
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
      <p class="pl-4 pr-3 mb-3 font-normal text-sm text-gray-300 post-description break-words whitespace-pre-wrap">
        {{ post.description }}
      </p>
      <a v-if="post.post_image" :href="'/posts/'+community+'/posts/'+post.slug">
        <img class="rounded-sm pl-4 pb-3" style="max-width: 100%; height: auto;" :src="'/storage/post-images/'+post.post_image">
      </a>

      <!-- Flex -->
      <div class="post-flex read-more-box">
        <p class="mr-4">Comments({{ post.comments_count }})</p>
        <Link
          :href="
            route('frontend.communities.posts.show', [community, post.slug])
          "
          class="comment-btn d-inline-block items-center border-transparent bg-darkorchid fw-600 text-white font-xsss text-center lh-20 rounded-xl"
        >
          Read more
          <svg
            aria-hidden="true"
            class="d-inline ml-1 -mr-1 w-4 h-4"
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
