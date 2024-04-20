<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
// import InputLabel from '@/Components/InputLabel.vue';
import { Head, useForm } from "@inertiajs/vue3";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

const props = defineProps({
  event: Object,
  errors: Object,
});

const form = useForm({
    name: props.event?.name,
    content: props.event?.content,
    link_tickets: props.event?.link_tickets,
    link_event: props.event?.link_event,
    event_date: props.event?.event_date,
    event_time: props.event?.event_time,
    flyer_front_upload: props.event?.flyer_front_upload,
    flyer_back_upload: props.event?.flyer_back_upload,
});

const submit = () => {
  form.post(
    route("events.update", [props.event.slug])
    );
};
</script>

<template>
  <Head title="Edit Event" />

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
            <h2 class="font-semibold text-xl text-white main-title-text leading-tight"><span class="text-white">/Events</span>
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
                        auto-apply
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
                        model-type="hh:mm a"
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

                <div class="mt-4 mb-4">
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

                <div class="mb-2">
                  <Label class="mb-1" for="flyer_front_upload" value="Flyer Front" />
                    <img 
                      v-if="event.flyer_front_upload" 
                      class="rounded-sm pb-3" 
                      style="max-width: 7rem; max-height: 5rem; height: auto;" 
                      :src="'/storage/flyers/'+event.flyer_front_upload">
                    <input style="display:block" name="flyer_front_upload" type="file" @input="form.flyer_front_upload = $event.target.files[0]" />
                    <InputError :message="errors.flyer_front_upload" />
                </div>

                <div style="margin-bottom: 2rem;">
                  <Label class="mb-1" for="flyer_back_upload" value="Flyer Back" />
                    <img v-if="event.flyer_back_upload" class="rounded-sm pb-3" style="max-width: 7rem; max-height: 5rem; height: auto;" :src="'/storage/flyers/'+event.flyer_back_upload">
                    <input style="display:block" name="flyer_back_upload" type="file" @input="form.flyer_back_upload = $event.target.files[0]" />
                    <InputError :message="errors.flyer_back_upload" />
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
            <div class="bg-darkorchid rounded-lg p-3">
              <img class="d-inline" style="max-height: 1.2rem; margin-right: 0.35rem; padding-bottom: 0.23rem" src="/assets/img/edit.svg">
              <h2
              class="
                font-semibold
                text-lg
                text-white
                d-inline
              "
              >
                Edit Event
              </h2>
            </div>
            <p class="bg-dark font-normal text-sm text-grey-300 p-4 rounded-b-lg">You can use this screen to edit your event.</p>
          </div>
		    </div>
      </div>
    </div>
  </AppLayout>
</template>