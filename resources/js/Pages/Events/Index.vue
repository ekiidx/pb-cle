<script setup>
import Guest from "@/Layouts/Guest.vue";
import EventCardIndex from "@/Components/EventCardIndex.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
  events: Object,
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
						mb-3
						flex
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
						
						<!-- <Link
							v-if="$page.props.auth.user.username"
							:href="route('communities.posts.create', community.slug)"
							class="px-3 py-2 rounded bg-darkorchid hover:bg-electricgreen text-white"
							>Create Post</Link
						> -->

					</div>

					<EventCardIndex
						v-for="event in events"
						:event="event"
						:key="event.id"
					/>
				</div>

				<div class="col-lg-4">
					<div class="col-lg-4">
						<!-- <div
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
						Test
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</Guest>
</template>