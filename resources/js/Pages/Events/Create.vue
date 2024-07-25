<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import InputError from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
// import InputLabel from '@/Components/InputLabel.vue';
import { ref } from 'vue';
import { Head, useForm } from "@inertiajs/vue3";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import Multiselect from '@vueform/multiselect';

const props = defineProps({
  errors: Object,
});

// Event time
const startTime = ref({ hours: 20, minutes: 0 });

//Genres
const options = [
    { label: '2 step', value: '1' },
    { label: 'breakbeat hardcore', value: '2' },
    { label: 'breakcore', value: '3' },
    { label: 'breaks', value: '4'},
    { label: 'drum n bass', value: '5' },
    { label: 'dubstep', value: '6' },
    { label: 'electro house', value: '7' },
    { label: 'gabber', value: '8' },
    { label: 'garage', value: '9'},
    { label: 'happy hardcore', value: '10' },
    { label: 'hardcore', value: '11' },
    { label: 'hardstyle', value: '12' },
    { label: 'hard dance', value: '13' },
    { label: 'house', value: '14' },
    { label: 'jungle', value: '15' },
    { label: 'lofi', value: '16' },
    { label: 'psytrance', value: '17' },
    { label: 'speedcore', value: '18' },
    { label: 'speed garage', value: '19' },
    { label: 'techno', value: '20' },
    { label: 'trance', value: '21' },
    { label: 'trap', value: '22' },
    { label: 'uk hardcore', value: '23' },
    { label: 'uk hardcore', value: '24' },
]

const form = useForm({
    name: "",
    content: "",
    link_tickets: "",
    link_event: "",
    event_date: "",
    event_time: "",
    genre_values: [],
    flyer_front: "",
    flyer_back: ""
});

function flyerFrontPreview() {
  flyerFrontFrame.src=URL.createObjectURL(event.target.files[0])
}

function flyerBackPreview() {
  flyerBackFrame.src=URL.createObjectURL(event.target.files[0])
}

const submit = () => {
  form.post(route("events.store"));
};
</script>

<template>
  <Head title="Create Event" />

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
            <h2 class="font-semibold text-xl text-white main-title-text leading-tight"><span class="text-white">/Events</span>
							<!-- <Link :href="route('frontend.communities.show', community.slug)">
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
                    <!-- <VueDatePicker 
                        uid="event_date"
                        v-model="form.event_date" 
                        placeholder="Select Date"
                        auto-apply
                        required
                        dark
                        timezone="UTC"
                        :enable-time-picker="false"
                    /> -->
                    <input 
                      type="date"
                      style="width: 100% !important;"
                      v-model="form.event_date"
                    />
                  <InputError :message="errors.event_date" />
                </div>

                <div class="mt-4">
                    <Label for="event_time" value="Time" />
                    <VueDatePicker
                        uid="event_time"
                        v-model="form.event_time"
                        placeholder="Select Time" 
                        time-picker
                        model-type="hh:mm a"
                        :start-time="startTime"
                        dark
                        required
                        :is-24="false" />
                    <!-- <input 
                        type="time"
                        style="width: 100% !important;"
                        placeholder="8:00 PM"
                        v-model="form.event_time"
                    /> -->
                  <InputError :message="errors.event_time" />
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

                <!-- Info -->
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

                <!-- Genres -->
                <div class="mt-4 mb-4">
                  <Label for="genres" value="Genres" />
                  <Multiselect 
                    id="genres"
                    v-model="form.genre_values" 
                    mode="tags"
                    :close-on-select="false"
                    :searchable="true"
                    :create-option="false"
                    :object="true"
                    :options="options"
                ></Multiselect>
                </div>

                <!-- Flyer Upload -->
                <div class="mb-4">
                  <div class="mb-2">
                    <Label class="mb-1" for="flyer_front" value="Flyer Front" />
                      <img 
                        style="max-width: 7rem; max-height: 5rem; height: auto;" 
                        id="flyerFrontFrame"
                        src="">
                        <InputError :message="errors.flyer_front" />
                      <input style="display:block" name="flyer_front" type="file" @input="form.flyer_front = $event.target.files[0]" @change="flyerFrontPreview()" />
                  </div>

                  <div style="margin-bottom: 2rem;">
                    <Label class="mb-1" for="flyer_back" value="Flyer Back" />
                      <img 
                        style="max-width: 7rem; max-height: 5rem; height: auto;" 
                        id="flyerBackFrame"
                        src="">
                        <InputError :message="errors.flyer_back" />
                      <input style="display:block" name="flyer_back" type="file" @input="form.flyer_back = $event.target.files[0]" @change="flyerBackPreview()" />
                  </div>
                </div>

                <div class="mb-2">
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
							<img class="d-inline" style="max-height: 1.1rem; max-width: 1.25rem; margin-right: 0.35rem; padding-bottom: 0.23rem" src="/assets/img/about.svg">
							<h2
							class="
								font-semibold
								text-lg
								text-white
								d-inline
							  "
							>
                Create Event
              </h2>
            </div>
            <p class="bg-dark font-normal text-sm text-grey-300 p-3 rounded-b-lg">Use this screen to create an event.</p>
          </div>
				</div>
      </div>
    </div>
  </AppLayout>
</template>

<style src="@vueform/multiselect/themes/default.css"></style>