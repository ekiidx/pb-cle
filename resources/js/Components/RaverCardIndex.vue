<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  raver: Object
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
        shadow-md
        p-2
        "
    >

        <div class="w-full flex" style="padding-right: 48px !important;">
            <Link
                :href="route('ravers.show', raver)"
            >
                <img style="width: 3.5rem; height: 3.5rem" class="rounded-full object-cover mb-2 mr-3" :src="raver.profile_photo_url">
            </Link>
            <Link
                :href="route('ravers.show', raver)"
                class="flex align-items-center"
            >
                <h1 style="font-size: 1.25rem; font-weight: 600;" class="text-bold text-white mb-3">{{ raver.username }}</h1>
            </Link>

            

        </div>
    </div>
</template>









