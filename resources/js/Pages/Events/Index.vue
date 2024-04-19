<script setup>
import Guest from "@/Layouts/Guest.vue";
import EventCardIndex from "@/Components/EventCardIndex.vue";
import EventSidebar from "@/Components/EventSidebar.vue";
import Pagination from "@/Components/Pagination.vue";
import { Link, Head } from "@inertiajs/vue3";

const props = defineProps({
  events: Object,
  events_sidebar: Object,
});
</script>

<template>
    <Guest>
      	<Head title="Events" />

		<div class="main-container">
			<div class="row g-3">
				<div class="col-lg-8">
					<div
						class="
						header-post-box
						flex
						justify-between
						bg-dark
						rounded-lg
						border border-gray-200
						shadow-md
						p-3
						"
					>
			
						<h2 class="font-semibold text-xl text-white leading-tight">
							/Events
						</h2>					
						<Link
							:href="route('events.create')"
							class="comment-btn items-center border-transparent bg-darkorchid fw-600 text-white font-xsss text-center lh-20 rounded-xl"
							>Create Event</Link
						>
					</div>

					<EventCardIndex
						v-for="event in events.data"
						:event="event"
						:key="event.id"
					/>

					<!-- Pagination -->
					<div class="mt-3 mb-3">
						<Pagination :links="events.links" />
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
							About Events
						</h2>
						<p class="bg-dark font-normal text-sm text-grey-300 p-4 rounded-b-lg">Rad <span class="text-electricgreen font-bold">local events</span> are posted here.</p>
					</div>

					<EventSidebar :events="events_sidebar">
                    	<template #title>Hot Events</template>
                    </EventSidebar>
				</div>
			</div>
		</div>
	</Guest>
</template>