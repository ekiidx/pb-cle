<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import InputError from "@/Components/InputError.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
  community: Object,
  post: Object,
  comment: Object,
  errors: Object,
});

// Form
let form = useForm({
    content: props.comment?.content,
    comment_image: props.comment?.comment_image
});

function commentImagePreview() {
  commentImageFrame.src=URL.createObjectURL(event.target.files[0])
}

const submit = () => {
  form.post(
    route("posts.comments.update", [props.community.slug, props.post.slug, props.comment.id])
    );
};
</script>

<template>
    <Head title="Edit Comment" />
  
    <AppLayout title="Dashboard">
  
      <div class="main-container">
        <div class="row gutter">
  
          <!-- Main Column -->
          <div class="col-lg-8">

              <!--- Header -->
              <div
                class="
                header-post-box
                flex
                bg-dark
                rounded-lg
                border
                "
            >
            <h2 class="font-semibold text-xl text-white main-title-text leading-tight"><span class="text-white">Edit Comment</span>
							<!-- <Link :href="route('communities.show', community.slug)">
								{{ community.name }}
							</Link> -->
						</h2>
					</div>

   <!-- Post Card -->
   <div class="post-card bg-dark border rounded-lg text-sm">

<!-- Main Section -->
<div class="w-full py-3 px-3">

  <form @submit.prevent="submit">

    <div>
                  <Label for="content" value="Content" />
                  <textarea
                    id="content"
                    type="text"
                    rows="5"
                    class="mt-1 block w-full bg-dark text-white"
                    v-model="form.content"
                    autocomplete="content"
                  ></textarea>
                  <InputError :message="errors.content" />
                </div>

                <div class="mb-4">
                  <img v-if="props.comment.comment_image" 
                    style="max-width: 7rem; max-height: 5rem; height: auto;"
                    class="mt-2"
                    id="commentImageFrame"
                    :src="'/storage/comment-images/'+comment.comment_image">
                    <img v-else
                    style="max-width: 7rem; max-height: 5rem; height: auto;" 
                    id="commentImageFrame"
                    src="">
                    <InputError :message="errors.comment_image" />
                    <label for="comment-image-upload" class="cursor-pointer image-upload-button"><i class="ti-image text-xl"></i></label>
                  <input id="comment-image-upload" style="display:none" name="comment_image" type="file" @input="form.comment_image = $event.target.files[0]" @change="commentImagePreview()" hidden />
                </div>

                <div class="mb-2">
                  <Button
                    class="comment-btn items-center border-transparent bg-darkorchid fw-600 text-white font-xsss text-center lh-20 rounded-xl"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                  >
                    Submit
                  </Button>

                  {{ content }}
                </div>

            </form>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="border rounded-lg mb-3">
            <div class="bg-darkorchid rounded-lg p-3">
              <img class="d-inline" style="max-height: 1.1rem; max-width: 1.25rem; margin-right: 0.35rem; padding-bottom: 0.23rem" src="/assets/img/edit.svg">
              <h2
              class="
                font-semibold
                text-lg
                text-white
                d-inline
                "
              >
                Edit Comment
              </h2>
            </div>
            <p class="bg-dark font-normal text-sm text-grey-300 p-3 rounded-b-lg">You can use this screen to edit your comment.</p>
          </div>
		    </div>
      </div>
    </div>
  </AppLayout>
</template>