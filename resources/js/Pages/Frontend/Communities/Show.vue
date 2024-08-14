<script setup>
import Guest from "@/Layouts/Guest.vue";
import { Link, Head } from "@inertiajs/vue3";
import PostCard from "@/Components/PostCard.vue";
import Pagination from "@/Components/Pagination.vue";
import CommunityList from "@/Components/CommunityList.vue";

defineProps({
  	community: Object,
  	posts: Object,
  	communities: Object
});
</script>

<template>
  <Guest>
		<Head>
			<title>{{ community.name }}</title>
		</Head>

		<div class="main-container communities-show">
			<div class="row gutter">

				<!-- Main Column -->
				<div class="col-lg-8">

					<!-- Header -->
					<div
						class="
						header-post-box
						flex
						items-center
						bg-dark
						rounded-lg
						border border-gray-200
						justify-between
						"
					>
						<h2 class="font-semibold text-xl text-white main-title-text leading-tight">
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
					<PostCard
						v-for="post in posts.data"
						:post="post"
						:community="community.slug"
						:key="post.id"
					/>

					<!-- Pagination -->
					<div class="pagination-container">
						<Pagination :links="posts.meta.links" />
					</div>
				</div>

				<!-- Side Column -->
				<div class="col-lg-4">
					<div class="about-box border rounded-lg bg-dark">
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

					<CommunityList :communities="communities.data">
						<template #title>Latest Communities</template>
					</CommunityList>
				</div>
			</div>
		</div>
	</Guest>
</template>