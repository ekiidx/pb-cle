<script setup>
import Guest from "@/Layouts/Guest.vue";
import { Link, useForm, Head } from "@inertiajs/vue3";
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
  <Guest>
 
    <Head>
      <title>{{ community.name }} -  {{ post.data.title }}</title>
    </Head>

    <!--- Header -->
    <div class="bg-dark border rounded-lg mb-3 p-3">
      <h2 class="font-semibold text-xl mb-2 text-white">r/
        <Link :href="route('frontend.communities.show', community.slug)">
          {{ community.name }}
        </Link>
      </h2>
    </div>
   
    <div class="row">

      <!-- Main Column -->
      <div class="col-lg-8">

        <!-- Post Card -->
        <div class="flex mb-3 bg-dark border rounded-lg text-sm">

          <!-- Vote -->
          <div>
            <PostVote :post="post.data" />
          </div>

          <!-- Main Section -->
          <div style="padding-right: 48px !important" class="w-full">
            <div class="flex flex-col sm:flex-row justify-between py-3 px-3">
              <div>
                Posted by
                <span class="mx-1 text-darkorchid">{{
                  post.data.username
                }}</span>
                {{ post.data.created_at }}
              </div>


              <!-- Edit and Delete -->
            </div>
          

              <!-- Title -->
              <h1 class="px-3 font-semibold text-3xl text-gray-300">
                {{ post.data.title }}
              </h1>

              <!-- Title -->
              <p class="text-gray-300 px-3 pt-2 whitespace-pre-wrap break-words">{{ post.data.description }}</p>
              
              <!-- Linik -->
              <div class="px-3 py-2 mb-3">
              <a
                :href="post.data.url"
                class="font-semibold text-electricgreen text-sm break-words"
                >{{ post.data.url }}</a
              >
            </div >

            <hr />
            <!-- Comments -->
            <div class="px-3 pt-4 mb-5">
              <ul role="list" class="">
                <li
                  v-for="(comment, index) in post.data.comments"
                  :key="index"
                  class="flex flex-col"
                >
                  <div class="text-sm">
                    Commented by
                    <span class="font-semibold ml-1 text-darkorchid">{{
                      comment.username
                    }}</span>
                  </div>
                  <div class="text-gray-300 pt-2 pb-3 whitespace-pre-wrap break-words">
                    {{ comment.content }}
                  </div>
                </li>
              </ul>
            </div>
        
            <!-- Textarea -->
            <div v-if="$page.props.auth.user.username">
              <form class="max-w-md" @submit.prevent="submit">
                <div class="px-3 mb-3">


                  <textarea
                    v-model="form.content"
                    id="comment"
                    rows="5"
                    class="
                      block
                      p-2.5
                      w-full
                      text-gray-900
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
                <div class="px-3 mb-3">
                  <button
                    class="
                      px-4
                      py-2
                      bg-darkorchid
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
 
      <div class="col-lg-4">
   
        <PostList :posts="posts.data" :community="community">
          <template #title>Popular Posts</template>
        </PostList>

      </div>
    </div>

  </Guest>
</template>
