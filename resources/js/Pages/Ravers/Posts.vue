<script setup>
import Guest from '@/Layouts/Guest.vue';
import PostCard from "@/Components/PostCard.vue";
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
            <title>Posts</title>
        </Head>

        <div class="main-container">
            <div class="row gutter">
                
				<div class="col-lg-8"></div>

                <div class="col-lg-4 raver-profile-row">
                    <div
						class="
						mb-3
						flex
						bg-dark
						rounded-lg
						border
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
                            <div><span class="text-electricgreen text-sm fw-600 inline-block mr-1">{{ post_count }}</span> <span class="inline-block text-sm">Posts</span></div>
                            <div><span class="text-electricgreen text-sm fw-600 inline-block mr-1">{{ event_count }}</span> <span class="inline-block text-sm">Events</span></div>
                            <div><span class="text-electricgreen text-sm fw-600 inline-block mr-1">{{ follower_count }}</span> <span class="inline-block text-sm">Followers</span></div>
                            <div><span class="text-electricgreen text-sm fw-600 inline-block mr-1">{{ following_count }}</span> <span class="inline-block text-sm">Following</span></div>
                        </div>
                    </div>
				</div>
            </div>
        </div>
    </Guest>
</template>