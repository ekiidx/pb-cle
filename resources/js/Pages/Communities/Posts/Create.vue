<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import InputLabel from '@/Components/InputLabel.vue';
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps({
  community: Object,
  errors: Object,
});

const form = useForm({
  title: "",
  description: "",
  url: "",
});

const submit = () => {
  form.post(route("communities.posts.store", props.community.slug));
};
</script>

<template>
  <Head title="Create Post" />

  <AppLayout title="Dashboard">

    <!-- Header -->
    <div class="bg-dark border rounded-lg mb-3 p-3">
      <h2 class="font-semibold text-xl mb-2 text-white leading-tight">
        Create Post for r/{{ community.name }}
      </h2>
    </div>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-dark border rounded-lg m-2 p-6">
          <form @submit.prevent="submit">
            <div>
              <Label for="title" value="Title" />
              <Input
                id="title"
                type="text"
                class="mt-1 block w-full"
                v-model="form.title"
                autofocus
                autocomplete="title"
              />
              <InputError :message="errors.title" />
            </div>

            <div class="mt-4">
              <Label for="url" value="Url" />
              <Input
                id="url"
                type="url"
                class="mt-1 block w-full"
                v-model="form.url"
                autocomplete="url"
              />
              <InputError :message="errors.url" />
            </div>

            <div class="mt-4">
              <Label for="description" value="Description" />
              <textarea
                id="description"
                type="text"
                rows="5"
                class="mt-1 block w-full"
                v-model="form.description"
                autocomplete="description"
              ></textarea>
              <InputError :message="errors.description" />
            </div>

            <div class="flex items-center justify-end mt-4">
              <Button
                class="ml-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Store
              </Button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

