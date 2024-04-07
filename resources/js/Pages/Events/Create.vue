<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
// import InputLabel from '@/Components/InputLabel.vue';
import { Head, useForm, } from "@inertiajs/vue3";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

const props = defineProps({
  errors: Object,
});

const form = useForm({
    name: "",
    content: "",
    link_tickets: "",
    link_event: "",
    event_date: "",
    event_time: "",
    flyer_front_upload: "",
    flyer_back_upload: ""
});

const submit = () => {
  form.post(route("events.store"));
};
</script>

<template>
  <Head title="Create Event" />

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
                mb-3
                flex
                bg-dark
                rounded-lg
                border border-gray-200
                shadow-md
                p-3
                "
            >
            <h2 class="font-semibold text-xl text-white main-title-text leading-tight"><span class="text-white">Create Event</span>
							<!-- <Link :href="route('frontend.communities.show', community.slug)">
								{{ community.name }}
							</Link> -->
						</h2>
					</div>

          <!-- Post Card -->
          <div class="flex mb-3 bg-dark border rounded-lg text-sm">

            <!-- Main Section -->
            <div style="padding-right: 48px !important" class="w-full py-3 px-3">

              <form @submit.prevent="submit">
                <div>
                  <Label for="name" value="Name" />
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
                    <Label for="event_date" value="Date" />
                    <VueDatePicker 
                        uid="event_date"
                        v-model="form.event_date" 
                        placeholder="Select Date" 
                        no-today
                        required
                        dark
                        :enable-time-picker="false"
                        :min-date="new Date()" />
                </div>

                <div class="mt-4">
                    <Label for="event_time" value="Time" />
                    <VueDatePicker
                        uid="event_time"
                        v-model="form.event_time" 
                        placeholder="Select Time" 
                        time-picker
                        dark
                        required
                        :is-24="false" />
                </div>

                <div class="mt-4">
                  <Label for="link_event" value="Event Link" />
                  <Input
                    id="link"
                    type="url"
                    class="mt-1 block w-full bg-dark text-white"
                    v-model="form.link_event"
                    autocomplete="link_event"
                  />
                  <InputError :message="errors.link_event" />
                </div>

                <div class="mt-4">
                  <Label for="link_tickets" value="Tickets Link" />
                  <Input
                    id="link"
                    type="url"
                    class="mt-1 block w-full bg-dark text-white"
                    v-model="form.link_tickets"
                    autocomplete="link_tickets"
                  />
                  <InputError :message="errors.link_tickets" />
                </div>

                <div class="mt-4">
                  <Label for="content" value="Info" />
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

                <div class="mt-4">
                  <Label for="flyer_front_upload" value="Flyer Front" />
                    <input style="display:block" name="flyer_front_upload" type="file" @input="form.flyer_front_upload = $event.target.files[0]" />
                    <InputError :message="errors.flyer_front_upload" />
                </div>

                <div class="mt-4">
                  <Label for="flyer_back_upload" value="Flyer Back" />
                    <input style="display:block" name="flyer_back_upload" type="file" @input="form.flyer_back_upload = $event.target.files[0]" />
                    <InputError :message="errors.flyer_back_upload" />
                </div>

                <div class="flex items-center justify-end mt-4">
                  <Button
                    class="ml-4"
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
              text-lg
              p-6
              bg-darkorchid
              rounded-lg
              text-white
              p-3
            "
            >
              About
            </h2>
              <p class="bg-dark font-normal text-sm text-grey-300 p-4 rounded-b-lg">Create an event.</p>
          </div>
				</div>
      </div>
    </div>
  </AppLayout>
</template>