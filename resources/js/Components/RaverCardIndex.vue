<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  raver: Object,
});
</script>

<template>
    <div
        class="
        mb-2
        flex
        bg-dark
        rounded-lg
        border border-gray-200
        pl-3
        pr-3
        pt-2
        pb-2
        "
    >

        <div class="w-full flex justify-between" style="padding-right: 48px !important;">
          <div class="flex flex-row">
                <Link
                    :href="route('ravers.show', raver.slug)"
                >
                    <img style="width: 3.5rem; height: 3.5rem" class="rounded-full object-cover mb-2 mr-3" :src="raver.profile_photo_url">
                </Link>
                <Link
                    :href="route('ravers.show', raver.slug)"
                    class="flex align-items-center"
                >
                    <h1 style="font-size: 1.25rem; font-weight: 600;" class="text-bold text-white mb-2">{{ raver.username }}</h1>
                </Link>
            </div>

            <!-- TODO -->
            <!-- {{ sub_follow_check }}
         
            <Link
                v-if="sub_follow_check"
                :href="route('ravers.follow', raver.slug)"
                :user="raver.id"
                method="post"
                as="button"
                type="button"
                style="width: 6rem"
                class="register-btn d-inline-block items-center bg-darkorchid fw-600 text-white font-xsss text-center lh-20 rounded-xl mb-3"
                preserve-scroll
            >Follow</Link>

            <Link
                v-if="!sub_follow_check"
                :href="route('ravers.unfollow', raver.slug)"
                :user="raver.id"
                method="post"
                as="button"
                type="button"
                style="width: 6rem"
                class="login-btn d-inline-block items-center fw-600 text-white font-xsss text-center lh-20 rounded-xl mb-3"
                preserve-scroll
            >Unfollow</Link> -->
       
        </div>
    </div>
</template>









