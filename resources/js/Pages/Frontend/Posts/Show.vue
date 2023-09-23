<script setup>
import GuestLayout from "@/Layouts/Guest.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import PostVote from "@/Components/PostVote.vue";
import PostList from "@/Components/PostList.vue";

const props = defineProps({
  community: Object,
  post: Object,
  posts: Object,
  can_delete: Boolean,
  can_update: Boolean,
});

const form = useForm({
  content: "",
});

const submit = () => {
  form.post(
    route("frontend.posts.comments", [
      props.community.slug,
      props.post.data.slug,
    ]),
    {
      onSuccess: () => form.reset("content"),
    }
  );
};
</script>

<template>
  <guest-layout>
 
    <!-- Header -->
    <div class="bg-dark border rounded-lg mb-3 p-3">
      <h2 class="font-semibold text-xl mb-2 text-white">r/
        <Link :href="route('frontend.communities.show', community.slug)"
        class="text-white"
        >
          {{ community.name }}
        </Link>
      </h2>
    </div>


    <div class="row">
<!-- Main Column-->
<div class="col-lg-8">

    <div class="flex mb-3 bg-dark border rounded-lg text-sm text-white">
      <div>
        <PostVote :post="post.data" />
      </div>
      <div class="w-full">
        <div class="flex flex-col md:flex-row justify-between m-2">
          <div>
            Posted by
            <span class="mx-2 text-darkorchid">{{
              post.data.username
            }}</span>
            {{ post.data.created_at }}
          </div>
          <div v-if="$page.props.auth.auth_check">
            <Link
              v-if="can_update"
              :href="
                route('communities.posts.edit', [
                  community.slug,
                  post.data.slug,
                ])
              "
              class="
                font-semibold
                bg-electricgreen
                hover:bg-darkorchid
                rounded-md
                text-white
                px-4
                py-2
                mr-2
              "
              >Edit</Link
            >
            <Link
              v-if="can_delete"
              :href="
                route('communities.posts.destroy', [
                  community.slug,
                  post.data.slug,
                ])
              "
              class="
                font-semibold
                bg-darkorchid
                hover:bg-electricgreen
                rounded-md
                text-white
                px-4
                py-2
              "
              method="delete"
              as="button"
              type="button"
              >Delete</Link
            >
          </div>
        </div>

        
        <div class="p-2">
          <h1 class="font-semibold text-3xl text-gray-300">
            {{ post.data.title }}
          </h1>
          <p class="text-white">{{ post.data.description }}</p>
          <a
            :href="post.data.url"
            class="font-semibold text-electricgreen text-sm hover:text-darkorchid"
            >{{ post.data.url }}</a
          >
        </div>

        <div>
          <ul role="list" class="divide-y divide-gray-200 m-2 p-2">
            <li
              v-for="(comment, index) in post.data.comments"
              :key="index"
              class="py-4 flex flex-col"
            >
              <div class="text-sm">
                Commented by
                <span class="font-semibold ml-1 text-electricgreen">{{
                  comment.username
                }}</span>
              </div>
              <div class="text-gray-300 m-2 p-2">
                {{ comment.content }}
              </div>
            </li>
          </ul>
        </div>
    
        <div v-if="$page.props.auth.auth_check">
          <form class="m-2 p-2 max-w-md" @submit.prevent="submit">
            <div class="mt-2">
              <label
                for="comment"
                class="
                  block
                  mb-2
                  text-sm
                  font-medium
                  text-gray-900
                  dark:text-gray-400
                "
                >Your comment</label
              >
              <textarea
                v-model="form.content"
                id="comment"
                rows="5"
                class="
                  block
                  p-2.5
                  w-full
                  text-sm text-gray-900
                  bg-gray-50
                  rounded-lg
                  border border-gray-300
                  focus:ring-blue-500 focus:border-blue-500
                  dark:bg-gray-700
                  dark:border-gray-600
                  dark:placeholder-gray-400
                  dark:text-white
                  dark:focus:ring-blue-500
                  dark:focus:border-blue-500
                "
                placeholder="Your comment..."
              ></textarea>
            </div>
            <div class="mt-2">
              <button
                class="
                  px-4
                  py-2
                  bg-darkorchid
                  hover:electricgreen
                  text-white
                  rounded-md
                "
              >
                Comment
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="col-4">

    <div class="w-full">
      <PostList :posts="posts.data" :community="community">
        <template #title>Popular Posts</template>
      </PostList>
    </div>
    </div>
</div>

  </guest-layout>
</template>