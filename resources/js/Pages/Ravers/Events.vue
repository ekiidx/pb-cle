<script setup>
import Guest from '@/Layouts/Guest.vue';
import EventCardIndex from "@/Components/EventCardIndex.vue";
import Pagination from "@/Components/Pagination.vue";
// import RaverCardIndex from "@/Components/RaverCardIndex.vue";
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
    posts: Object,
    events: Object,
    post_count: Number,
    event_count: Number,
    follower_count: Number,
    following_count: Number,
    follow_check: Boolean,
    unfollow_check: Boolean
});
</script>

<template>
    <Guest>
        <Head>
            <title>{{ props.user.username }} - Events</title>
        </Head>

        <div class="main-container profile-show">
            <div class="row g-lg-3">
                
				<div class="col-lg-8 order-2 order-lg-1">

                    <EventCardIndex
						v-for="event in events.data"
						:event="event"
						:key="event.id"
					/>

					<!-- Pagination -->
					<div class="mt-3 pagination-container">
						<Pagination :links="events.links" />
					</div>
                </div>

                <div class="col-lg-4 raver-profile-row order-1 order-lg-2">
                    <div
						class="
						flex
						bg-dark
						rounded-lg
						border border-gray-200
						shadow-md
                        p-3
                        flex-col
						"
					>
                        <img style="width: 4.5rem; height: 4.5rem" class="rounded-full object-cover mb-2" :src="$page.props.user.profile_photo_url">
                        <h1 style="font-size: 1.25rem; font-weight: 600;" class="text-bold text-white mb-3">{{ user.username }}</h1>

                        <Link
                            v-if="props.follow_check"
                            :href="route('ravers.follow', user)"
                            :user="user.id"
                            method="post"
                            as="button"
                            type="button"
                            style="width: 6rem"
                            class="register-btn d-inline-block items-center border-transparent bg-darkorchid fw-600 text-white font-xsss text-center lh-20 rounded-xl mb-3"
                            preserve-scroll
                        >Follow</Link>

                        <Link
                        v-if="props.unfollow_check"
                            :href="route('ravers.unfollow', user)"
                            :user="user.id"
                            method="post"
                            as="button"
                            type="button"
                            style="width: 6rem"
                            class="register-btn d-inline-block items-center border-transparent bg-darkorchid fw-600 text-white font-xsss text-center lh-20 rounded-xl mb-3"
                            preserve-scroll
                        >Unfollow</Link>

                        <div class="flex flex-col">
                            <div><Link
                                    :href="route('ravers.show', user)"
                                    class="text-electricgreen text-sm fw-600 inline-block mr-2"
                                >
                                    {{ post_count }}
                                </Link>
                                <span class="inline-block text-sm">Posts</span></div>
                        
                            <div><Link
                                :href="route('ravers.events', user)"
                                class="text-electricgreen text-sm fw-600 inline-block mr-2"
                                >
                                    {{ event_count }}
                                </Link>
                                <span class="inline-block text-sm">Events</span></div>

                            <div><Link
                                :href="route('ravers.followers', user)"
                                class="text-electricgreen text-sm fw-600 inline-block mr-2"
                                >
                                    {{ follower_count }}
                                </Link>
                                <span class="inline-block text-sm">Followers</span></div>

                            <div><Link
                                :href="route('ravers.following', user)"
                                class="text-electricgreen text-sm fw-600 inline-block mr-2"
                                >
                                    {{ following_count }}
                                </Link>
                                <span class="inline-block text-sm">Following</span></div>
                        </div>
                    </div>
				</div>
            </div>
        </div>
    </Guest>
</template>