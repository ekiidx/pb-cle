<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
// import InputLabel from '@/Components/InputLabel.vue';
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
  community: Object,
  errors: Object
});

const form = useForm({
  title: "",
  description: "",
  url: "",
  post_image: "",
});

function imagePreview() {
  frame.src=URL.createObjectURL(event.target.files[0])
}
  
const submit = () => {
  form.post(route("communities.posts.store", props.community.slug));
};
</script>

<template>
  <Head title="Create Post" />

  <AppLayout title="Dashboard">

    <div class="main-container">
      <div class="row g-3">

				<!-- Main Column -->
				<div class="col-lg-8">
            <!-- Header -->
            <!-- <div class="bg-dark border rounded-lg mb-3 p-3">
              <h2 class="font-semibold text-xl mb-2 text-white leading-tight">
                Create Post for r/{{ community.name }}
              </h2>
            </div> -->

            <!--- Header -->
					<div
						class="
						header-post-box
						flex
						bg-dark
						rounded-lg
						border border-gray-200
						shadow-md
						p-3
						"
					>
            <h2 class="font-semibold text-xl text-white main-title-text leading-tight"><span class="text-white">/</span>
							<Link :href="route('frontend.communities.show', community.slug)">
								{{ community.name }}
							</Link>
						</h2>
					</div>

          <!-- Post Card -->
          <div class="flex mb-3 bg-dark border rounded-lg text-sm">

            <!-- Main Section -->
            <div style="padding-right: 48px !important" class="w-full py-3 px-3">
              <form @submit.prevent="submit">
                <div>
                  <Label for="title" value="Title" />
                  <Input
                    id="title"
                    type="text"
                    class="mt-1 block w-full bg-dark text-white"
                    v-model="form.title"
                    autofocus
                    autocomplete="title"
                  />
                  <InputError :message="errors.title" />
                </div>

                <div class="mt-4">
                  <Label for="url" value="Post Link" />
                  <Input
                    id="url"
                    type="url"
                    class="mt-1 block w-full bg-dark text-white"
                    v-model="form.url"
                    autocomplete="url"
                  />
                  <InputError :message="errors.url" />
                </div>

                <div class="mt-4">
                  <Label for="description" value="Content" />
                  <textarea
                    id="description"
                    type="text"
                    rows="5"
                    class="mt-1 block w-full bg-dark text-white"
                    v-model="form.description"
                    autocomplete="description"
                  ></textarea>
                  <InputError :message="errors.description" />
                </div>

                <div class="mt-4">
                  <Label for="post_image" value="Add Image" />
                    <img id="frame" src="" style="max-width: 7rem; max-height: 5rem; height: auto;">
                    <InputError :message="errors.post_image" />
                    <input style="display:block" name="post_image" type="file" @input="form.post_image = $event.target.files[0]" @change="imagePreview()"/>
                </div>

                <div id="preview">
                 
                </div>


                <div class="flex items-center mt-4 mb-2">
                  <Button
                    class="comment-btn items-center border-transparent bg-darkorchid fw-600 text-white font-xsss text-center lh-20 rounded-xl"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                  >
                    Submit
                  </Button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="border rounded-lg mb-3">
            <h2
            class="
              font-semibold
              bg-darkorchid
              rounded-lg
              text-white
              p-3
            "
            >
              About {{ community.name }}
            </h2>
              <p class="bg-dark font-normal text-sm text-grey-300 p-4 rounded-b-lg">{{ community.description }}</p>
          </div>
				</div>
      </div>
    </div>
  </AppLayout>
</template>