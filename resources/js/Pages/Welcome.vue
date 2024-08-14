<script setup>
import Guest from '@/Layouts/Guest.vue';
import PostCard from "@/Components/PostCard.vue";
import CommunityList from "@/Components/CommunityList.vue";
import EventSidebar from "@/Components/EventSidebar.vue";
import NewRaverList from "@/Components/NewRaverList.vue";
import { Head } from '@inertiajs/vue3';

defineProps({
    communities: Object,
    posts: Object,
    events: Object,
	users: Object
});
</script>

<template>
  <Guest>
		<Head title="Home" />

		<div class="main-container home-page">
			<div class="row gutter">
							
				<div class="col-lg-8 order-2 order-lg-1">
					<PostCard
						v-for="post in posts.data"
						:post="post"
						:community="post.community_slug"
						:key="post.id"
					/>
				</div>

				<div class="col-lg-4 order-1 order-lg-2">
					<div
						class="
						welcome-box
						bg-dark
						rounded-lg
						border border-gray-200
						"
					>
						<i style="margin-right: 0.6rem" class="feather-zap font-sm text-electricgreen d-inline"></i>
						<h2 class="text-white mb-3 d-inline-block">Welcome to <span class="text-darkorchid font-bold hi-cursor">Pb-cle.org</span></h2>
						<p class="font-normal text-sm text-grey-300"><a class="fw-600" href="http://jadedraver.com/index.php?cur=0&rl=1">Pb-cle</a> has historically been known as a local Pittsburgh - Cleveland electronic dance music scene, linked from <a class="fw-600" href="http://hyperreal.org">hyperreal.org</a>. Feel free to post, create events, and upload flyers in and around the pb-cle area.</p>
					</div>

					<CommunityList :communities="communities.data">
						<template #title>Top Communities</template>
					</CommunityList>

					<EventSidebar :events="events">
						<template #title>Hot Events</template>
					</EventSidebar>

					<NewRaverList :users="users">
						<template #title>New Ravers</template>
					</NewRaverList>
				</div>
			</div>
		</div>
	</Guest>
</template>