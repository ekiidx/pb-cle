<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
// import CommunityList from "@/Components/CommunityList.vue";
// import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    user: Object,
    notifications: Object,
});
</script>

<template>
	<Head title="Notifications" />

	<AppLayout>
		<div class="main-container">
			<div class="row gutter">
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
							<h2 class="font-semibold text-xl text-white leading-tight">
								Notifications
							</h2>
					</div>
                    <div
                        class="
                        mb-2
                        flex
                        bg-dark
                        rounded-lg
                        border border-gray-200
                        "
                    >
						<div class="py-2 w-full">
							
							<ul v-if="notifications != 0" role="list">
								<li
									v-for="(notification, index) in props.notifications"
									:key="index"
									class="px-3 mb-2 pt-2 text-sm break-words whitespace-pre-wrap"
								>
									<a class="font-bold text-darkorchid mr-2" :href="/ravers/+notification.user.slug">{{ notification.username }}</a>

									<span class="text-sm text-grey-300 mr-1">{{ notification.message }}</span>

									<!-- Create Post -->
									<a v-if="notification.type == 'post_create'" class="font-bold" :href="/communities/+notification.community_slug+/posts/+notification.post_slug">{{ notification.post_title }}</a>

									<!-- Post Vote -->
									<a v-if="notification.type == 'post_vote'" class="font-bold" :href="/communities/+notification.community_slug+/posts/+notification.post_slug">{{ notification.post_title }}</a>

									<!-- Post Comment -->
									<a v-if="notification.type == 'post_comment'" class="font-bold" :href="/communities/+notification.community_slug+/posts/+notification.post_slug">{{ notification.post_title }}</a>

									<!-- Comment Vote -->
									<a v-if="notification.type == 'comment_vote'" class="font-bold" :href="/communities/+notification.community_slug+/posts/+notification.post_slug">{{ notification.post_title }}</a>

									<!-- Event Comment -->
									<a v-if="notification.type == 'event_comment'" class="font-bold" :href="/events/+notification.event_slug">{{ notification.event_name }}</a>

									<!--Event Comment Vote -->
									<a v-if="notification.type == 'event_comment_vote'" class="font-bold" :href="/events/+notification.event_slug">{{ notification.event_name }}</a>

									<!-- Created at -->
									 <span class="ml-2">{{ notification.created_at_diff }}</span>
								</li>
							</ul>

							<p v-else
								class="text-sm text-grey-300 p-3">There are no notifications. 🙁</p>


						</div>
                    </div>
				</div>

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
								About Notifications
							</h2>
						</div>
						<p class="bg-dark font-normal text-sm text-grey-300 p-3 rounded-b-lg">A list of your <span class="font-bold text-electricgreen">lovely</span> notifications.</p>
					</div>

					<!-- <CommunityList :communities="communities.data">
                        <template #title>Top Communities</template>
                    </CommunityList> -->
				</div>
			</div>
		</div>
	</AppLayout>
</template>

