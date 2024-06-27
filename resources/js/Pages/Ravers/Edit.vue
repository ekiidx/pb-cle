<script setup>
import { ref, computed, useSlots } from 'vue';
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
// import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
// import InputLabel from '@/Components/InputLabel.vue';
// import TextInput from '@/Components/TextInput.vue';


const props = defineProps({
  user: Object,
  errors: Object,
  // fields: { name: '', url: '' }
});

// const fields = ref([
//   { name: '', url: '' }
// ])

const form_websites = useForm({
  link_one: props.user?.link_one,
  link_two: props.user?.link_two,
  link_three: props.user?.link_three,
  link_four: props.user?.link_four,
  link_five: props.user?.link_five,
  link_six: props.user?.link_six,
  link_seven: props.user?.link_seven,
  link_eight: props.user?.link_eight,
});

const form = useForm({
    _method: 'PUT',
    name: props.user.username,
    email: props.user.email,
    photo: null,
});

// defineEmits(['submitted']);

// const hasActions = computed(() => !! useSlots().actions);

// const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

// const sendEmailVerification = () => {
//     verificationLinkSent.value = true;
// };

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

// const deletePhoto = () => {
//     router.delete(route('current-user-photo.destroy'), {
//         preserveScroll: true,
//         onSuccess: () => {
//             photoPreview.value = null;
//             clearPhotoFileInput();
//         },
//     });
// };

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};

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

const submit_websites = () => {
  form_websites.post(
    route("ravers.update", [props.user])
    );
};

</script>

<template>
  <Head title="Edit Raver" />
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
            border border-gray-200
            p-3
          "
          >
          <h1 class="font-semibold text-xl text-white main-title-text leading-tight">
            <span class="text-white">{{ user.username }}</span>
            <!-- <Link :href="route('frontend.communities.show', community.slug)">
              {{ community.name }}
            </Link> -->
          </h1>
        </div>

        <!-- Profile Image Card -->
        <!-- <div class="flex mb-3 bg-dark border rounded-lg text-sm">
          <div class="w-full py-3 px-3"> -->

            <FormSection @submitted="updateProfileInformation">
    
              <template #title>
                  Photo
              </template>

              <template #description>

              </template>

              <template #form>
                <!-- Profile Photo -->
                <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input
                        ref="photoInput"
                        type="file"
                        class="hidden"
                        @change="updatePhotoPreview"
                    >

                    <!-- <InputLabel for="photo" value="Photo" /> -->

                    <!-- Current Profile Photo -->
                    <div v-show="! photoPreview" class="pt-2">
                        <img :src="user.profile_photo_url" :alt="user.username" class="rounded-full h-20 w-20 object-cover mb-4">
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div v-show="photoPreview" class="pt-2">
                        <span
                            class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center mb-4"
                            :style="'background-image: url(\'' + photoPreview + '\');'"
                        />
                    </div>

                    <div class="">
                        <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                            Select A New Photo
                        </SecondaryButton>

                        <!-- <SecondaryButton
                            v-if="user.profile_photo_path"
                            type="button"
                            class="mt-2"
                            @click.prevent="deletePhoto"
                        >
                            Remove Photo
                        </SecondaryButton> -->
                    </div>

                    <InputError :message="form.errors.photo" class="mt-2" />
                </div>

            <!-- Name -->
            <!-- <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="name"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div> -->
        </template>

        <template #actions>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>

            <ActionMessage :on="form.recentlySuccessful" class="ml-3">
                Saved.
            </ActionMessage>
        </template>
    </FormSection>
              <!-- </div>
            </div> -->


            <!-- Websites Card -->
            <div class="flex mb-3 bg-dark border rounded-lg text-sm">
              <div class="w-full py-3 px-3">

                          <!-- Form -->
                <form @submit.prevent="submit_websites">
                <!-- <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                  <UpdateProfileInformationForm :user="$page.props.auth.user" />
                </div> -->

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
                  <h2 class="text-white font-sm fw-600 mb-4">Website Links</h2>

                  <div class="mb-3">
                    <Label for="link_one" value="Website" />
                    <Input
                      id="link_one"
                      type="url"
                      class="mt-1 block w-full bg-dark text-white"
                      v-model="form_websites.link_one"
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
                      v-model="form_websites.link_two"
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
                      v-model="form_websites.link_three"
                      autocomplete="link_three"
                    />
                    <InputError :message="errors.link_three" />
                  </div>
            </div>

                <h2 class="text-white font-sm fw-600 mb-4">Social Links</h2>
                <div class="mb-3">
                  <Label for="link_four" value="Instagram" />
                  <Input
                    id="link_four"
                    type="url"
                    class="mt-1 block w-full bg-dark text-white"
                    v-model="form_websites.link_four"
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
                    v-model="form_websites.link_five"
                    autocomplete="link_five"
                  />
                  <InputError :message="errors.link_five" />
                </div>

                <div class="mb-3">
                  <Label for="link_six" value="X.com" />
                  <Input
                    id="link_six"
                    type="url"
                    class="mt-1 block w-full bg-dark text-white"
                    v-model="form_websites.link_six"
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
                    v-model="form_websites.link_seven"
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
                    v-model="form_websites.link_eight"
                    autocomplete="link_eight"
                  />
                  <InputError :message="errors.link_eight" />
                </div>

                <div class="flex items-center mt-5 mb-2">
                  <Button
                    class="comment-btn items-center border-transparent bg-darkorchid fw-600 text-white font-xsss text-center lh-20 rounded-xl"
                    :class="{ 'opacity-25': form_websites.processing }"
                    :disabled="form_websites.processing"
                  >
                    Submit
                  </Button>
                </div>
              </form>
            </div>
          </div>
          
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
          <div class="border rounded-lg mb-3">
            <div class="bg-darkorchid rounded-lg p-3">
              <img class="d-inline" style="max-height: 1.1rem; max-width: 1.25rem; margin-right: 0.35rem; padding-bottom: 0.23rem" src="/assets/img/edit.svg">
              <h2
              class="
                font-semibold
                text-white
                d-inline
                "
              >
                Edit Raver
              </h2>
            </div>
            <p class="bg-dark font-normal text-sm text-grey-300 p-3 rounded-b-lg">You can use this screen to edit yourself!</p>
          </div>
		    </div>
      </div>
    </div>
  </AppLayout>
</template>

<style>
.section-title-description {
  display: none !important;
}
</style>