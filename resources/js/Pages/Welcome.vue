<script setup>
import Guest from '@/Layouts/Guest.vue';
import PostCard from "@/Components/PostCard.vue";
import CommunityList from "@/Components/CommunityList.vue";
import EventList from "@/Components/EventList.vue";
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
            <div class="row">
                <div class="col-lg-8">
                    <PostCard
                        v-for="post in posts.data"
                        :post="post"
                        :community="post.community_slug"
                        :key="post.id"
                    />
                </div>

                <div class="col-lg-4">
                    <CommunityList :communities="communities.data">
                        <template #title>Top communities</template>
                    </CommunityList>

                    <EventList :events="events">
                    <template #title>Events</template>
                    </EventList>
                </div>
            </div>
        </div>
    </Guest>
</template>