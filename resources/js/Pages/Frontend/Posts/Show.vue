<script setup>
import Guest from "@/Layouts/Guest.vue";
import { Link, useForm, Head } from "@inertiajs/vue3";
import PostVote from "@/Components/PostVote.vue";
import PostList from "@/Components/PostList.vue";

const props = defineProps({
	community: Object,
	post: Object,
	posts: Object,
	can_delete: Boolean,
	can_update: Boolean
});

const form = useForm({
  content: "",
});

const submit = () => {
  form.post(
    route("frontend.posts.comments", [
      props.community.slug,
      props.post.data.slug,
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
			<title>{{ community.name }} - {{ post.data.title }}</title>
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
						justify-between
						p-3
						"
					>
						<h2 class="font-semibold text-xl text-white main-title-text leading-tight">
							<span class="text-white">/</span>
							<Link :href="route('frontend.communities.show', community.slug)">
								{{ community.name }}
							</Link>
						</h2>
						<Link
							:href="route('communities.posts.create', community.slug)"
							class="comment-btn items-center border-transparent bg-darkorchid fw-600 text-white font-xsss text-center lh-20 rounded-xl"
							>Create Post</Link
						>
					</div>
					
					<!-- Post Card -->
					<div 
						class="
						post-main-container
						flex
						bg-dark
						border
						rounded-lg
						text-sm
						"
					>

						<!-- Vote -->
						<div>
							<PostVote :post="post.data" />
						</div>

						<!-- Main Section -->
						<div class="w-full">

							<!-- Header -->
							<div class="flex flex-wrap post-header text-sm">
								<!-- Posted by -->
								<a :href="'/ravers/'+post.data.user_slug">
								<span class="font-semibold mr-1 text-darkorchid">
									{{ post.data.username }}
								</span></a>
								<span class="mr-2">
									{{ post.data.created_at }}
								</span>
									
								<div v-if="$page.props.auth.auth_check">
									<Link v-if="can_update"
										:href="
										route('communities.posts.edit', [
											community.slug,
											post.data.slug,
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
										route('communities.posts.destroy', [
											community.slug,
											post.data.slug,
										])
										"
										class="
										font-semibold
										text-darkorchid
										"
										method="delete"
										as="button"
										type="button"
										onclick="return confirm('Are you sure you wish to delete this post?')"
										>Delete</Link
									>
								</div>
							</div>

							<!-- <div style="padding-right: 48px !important;"> -->
								<!-- Title -->
								<h1 class="pl-4 pr-4 mb-2 font-bold tracking-tight text-white post-title" style="white-space: pre-wrap; word-wrap: break-word; overflow-wrap: anywhere;">
									{{ post.data.title }}
								</h1>

								<!-- Description -->
								<p class="text-gray-300 px-3 pt-2" style="white-space: pre-wrap; word-wrap: break-word; overflow-wrap: anywhere;">{{ post.data.description }}</p>
								
								<!-- Link -->
								<div class="px-3 py-2 mb-3">
									<a
										:href="post.data.url"
										class="font-semibold text-electricgreen text-sm break-words"
										style="white-space: pre-wrap; word-wrap: break-word; overflow-wrap: anywhere;"
										>{{ post.data.url }}</a
									>
								</div>
							<!-- </div> -->

							<!-- Image -->
							<a v-if="post.data.post_image" :href="'/storage/post-images/'+ post.data.post_image">
                    			<img v-if="post.data.post_image" class="mb-3" style="max-width: 100%; height: auto;" :src="'/storage/post-images/'+post.data.post_image">
                			</a>

							<!-- Divider -->
							<!-- <div style="padding-right: 48px !important;"> -->
								<!-- <div class="px-3" v-if="post.data.comments != 0">
									<hr />
								</div> -->
								
								<!-- Comments -->
								<div v-if="post.data.comments != 0" class="px-3 mb-3">
									<ul role="list">
										<li
											v-for="(comment, index) in post.data.comments"
											:key="index"
											class="flex flex-col"
										>
											<div class="text-sm">
												<!-- Commented by -->
												<a :href="'/ravers/'+comment.user_slug">
												<span class="font-semibold text-darkorchid mr-1">{{
													comment.username
												}}</span></a>
												{{ comment.created_at }}
											</div>
											<div class="text-gray-300 pt-2 pb-3 whitespace-pre-wrap break-words">
												{{ comment.content }}
											</div>
										</li>
									</ul>
								</div>
							<!-- </div> -->

							<!-- Textarea -->
							<div v-if="$page.props.auth.user.username">
								<form @submit.prevent="submit">
									<div class="px-3 mb-3">
										<textarea
										v-model="form.content"
										id="comment"
										rows="5"
										class="mt-1 block w-full bg-dark text-white"
										placeholder="Your comment..."
										></textarea>
									</div>
									<div class="px-3 mb-3">
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
								About {{ community.name }}
							</h2>
						</div>
						<p class="bg-dark font-normal text-sm text-grey-300 p-3 rounded-b-lg">{{ community.description }}</p>
					</div>
					
					<PostList :posts="posts.data" :community="community">
						<template #title>Popular Posts</template>
					</PostList>
				</div>
			</div>
    	</div>
  	</Guest>
</template>
