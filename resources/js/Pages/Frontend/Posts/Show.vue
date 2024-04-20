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
   	<div class="main-container">
 
			<Head>
				<title>{{ community.name }} - {{ post.data.title }}</title>
			</Head>

			<div class="row g-3">

				<!-- Main Column -->
				<div class="col-lg-8">

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
						<h2 class="font-semibold text-xl text-white main-title-text leading-tight"><span class="text-white">/</span>
							<Link :href="route('frontend.communities.show', community.slug)">
								{{ community.name }}
							</Link>
						</h2>
					</div>
					
					<!-- Post Card -->
					<div class="flex mb-3 bg-dark border rounded-lg text-sm">

						<!-- Vote -->
						<div>
							<PostVote :post="post.data" />
						</div>

						<!-- Main Section -->
						<div style="padding-right: 48px !important" class="w-full">
							<div class="flex flex-col sm:flex-row py-3 px-3">
								<div class="mr-3">
									<!-- Posted by -->
									<a :href="'/ravers/'+post.data.user_slug">
									<span class="font-semibold mr-1 text-darkorchid">
										{{ post.data.username }}
									</span></a>
									
									{{ post.data.created_at }}
								</div>

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

							<!-- Edit and Delete -->
							</div>
							
							<!-- Title -->
							<h1 class="pl-4 pr-3 mb-2 font-bold tracking-tight text-white whitespace-break-spaces post-title">
								{{ post.data.title }}
							</h1>

							<!-- Title -->
							<p class="text-gray-300 px-3 pt-2 whitespace-pre-wrap break-words">{{ post.data.description }}</p>
							
							<!-- Link -->
							<div class="px-3 py-2 mb-3">
								<a
									:href="post.data.url"
									class="font-semibold text-electricgreen text-sm break-words"
									>{{ post.data.url }}</a
								>
							</div >

							<hr />

							<!-- Comments -->
							<div class="px-3 pt-4 mb-5">
								<ul role="list" class="">
									<li
										v-for="(comment, index) in post.data.comments"
										:key="index"
										class="flex flex-col"
									>
										<div class="text-sm">
											<!-- Commented by -->
											<a :href="'/ravers/'+comment.user_slug">
											<span class="font-semibold text-darkorchid">{{
												comment.username
											}}</span></a>
										</div>
										<div class="text-gray-300 pt-2 pb-3 whitespace-pre-wrap break-words">
											{{ comment.content }}
										</div>
									</li>
								</ul>
							</div>
						
							<!-- Textarea -->
							<div v-if="$page.props.auth.user.username">
								<form class="max-w-md" @submit.prevent="submit">
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
										"
										>
										Comment
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			
				<div class="col-lg-4">
					<div class="border rounded-lg mb-3 bg-dark">
						<div class="bg-darkorchid rounded-lg p-3">
							<img class="d-inline" style="max-height: 1.3rem; max-width: 1.45rem; margin-right: 0.35rem; padding-bottom: 0.23rem" src="/assets/img/about.svg">
							<h2
							class="
								font-semibold
								text-lg
								text-white
								d-inline
							"
							>
								About {{ community.name }}
							</h2>
						</div>
						<p class="bg-dark font-normal text-sm text-grey-300 p-4 rounded-b-lg">{{ community.description }}</p>
					</div>
					
					<PostList :posts="posts.data" :community="community">
						<template #title>Popular Posts</template>
					</PostList>
				</div>
			</div>
    	</div>
  	</Guest>
</template>
