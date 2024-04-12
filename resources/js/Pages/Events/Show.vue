<script setup>
import Guest from "@/Layouts/Guest.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
 	event: Object,
  	can_delete: Boolean,
	can_update: Boolean,
	new: Boolean,
});
</script>


<template>
    <Guest>
        <Head>
            <title>{{ $page.props.event.name }}</title>
        </Head>

        <div class="main-container">
          	<div class="row g-3">
            	<div class="col-lg-8">
					<div
						class="
						header-post-box
						flex
						bg-dark
						rounded-lg
						border border-gray-200
						shadow-md
						justify-between
						p-3
						"
					>
						<h2 class="font-semibold text-xl text-white main-title-text leading-tight">
							/<Link :href="route('events.index')">Events</Link>
						</h2>
						<!-- <Link
							v-if="$page.props.auth.user.username"
							:href="route('events.create')"
							class="px-3 py-2 rounded bg-darkorchid hover:bg-electricgreen text-white"
							>Create Event</Link
						> -->
					</div>

					<div
						class="
						mb-3
						flex
						bg-dark
						rounded-lg
						border border-gray-200
						shadow-md
						"
					>
						<div class="w-full" style="padding-right: 48px !important;">
							<!-- Flex -->
							<div class="px-3 py-3">
								<div class="post-flex mb-4 text-sm">
									Posted by
									<a :href="'/ravers/'+event.user.slug"><span class="font-semibold mx-1 text-darkorchid">{{ event.user.username }}</span></a>
									<span class="mr-3">{{ event.created_at_diff }}</span>

									<p class="mr-3" v-if="props.new" style="color:yellow">NEW</p>
									{{ props.carbon_now }}

									
										<Link v-if="can_update"
											:href="
											route('events.edit', [
												event.slug,
											])
											"
											class="
											font-semibold
											text-electricgreen
											mr-2
											"
											>Edit</Link
										>
										<Link v-if="can_delete"
											:href="
											route('events.destroy', [
												event.slug,
											])
											"
											class="
											font-semibold
											text-darkorchid
											"
											method="delete"
											as="button"
											type="button"
											onclick="return confirm('Are you sure you wish to delete this event?')"
											>Delete</Link
										>
									
								</div>
							
								<h1 class="font-semibold text-2xl text-white mb-4">{{ event.name }}</h1>
								<!-- <p class="mb-4">Hosted by {{ event.user.username }}</p> -->
							
								<div class="mb-4">
									<img style="width: 100%; max-width: 40rem; height: auto;" v-if="event.flyer_front_upload" class="" :src="'/storage/flyers/'+event.flyer_front_upload">
									<img style="width: 100%; max-width: 40rem; height: auto;" v-if="event.flyer_back_upload" class="" :src="'/storage/flyers/'+event.flyer_back_upload">
								</div>

								<div class="mb-2">
									<p class="text-gray-300 break-words whitespace-pre-wrap">{{ event.content }}</p>
								</div>
							</div>
						</div>
					</div>
				</div>

            	<div class="col-lg-4">
					<div
						class="
						mb-3
						pb-2
						bg-dark
						rounded-lg
						border border-gray-200
						shadow-md
						"
					>
						<table class="event-info-table">
							<tr>
								<td class="px-3 pt-3 pb-2"><p class="text-white font-bold">Date</p></td>
								<td class="px-3 pt-3 pb-2"><p class="text-white">{{ event.weekday_format }} {{ event.party_date }}</p></td>
							</tr>
								
							<tr v-if="event.link_event">
								<td class="px-3 pb-2"><p class="text-white font-bold">Link</p></td>
								<td class="px-3 pb-2"><p class="text-white"><a :href="event.link_event">Click Here</a></p></td>
							</tr>

							<tr v-if="event.link_tickets">
								<td class="px-3 pb-2"><p class="text-white font-bold">Tickets</p></td>
								<td class="px-3 pb-2"><p class="text-white"><a :href="event.link_tickets">Click Here</a></p></td>
							</tr>
						</table>
					</div>
            	</div>
            	<!-- {{ $page.props.event }} -->
          	</div>
     
        </div>
  	</Guest>
</template>

