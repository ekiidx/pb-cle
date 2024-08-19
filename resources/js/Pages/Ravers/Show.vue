<script setup>
import Guest from '@/Layouts/Guest.vue';
import PostCard from "@/Components/PostCard.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
    posts: Object,
    post_count: Number,
    event_count: Number,
    follower_count: Number,
    following_count: Number,
    plur_points_count: Number,
    follow_check: Boolean,
    unfollow_check: Boolean,
    can_update: Boolean
});
</script>

<template>
    <Guest>
        <Head>
            <title>{{ $page.props.user.username }}</title>
        </Head>

        <div class="main-container profile-show">
            <div class="row gutter">
                
				<div class="col-lg-8 order-2 order-lg-1">

                    <PostCard
                        v-for="post in posts.data"
                        :post="post"
                        :community="post.community_slug"
                        :key="post.id"
                    />
                    <!-- Pagination -->
					<div  
                        v-if="posts.length > 0"
                        class="mt-3 pagination-container">
						<Pagination :links="posts.meta.links" />
					</div>
				</div>

				<div class="col-lg-4 raver-profile-row order-1 order-lg-2">
                    <div
						class="
						flex
						bg-dark
						rounded-lg
						border
                        p-3
                        flex-col
						"
					>
                    <div class="flex justify-between">
                        <div>
                            <img style="width: 4.5rem; height: 4.5rem" class="rounded-full object-cover mb-2" :src="$page.props.user.profile_photo_url">
                            <h1 style="font-size: 1.25rem; font-weight: 600;" class="text-bold text-white mb-1">{{ user.username }}</h1>

                            <div class="mb-3">
                                <span class="text-sm fw-600 inline-block">PLUR Points:</span> <span class="text-electricgreen text-sm fw-600 inline-block">{{ props.plur_points_count }}</span>
                            </div>
                        </div>
                        <div>
                            <Link v-if="can_update"
                                :href="
                                route('ravers.edit', user)
                                "
                                class="
                                font-semibold
                                text-electricgreen
                                mr-2
                                "
                                style="
                                font-size: 0.85rem"
                                >Edit</Link
                            >
                        </div>
                    </div>
                        <Link
                            v-if="props.follow_check"
                            :href="route('ravers.follow', user)"
                            :user="user.id"
                            method="post"
                            as="button"
                            type="button"
                            style="width: 6rem"
                            class="register-btn d-inline-block items-center bg-darkorchid fw-600 text-white font-xsss text-center lh-20 rounded-xl mb-3"
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
                            class="login-btn d-inline-block items-center fw-600 text-white font-xsss text-center lh-20 rounded-xl mb-3"
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

                        <div v-if="user.link_one || user.link_two || user.link_three" class="mt-3" style="white-space: pre-wrap; overflow-wrap: anywhere;">
                            <h2 class="text-white fw-600 text-sm">Websites</h2>

                            <a v-if="user.link_one" :href="user.link_one" class="text-sm d-block">{{ user.link_one }}</a>
                            <a v-if="user.link_one" :href="user.link_two" class="text-sm d-block">{{ user.link_two }}</a>
                            <a v-if="user.link_one" :href="user.link_three" class="text-sm d-block">{{ user.link_three }}</a>
                        </div>

                        <div v-if="user.link_four || user.link_five || user.link_six || user.link_seven || user.link_eight" style="white-space: pre-wrap; overflow-wrap: anywhere;" class="mt-3">
                            <h2 class="text-white fw-600 text-sm">Socials</h2>
                            <a v-if="user.link_four" :href="user.link_four" class="text-sm d-block">{{ user.link_four }}</a>
                            <a v-if="user.link_five" :href="user.link_five" class="text-sm d-block">{{ user.link_five }}</a>
                            <a v-if="user.link_six" :href="user.link_six" class="text-sm d-block">{{ user.link_six }}</a>
                            <a v-if="user.link_seven" :href="user.link_seven" class="text-sm d-block">{{ user.link_seven }}</a>
                            <a v-if="user.link_eight" :href="user.link_eight" class="text-sm d-block">{{ user.link_eight }}</a>
                        </div>
                    </div>
				</div>
            </div>
        </div>
    </Guest>
</template>