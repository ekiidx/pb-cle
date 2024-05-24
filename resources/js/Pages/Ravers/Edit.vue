<script setup>
// import { ref } from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
// import InputLabel from '@/Components/InputLabel.vue';
// import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
  user: Object,
  errors: Object,
  // fields: { name: '', url: '' }
});

// const fields = ref([
//   { name: '', url: '' }
// ])

const form = useForm({
  link_one: props.user?.link_one,
  link_two: props.user?.link_two,
  link_three: props.user?.link_three,
  link_four: props.user?.link_four,
  link_five: props.user?.link_five,
  link_six: props.user?.link_six,
  link_seven: props.user?.link_seven,
  link_eight: props.user?.link_eight,
});

// function addField() {
//   const i = fields.value.length
//   if (i > 3) {
//     return
//   }else{
//     fields.value.push({ name: '', url: '' });
//   }
// }

// function remove(field) {
//   const i = fields.value.indexOf(field)
//   if (i > -1) {
//     fields.value.splice(i, 1)
//   }
// }

const submit = () => {
  form.post(
    route("ravers.update", [props.user])
    );
};
</script>

<template>
  <Head title="Edit Raver" />

  <AppLayout title="Dashboard">

    <div class="main-container">
      <div class="row g-3">

        <!-- Main Column -->
        <div class="col-lg-8">

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
            <h1 class="font-semibold text-xl text-white main-title-text leading-tight"><span class="text-white">{{ user.username }}</span>
							<!-- <Link :href="route('frontend.communities.show', community.slug)">
								{{ community.name }}
							</Link> -->
						</h1>
					</div>

          <!-- Post Card -->
          <div class="flex mb-3 bg-dark border rounded-lg text-sm">

            <!-- Main Section -->
            <div style="padding-right: 48px !important" class="w-full py-3 px-3">
              <!-- <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                <UpdateProfileInformationForm :user="$page.props.auth.user" />
              </div> -->

              <form @submit.prevent="submit">

                <!-- <div>
                  <div v-for="field in fields">
                    <input 
                      v-model="field.name"
                      type="text"
                      placeholder="Name"
                    >
                    <input 
                      v-model="field.url" 
                      type="url"
                      placeholder="URL"
                    >
                    <button @click="remove(field)">X</button>
                  </div>
  
                  <button @click="addField">New Field</button>
                  <pre>{{ fields }}</pre>
                </div> -->

                <div class="mb-5">
                  <h2 class="text-white font-sm fw-600 mb-3">Website Links</h2>

                  <div class="mb-3">
                    <Label for="link_one" value="Website" />
                    <Input
                      id="link_one"
                      type="url"
                      class="mt-1 block w-full bg-dark text-white"
                      v-model="form.link_one"
                      autocomplete="link_one"
                    />
                    <InputError :message="errors.link_one" />
                  </div>

                  <div class="mb-3">
                    <Label for="link_two" value="Website" />
                    <Input
                      id="link_two"
                      type="url"
                      class="mt-1 block w-full bg-dark text-white"
                      v-model="form.link_two"
                      autocomplete="link_two"
                    />
                    <InputError :message="errors.link_three" />
                  </div>

                  <div class="mb-3">
                    <Label for="link_three" value="Website" />
                    <Input
                      id="link_three"
                      type="url"
                      class="mt-1 block w-full bg-dark text-white"
                      v-model="form.link_three"
                      autocomplete="link_three"
                    />
                    <InputError :message="errors.link_three" />
                  </div>
                </div>

                <h2 class="text-white font-sm fw-600 mb-3">Social Links</h2>
                <div class="mb-3">
                  <Label for="link_four" value="Instagram" />
                  <Input
                    id="link_four"
                    type="url"
                    class="mt-1 block w-full bg-dark text-white"
                    v-model="form.link_four"
                    autocomplete="link_four"
                  />
                  <InputError :message="errors.link_four" />
                </div>

                <div class="mb-3">
                  <Label for="link_five" value="Facebook" />
                  <Input
                    id="link_five"
                    type="url"
                    class="mt-1 block w-full bg-dark text-white"
                    v-model="form.link_five"
                    autocomplete="link_five"
                  />
                  <InputError :message="errors.link_five" />
                </div>

                <div class="mb-3">
                  <Label for="link_six" value="X" />
                  <Input
                    id="link_six"
                    type="url"
                    class="mt-1 block w-full bg-dark text-white"
                    v-model="form.link_six"
                    autocomplete="link_six"
                  />
                  <InputError :message="errors.link_six" />
                </div>

                <div class="mb-3">
                  <Label for="link_seven" value="Soundcloud" />
                  <Input
                    id="link_seven"
                    type="url"
                    class="mt-1 block w-full bg-dark text-white"
                    v-model="form.link_seven"
                    autocomplete="link_seven"
                  />
                  <InputError :message="errors.link_seven" />
                </div>

                <div class="mb-3">
                  <Label for="link_eight" value="Bandcamp" />
                  <Input
                    id="link_eight"
                    type="url"
                    class="mt-1 block w-full bg-dark text-white"
                    v-model="form.link_eight"
                    autocomplete="link_eight"
                  />
                  <InputError :message="errors.link_eight" />
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
      </div>
    </div>
  </AppLayout>
</template>