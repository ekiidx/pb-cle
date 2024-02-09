<script setup>
import Guest from '@/Layouts/Guest.vue';
import PostCard from "@/Components/PostCard.vue";
import RaverCardIndex from "@/Components/RaverCardIndex.vue";
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
    posts: Object,
    events: Object
});
</script>

<template>
    <Guest>
        <Head>
            <title>{{ $page.props.user.username }}</title>
        </Head>

        <div class="main-container">
            <div class="row g-3">
                
				<div class="col-lg-8">
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

                        <h2 style="color: #ffffff;">Latest Posts</h2>
                    </div> -->
                    <PostCard
                        v-for="post in posts.data"
                        :post="post"
                        :community="post.community_slug"
                        :key="post.id"
                    />
                    <!-- <h2 style="color: #ffffff;">Latest Events</h2> -->
					<!-- <RaverCardIndex
						v-for="event in events"
						:event="event"
						:key="event.id"
					/> -->
				</div>

				<div class="col-lg-4">
                    <div
						class="
						mb-3
						flex
						bg-dark
						rounded-lg
						border border-gray-200
						shadow-md
                        p-3
                        flex-col
						"
					>
                        <img class="profile-img rounded-full object-cover" :src="$page.props.user.profile_photo_url">
                        <h1 class="text-bold text-white">{{ user.username }}</h1>
                    </div>
				</div>
            </div>
        </div>
    </Guest>
</template>