<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  event: Object,
  date: String
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
        "
    >

        <div class="w-full" style="padding-right: 48px !important;">

            <!-- Flex -->
            <div class="post-flex p-3 text-sm">
                <div class="flex">
                    Posted by
                    <a :href="'/ravers/'+event.user.slug"> 
                    <span class="font-semibold mx-1 text-darkorchid">{{ event.user.username }}</span></a>
                    {{ event.created_at_diff }}
                </div>
            </div>
            
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
           

            <p class="pl-4 pr-3 mb-3 font-normal text-sm text-gray-300 post-description break-words whitespace-pre-wrap">{{ event.content }}</p>
        </div>
    </div>
</template>









