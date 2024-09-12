<script setup>
import Guest from "@/Layouts/Guest.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import InputError from "@/Components/InputError.vue";
import EventCommentVote from "@/Components/EventCommentVote.vue";


const props = defineProps({
 	event: Object,
	genres: Object,
	comments: Object,
  	can_delete: Boolean,
	can_update: Boolean,
	new: Boolean,
	is_user: Number,
	errors: Object,
});

const form = useForm({
  content: "",
  comment_image: "",
});

function commentImagePreview() {
  commentImageFrame.src=URL.createObjectURL(event.target.files[0])
}

const submit = () => {
  form.post(
    route("events.comments", [
      props.event.data.slug,
    ]),
    {
      onSuccess: () => form.reset(),
	  preserveScroll: true,
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
						border
						justify-between
						"
					>
						<h2 class="font-semibold text-xl text-white main-title-text leading-tight">
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
						border
						text-sm
						"
					>
						<!-- Main Section -->
						<div class="w-full">
							<div class="post-header flex flex-wrap text-sm">
								<!-- Posted by -->
								<a :href="'/ravers/'+event.data.user_slug">
								<span class="font-semibold mr-1 text-darkorchid">
									{{ event.data.username }}
								</span></a>
								<span class="mr-2">
									{{ event.data.created_at }}
								</span>

								<!-- NEW -->
								<span class="mr-2" v-if="props.new" style="color: yellow; font-weight: 600;">
									NEW
								</span>

								<div v-if="$page.props.auth">
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
								<div v-if="$page.props.auth">
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
							<h1 class="font-bold tracking-tight text-white whitespace-break-spaces post-title" style="margin-bottom: 1rem;">
								{{ event.data.name }}
							</h1>
							<!-- <p class="mb-4">Hosted by {{ event.user.username }}</p> -->

							<!-- Flyer -->
							<div class="mb-4">
								<img style="max-width: 100%; height: auto;" v-if="event.data.flyer_front_upload" class="" :src="'/storage/flyers/'+event.data.flyer_front_upload">
								<img style="max-width: 100%; height: auto;" v-if="event.data.flyer_back_upload" class="" :src="'/storage/flyers/'+event.data.flyer_back_upload">
							</div>

							<!-- Content -->
							<div class="post-content mb-4">
								<p class="text-gray-300 break-words text-sm whitespace-pre-wrap">
									{{ event.data.content }}
								</p>
							</div>

							<!-- Divider -->
							<!-- <div class="px-3" v-if="event.data.event_comments != 0">
								<hr />
							</div> -->

							<!-- Comments -->
							<div class="post-comments">
								<div v-if="props.comments != 0"></div>
								<ul role="list">
									<li
										v-for="comment in props.comments"
										class="flex flex-col mb-3"
									>
										<div class="flex text-sm mb-1">
											<!-- Commented by -->
											<a :href="'/ravers/'+comment.user_slug">
											<span class="font-semibold text-darkorchid mr-1">{{
												comment.username
											}}</span></a>
											{{ comment.created_at_diff }}

											<!-- Edit Comment -->
											<Link
												v-if="comment.user_id === props.is_user"
												:href="
												route('events.comments.edit', [
													event.data.slug,
													comment.id
												])
												"
												class="
												font-semibold
												text-electricgreen
												ml-2
												"
												style="
												font-size: 0.85rem"
												>Edit</Link
											>
										</div>

										<div v-if="comment.content"
											class="whitespace-pre-wrap break-words">
											<p class="text-grey-300 text-sm">{{ comment.content }}</p>
										</div>

										<!-- Image -->
										<a v-if="comment.comment_image" :href="'/storage/comment-images/'+comment.comment_image" class="mt-1">
											<img v-if="comment.comment_image" 
											style="width: 100%; max-width: 400px; height: auto;"
											:src="'/storage/comment-images/'+comment.comment_image">
										</a>

										<div class="mt-1">
											<EventCommentVote :comment="comment" />
										</div>
									</li>
								</ul>
							</div>
							
							<div v-if="$page.props.auth.user">
								<form @submit.prevent="submit">

									<!-- Textarea -->
									<div class="comment-textarea">
										<div class="mt-4">
											<textarea
											v-model="form.content"
											id="comment"
											rows="5"
											class="block w-full bg-dark text-white"
											placeholder="Your comment..."
											></textarea>
										</div>

										<!-- Flyer Upload -->
										<div class="mb-4">
											<img v-if="form.comment_image"
												style="max-width: 7rem; max-height: 5rem; height: auto;"
												class="mt-2"
												id="commentImageFrame"
												src="">
												<InputError :message="errors.comment_image" />
												<label for="comment-image-upload" class="cursor-pointer image-upload-button"><i class="ti-image text-xl"></i></label>
											<input id="comment-image-upload" style="display:none" name="comment_image" type="file" @input="form.comment_image = $event.target.files[0]" @change="commentImagePreview()" hidden />
										</div>
									
										<div class="mb-3">
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
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				<!-- Sidebar -->
            	<div class="col-lg-4">

					<!-- Event Info -->
					<div
						class="
						about-box
						border
						rounded-lg
						bg-dark
						"
					>
						<div class="bg-darkorchid rounded-lg p-3">
							<img class="d-inline" style="max-height: 1.1rem; max-width: 1.25rem; margin-right: 0.35rem; padding-bottom: 0.23rem" src="/assets/img/about.svg">
							<h2
							class="
								font-semibold
								text-white
								d-inline
								"
							>
								Event Info
							</h2>
						</div>
						<div class="event-info-box">
							<table class="event-info-table">
								<tr v-if="event.data.party_date">
									<td class="px-3 pb-2"><p class="text-white font-bold">Date</p></td>
									<td class="px-3 pb-2"><p class="text-white">{{ event.data.weekday_format }} {{ event.data.party_date }}</p></td>
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

					<!-- Genres Box -->
					<div
						v-if="props.genres"
						class="
						about-box
						border
						rounded-lg
						bg-dark
						"
					>
						<div class="bg-darkorchid rounded-lg p-3">
							<img class="d-inline" style="max-height: 1.1rem; max-width: 1.25rem; margin-right: 0.35rem; padding-bottom: 0.23rem" src="/assets/img/about.svg">
							<h2
							class="
								font-semibold
								text-white
								d-inline
								"
							>
								Genres
							</h2>
						</div>
						<div class="p-3">
							<span
								v-for="(genre) in genres"
								class="text-sm text-electricgreen fw-600 login-btn mr-2 mb-2"
								style="display: inline-block"
							>
								{{ genre.label }}
							</span>
						</div>
					</div>
            	</div>
          	</div>
        </div>
  	</Guest>
</template>

