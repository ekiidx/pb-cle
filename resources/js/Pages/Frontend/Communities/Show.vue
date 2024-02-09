<script setup>
import Guest from "@/Layouts/Guest.vue";
import { Link, Head } from "@inertiajs/vue3";
import PostCard from "@/Components/PostCard.vue";
import Pagination from "@/Components/Pagination.vue";
import CommunityList from "@/Components/CommunityList.vue";

defineProps({
  	community: Object,
  	posts: Object,
  	communities: Object,
});
</script>

<template>
  	<Guest>
		<Head>
			<title>{{ community.name }}</title>
		</Head>

		<div class="main-container">
			<div class="row g-3">
				<!-- Main Column -->
				<div class="col-lg-8">
					<div
						class="
						mb-3
						flex
						bg-dark
						rounded-lg
						border border-gray-200
						shadow-md
						justify-between
						p-3
						"
					>
						<h2 class="font-semibold text-xl text-white leading-tight">
							<span class="text-electricgreen">/</span><Link :href="route('frontend.communities.show', community.slug)">
								{{ community.name }}
							</Link>
						</h2>
						<Link
							v-if="$page.props.auth.user.username"
							:href="route('communities.posts.create', community.slug)"
							class="px-3 py-2 rounded bg-darkorchid hover:bg-electricgreen text-white"
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
					<div class="mt-4 p-2">
						<Pagination :links="posts.meta.links" />
					</div>
				</div>

				<!-- Side Column -->
				<div class="col-lg-4">
					<div class="border rounded-lg">
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
							About {{ community.name }}
						</h2>
						<p class="bg-dark font-normal text-sm text-grey-300 p-4 rounded-b-lg">{{ community.description }}</p>
					</div>

					<CommunityList class="mt-4" :communities="communities.data">
						<template #title>Latest Communities</template>
					</CommunityList>
				</div>
			</div>
		</div>
	</Guest>
</template>