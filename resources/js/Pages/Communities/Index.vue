<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import CommunityList from "@/Components/CommunityList.vue";
import Pagination from "@/Components/Pagination.vue";

defineProps({
  communities_index: Object,
  communities: Object,
});
</script>

<template>
	<Head title="Communities" />

	<AppLayout title="Dashboard">
		<div class="main-container">
			<div class="row gutter">
				<div class="col-lg-8">
					<!-- Header -->
					<div
						class="
						header-post-box
						flex
						items-center
						bg-dark
						rounded-lg
						border border-gray-200
						"
						style="
						padding-top: 1.05rem;
						padding-bottom: 1.05rem;
						"
						>
						<h2 class="font-semibold text-xl text-white leading-tight">
							/Communities
						</h2>
					</div>
			

					<div
						class="
						communities-table-box
						overflow-hidden
						shadow
						ring-1 ring-black ring-opacity-5
						md:rounded-lg
						border
						"
					>
						<table class="min-w-full divide-gray-300">
							<thead class="bg-darkorchid">
								<tr>
									<th
										scope="col"
										class="
										py-3.5
										pl-4
										pr-3
										text-left text-sm
										font-semibold
										text-white
										sm:pl-6
										"
									>
										Name
									</th>
									<th
										scope="col"
										class="
										px-3
										py-3.5
										text-left text-sm
										font-semibold
										text-white
										"
									>
										Slug
									</th>
									<th
										scope="col"
										class="relative py-3.5 pl-3 pr-4 sm:pr-6"
									>
										<span class="sr-only">Edit</span>
									</th>
								</tr>
							</thead>
							
							<tbody class="divide-y divide-gray-500 bg-dark">
								<tr
								v-for="community in communities_index.data"
								:key="community.id"
								>
								<td
									class="
									whitespace-nowrap
									py-4
									pl-4
									pr-3
									text-sm
									font-medium
									text-gray-900
									sm:pl-6
									"
								>
									<Link
									:href="
										route('frontend.communities.show', community.slug)
									"
									class="
										text-blue-500
										hover:text-blue-700
										font-semibold
									"
									>{{ community.name }}</Link
									>
								</td>
								<td
									class="
									whitespace-nowrap
									px-3
									py-4
									text-sm text-gray-500
									"
								>
									{{ community.slug }}
								</td>
								<td
									class="
									relative
									whitespace-nowrap
									py-4
									pl-3
									pr-4
									text-right text-sm
									font-medium
									sm:pr-6
									"
								>
									<!-- <Link
									:href="route('communities.edit', community.slug)"
									class="text-indigo-600 hover:text-indigo-900 mr-3"
									>Edit</Link
									>
									<Link
									:href="route('communities.destroy', community.slug)"
									class="text-red-600 hover:text-red-900"
									method="delete"
									as="button"
									type="button"
									>Delete</Link
									> -->
								</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="pagination-container">
						<Pagination :links="communities_index.links" />
					</div>
				</div>

                <div class="col-lg-4">
					<div class="about-box border rounded-lg bg-dark">
						<div class="bg-darkorchid rounded-lg p-3">
							<img class="d-inline" style="max-height: 1.1rem; max-width: 1.25rem; margin-right: 0.35rem; padding-bottom: 0.23rem" src="/assets/img/about.svg">
							<h2
							class="
								font-semibold
								text-white
								d-inline
								"
							>
								About Communities
							</h2>
						</div>
						<p class="bg-dark font-normal text-sm text-grey-300 p-3 rounded-b-lg">The many different threads of pb-cle.org. <span class="text-darkorchid font-bold">The communities are locked to the current topics but can be unlocked.</span></p>
					</div>

					<CommunityList :communities="communities.data">
                        <template #title>Top Communities</template>
                    </CommunityList>
				</div>
			</div>
		</div>
	</AppLayout>
</template>

