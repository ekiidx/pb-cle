<script setup>
import Guest from "@/Layouts/Guest.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
  event: Object,
});
</script>


<template>
    <Guest>
        <Head>
            <title>{{ $page.props.event.name }}</title>
        </Head>

        <div class="main-container">
          	<div class="row g-3">
            	<div class="col-lg-8">

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
						<div class="w-full" style="padding-right: 48px !important;">
							<!-- Flex -->
							<div class="px-3 py-3">
								<div class="post-flex mb-4 text-sm">
									<div class="flex">
										Posted by
										<a :href="'/ravers/'+event.user.slug"><span class="font-semibold mx-1 text-darkorchid">{{ event.user.username }}</span></a>
										{{ event.created_at_diff }}
									</div>
								</div>

							
								<h1 class="font-semibold text-2xl text-white mb-4">{{ event.name }}</h1>
								<!-- <p class="mb-4">Hosted by {{ event.user.username }}</p> -->
							
								<div class="mb-4">
									<img style="width: 100%; max-width: 40rem; height: auto;" v-if="event.flyer_front" class="" :src="'/storage/'+event.flyer_front">
									<img style="width: 100%; max-width: 40rem; height: auto;" v-if="event.flyer_back" class="" :src="'/storage/'+event.flyer_back">
								</div>

								<div class="mb-2">
									<p class="text-gray-300 break-words whitespace-pre-wrap">{{ event.content }}</p>
								</div>
							</div>
						</div>
					</div>
				</div>

            	<div class="col-lg-4">
					<div
						class="
						mb-3
						bg-dark
						rounded-lg
						border border-gray-200
						shadow-md
						"
					>
						<div class="flex items-center">
						<h2 class="p-3 text-white">Date</h2>
						<p class="p-3 text-white font-bold">{{ event.weekday_format }} {{ event.party_date }}</p>
						<!-- <h2 class="px-3 text-white">Time</h2> -->
						</div>
				
						<h2 class="p-3 text-white">Tickets</h2>
						
					</div>
            	</div>
            	<!-- {{ $page.props.event }} -->
          	</div>
     
        </div>
  	</Guest>
</template>

