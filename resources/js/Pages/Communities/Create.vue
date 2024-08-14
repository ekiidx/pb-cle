<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
  errors: Object,
});

const form = useForm({
  name: "",
  description: ""
});

const submit = () => {
  form.post(route("communities.store"));
};
</script>

<template>
  <Head title="Create Community" />

  <AppLayout title="Dashboard">

    <div class="main-container">
      <div class="row gutter">

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
						"
					>
            <h2 class="font-semibold text-xl text-white main-title-text leading-tight">
							Create Community
						</h2>
					</div>

          <!-- Post Card -->
          <div class="post-card bg-dark border rounded-lg text-sm">

            <!-- Main Section -->
            <div class="w-full py-3 px-3">

              <form @submit.prevent="submit">
                <div>
                  <InputLabel for="name" value="Name" />
                  <Input
                    id="name"
                    type="text"
                    class="mt-1 block w-full bg-dark text-white"
                    v-model="form.name"
                    autofocus
                    autocomplete="name"
                  />
                  <InputError :message="errors.name" />
                </div>

                <div class="mt-4">
                  <InputLabel for="description" value="Description" />
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

                <div class="flex items-center mt-4 mb-2">
                  <Button
                    class="comment-btn items-center border-transparent bg-darkorchid fw-600 text-white font-xsss text-center lh-20 rounded-xl"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    onclick="return confirm('Are you sure you wish to spend 100 PLUR points to create a new community?')"
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
            <div class="bg-darkorchid rounded-lg p-3">
							<img class="d-inline" style="max-height: 1.1rem; max-width: 1.25rem; margin-right: 0.35rem; padding-bottom: 0.23rem" src="/assets/img/about.svg">
              <h2
              class="
						    font-semibold
								text-lg
								text-white
								d-inline
              "
              >
                Create Community
              </h2>
            </div>
            <p class="bg-dark font-normal text-sm text-grey-300 p-4 rounded-b-lg">You must spend <span class="font-bold">100</span> <span class="text-electricgreen font-bold">PLUR Points</span> in order to create a custom community.</p>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>