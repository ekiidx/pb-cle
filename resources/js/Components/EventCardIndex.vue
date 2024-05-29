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

        <div class="w-full">

            <!-- Flex -->
            <div class="post-header text-sm">
                Posted by
                <a :href="'/ravers/'+event.user.slug"> 
                <span class="font-semibold mx-1 text-darkorchid">{{ event.user.username }}</span></a>
                {{ event.created_at_diff }}
            </div>

            <div class="flex">
                <a :href="'/events/'+ event.slug">
                    <img v-if="event.flyer_front_upload" class="rounded-sm pl-4 pt-1 pb-3" style="max-width: 7rem; max-height: 5rem; min-width: 7rem; height: auto;" :src="'/storage/flyers/'+event.flyer_front_upload">
                </a>
                
                <div>
                    <!-- {{ event.data }} -->
                    <a :href="'/events/'+ event.slug">
                        <h2
                            class="
                                post-title
                                pl-4 pr-4
                                font-bold
                                tracking-tight
                                text-white
                                whitespace-break-spaces
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









