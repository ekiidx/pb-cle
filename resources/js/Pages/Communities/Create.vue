<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  errors: Object,
});

const form = useForm({
  name: "",
  description: "",
  slug: "",
});

const submit = () => {
  form.post(route("communities.store"));
};
</script>

<template>
  <Head title="Create Community" />

  <AppLayout title="Dashboard">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Create Community
    </h2>


    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-white m-2 p-6">

          <form @submit.prevent="submit">
            <div>
              <InputLabel for="name" value="Name" />
              <Input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                autofocus
                autocomplete="name"
              />
              <InputError :message="errors.name" />
            </div>

            <div class="mt-4">
              <InputLabel for="description" value="Description" />
              <Input
                id="description"
                type="text"
                class="mt-1 block w-full"
                v-model="form.description"
                autocomplete="description"
              />
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