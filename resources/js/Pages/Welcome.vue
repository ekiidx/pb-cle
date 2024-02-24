<script setup>
import Guest from '@/Layouts/Guest.vue';
import PostCard from "@/Components/PostCard.vue";
import CommunityList from "@/Components/CommunityList.vue";
import EventSidebar from "@/Components/EventSidebar.vue";
// import EventCard from "@/Components/EventCard.vue";
import { Head } from '@inertiajs/vue3';

defineProps({
    communities: Object,
    posts: Object,
    events: Object,
});
</script>

<template>
    <Guest>
        <Head title="Home" />

        <div class="main-container">
            <div class="row g-3">
                
                <div class="col-lg-8">
                    <PostCard
                        v-for="post in posts.data"
                        :post="post"
                        :community="post.community_slug"
                        :key="post.id"
                    />
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
						"
					>

					    <h2 class="p-3 text-white">Welcome to <span class="text-darkorchid font-bold">Pb-cle.org</span></h2>
					</div>


                    <CommunityList :communities="communities.data">
                        <template #title>Top Communities</template>
                    </CommunityList>

                    <EventSidebar :events="events">
                    <template #title>Hot Events</template>
                    </EventSidebar>
                </div>
            </div>
        </div>
    </Guest>
</template>