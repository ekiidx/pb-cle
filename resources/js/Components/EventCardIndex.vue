<script setup>
// import { Link } from "@inertiajs/vue3";

defineProps({
  event: Object
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
        "
    >

        <div class="w-full" style="padding-right: 48px !important;">

            <!-- Flex -->
            <div class="post-flex p-3 text-sm">
                Posted by
                <a :href="'/ravers/'+event.user.slug"> 
                <span class="font-semibold mx-1 text-darkorchid">{{ event.user.username }}</span></a>
                {{ event.created_at_diff }}
            </div>

            <div class="d-flex">
                <a :href="'/events/'+ event.slug">
                    <img v-if="event.flyer_front_upload" class="rounded-sm pl-4 pb-3" style="max-width: 7rem; max-height: 5rem; height: auto;" :src="'/storage/flyers/'+event.flyer_front_upload">
                </a>
                
                <div>
                    <!-- {{ event.data }} -->
                    <a :href="'/events/'+ event.slug">
                        <h2
                            class="
                                pl-4 pr-3 mb-2
                                font-bold
                                tracking-tight
                                text-white
                                whitespace-break-spaces
                                post-title
                            "
                        >
                            {{ event.name }}
                        </h2>
                    </a>
            
                    <p class="pl-4 pr-3 mb-3 font-normal text-sm text-gray-300 post-description break-words whitespace-pre-wrap">{{ event.weekday_format }} {{ event.party_date }}</p>

                </div>
            </div>
        </div>
    </div>
</template>









