<script setup>
import Guest from "@/Layouts/Guest.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
 	event: Object,
  	can_delete: Boolean,
	can_update: Boolean,
	new: Boolean
});

const form = useForm({
  content: "",
});

const submit = () => {
  form.post(
    route("events.comments", [
      props.event.data.slug,
    ]),
    {
      onSuccess: () => form.reset("content"),
    }
  );
};
</script>


<template>
    <Guest>
        <Head>
            <title>{{ event.data.name }}</title>
        </Head>

        <div class="main-container">
          	<div class="row gutter">
				<!-- Main Column -->
            	<div class="col-lg-8">
					<!--- Header -->
					<div
						class="
						header-post-box
						flex
						items-center
						bg-dark
						rounded-lg
						border border-gray-200
						shadow-md
						justify-between
						p-3
						"
					>
						<h2 class="font-semibold text-xl text-white main-title-text leading-tight">
							/
							<Link :href="route('events.index')">Events</Link>
						</h2>
						<Link
							:href="route('events.create')"
							class="comment-btn items-center border-transparent bg-darkorchid fw-600 text-white font-xsss text-center lh-20 rounded-xl"
							>Create Event</Link
						>
						<!-- <Link
							v-if="$page.props.auth.user.username"
							:href="route('events.create')"
							class="px-3 py-2 rounded bg-darkorchid hover:bg-electricgreen text-white"
							>Create Event</Link
						> -->
					</div>

					<!-- Event Card -->
					<div
						class="
						event-main-container
						flex
						bg-dark
						rounded-lg
						border border-gray-200
						"
					>
						<!-- Main Section -->
						<div class="w-full">
							<div class="post-header flex flex-wrap">
								<!-- Posted by -->
								<a :href="'/ravers/'+event.data.user_slug">
								<span class="font-semibold mr-1 text-darkorchid">
									{{ event.data.username }}
								</span></a>
								<span class="mr-2">
									{{ event.data.created_at }}
								</span>

								<!-- NEW -->
								<span class="mr-2" v-if="props.new" style="color:yellow; font-weight: 600; font-size: .85rem; margin-top: 0.165rem; position: relative;">
									NEW
								</span>

								<div v-if="$page.props.auth.auth_check">
									<Link v-if="can_update"
										:href="
										route('events.edit', [
											event.data.slug,
										])
										"
										class="
										font-semibold
										text-electricgreen
										mr-2
										"
										>Edit</Link
									>
								</div>
								<div v-if="$page.props.auth.auth_check">
									<Link v-if="can_delete"
										:href="
										route('events.destroy', [
											event.data.slug,
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
							</div>

							<!-- Title -->
							<h1 class="pl-4 pr-4 mb-4 font-bold tracking-tight text-white whitespace-break-spaces post-title">
								{{ event.data.name }}
							</h1>
							<!-- <p class="mb-4">Hosted by {{ event.user.username }}</p> -->

							
							<!-- Flyer -->
							<div class="mb-4">
								<img style="max-width: 100%; height: auto;" v-if="event.data.flyer_front_upload" class="" :src="'/storage/flyers/'+event.data.flyer_front_upload">
								<img style="max-width: 100%; height: auto;" v-if="event.data.flyer_back_upload" class="" :src="'/storage/flyers/'+event.data.flyer_back_upload">
							</div>

							
							<!-- Content -->
							<div class="pl-4 pr-3 mb-4">
								<p class="text-gray-300 break-words whitespace-pre-wrap">
									{{ event.data.content }}
								</p>
							</div>

							<!-- Divider -->
							<!-- <div class="px-3" v-if="event.data.event_comments != 0">
								<hr />
							</div> -->

							<!-- Comments -->
							<div class="px-3 mb-3">
								<ul role="list">
									<li
										v-for="event_comment in event.data.event_comments"
										class="flex flex-col"
									>
										<div class="text-sm">
											<!-- Commented by -->
											<a :href="'/ravers/'+event_comment.username">
											<span class="font-semibold text-darkorchid mr-1">{{
												event_comment.user_slug
											}}</span></a>
											{{ event_comment.created_at }}
										</div>
										<div class="text-gray-300 pt-2 pb-3 whitespace-pre-wrap break-words">
											{{ event_comment.content }}
										</div>
									</li>
								</ul>
							</div>
						
							<!-- Textarea -->
							<div v-if="$page.props.auth.user">
								<form @submit.prevent="submit">
									<div class="px-3 mb-4">
										<textarea
										v-model="form.content"
										id="comment"
										rows="5"
										class="mt-1 block w-full bg-dark text-white"
										placeholder="Your comment..."
										></textarea>
									</div>
									<div class="pl-4 pr-4 mb-3">
										<button
										class="
											comment-btn
											items-center
											border-transparent
											bg-darkorchid
											fw-600
											text-white
											font-xsss
											text-center
											lh-20
											rounded-xl
										">
											Comment
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				<!-- Sidebar -->
            	<div class="col-lg-4">
					<div
						class="
						about-box
						pb-2
						bg-dark
						rounded-lg
						border border-gray-200
						"
					>
						<table class="event-info-table">
							<tr v-if="event.data.party_date">
								<td class="px-3 pt-3 pb-2"><p class="text-white font-bold">Date</p></td>
								<td class="px-3 pt-3 pb-2"><p class="text-white">{{ event.data.weekday_format }} {{ event.data.party_date }}</p></td>
							</tr>
								
							<tr v-if="event.data.link_event">
								<td class="px-3 pb-2"><p class="text-white font-bold">Link</p></td>
								<td class="px-3 pb-2"><p class="text-white"><a :href="event.data.link_event">Click Here</a></p></td>
							</tr>

							<tr v-if="event.data.link_tickets">
								<td class="px-3 pb-2"><p class="text-white font-bold">Tickets</p></td>
								<td class="px-3 pb-2"><p class="text-white"><a :href="event.data.link_tickets">Click Here</a></p></td>
							</tr>
						</table>
					</div>
            	</div>
          	</div>
        </div>
  	</Guest>
</template>

