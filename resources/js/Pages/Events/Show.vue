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
          	<div class="row">
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
							<div class="post-flex p-3 text-sm">
								<div class="flex">
									Posted by
									<a :href="'/ravers/'+event.user.slug"><span class="font-semibold mx-1 text-darkorchid">{{ event.user.username }}</span></a>
									{{ event.created_at_diff }}
								</div>
							</div>

							<h1 style="color:#ffffff;">{{ $page.props.event.name }}</h1>
							<p>Hosted by {{ event.user.username }}</p>
							<p>{{ event.content }}</p>
							<img class="" :src="'/storage/'+event.flyer_front">
							<img class="" :src="'/storage/'+event.flyer_back">
                  
						</div>
					</div>
				</div>

            	<div class="col-lg-4">

            	</div>

            	<!-- {{ $page.props.event }} -->
          	</div>
     
        </div>
  	</Guest>
</template>

