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
			<div class="row gutter">
				<div class="col-lg-8">
					<div
						class="
						header-post-box
						flex
						items-center
						justify-between
						bg-dark
						rounded-lg
						border border-gray-200
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
					<div class="pagination-container">
						<Pagination :links="events.links" />
					</div>
				</div>

				<!-- Sidebar -->
				<div class="col-lg-4">
					<div class="about-box border rounded-lg">
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
								About Communities
							</h2>
						</div>
						<p class="bg-dark font-normal text-sm text-grey-300 p-3 rounded-b-lg">Rad <span class="text-electricgreen font-bold">local events</span> are posted here.</p>
					</div>

					<EventSidebar :events="events_sidebar">
                    	<template #title>Hot Events</template>
                    </EventSidebar>
				</div>
			</div>
		</div>
	</Guest>
</template>