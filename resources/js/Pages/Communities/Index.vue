<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import CommunityList from "@/Components/CommunityList.vue";
import Pagination from "@/Components/Pagination.vue";

defineProps({
  communities_index: Object,
  communities: Object,
  can_create_community: Boolean,
  isActive: String
});
</script>

<template>
	<Head title="Communities" />

	<AppLayout title="Dashboard" isActive="rute">
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
						border
						justify-between
						"
						>
							<h2 class="font-semibold text-xl text-white leading-tight">
								Communities
							</h2>

							<!-- {{ isActive }} -->
							<Link
								v-if="can_create_community"
								:href="route('communities.create')"
								class="comment-btn items-center border-transparent bg-darkorchid fw-600 text-white font-xsss text-center lh-20 rounded-xl"
								>Create Community</Link
							>
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
										Posts
									</th>
									<th
										scope="col"
										class="relative py-3.5 pl-3 pr-4 sm:pr-6"
									>
										<span class="sr-only">Edit</span>
									</th>
								</tr>
							</thead>
							
							<tbody class="bg-dark">
								<tr class="table-border"
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
									sm:pl-6
									"
								>
									<Link
									:href="
										route('communities.show', community.slug)
									"
									class="
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
									text-sm
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
						<p class="bg-dark font-normal text-sm text-grey-300 p-3 rounded-b-lg">The many different threads of pb-cle.org. You must spend <span class="text-electricgreen font-bold">100 PLUR Points</span> in order to create a custom community. You can obtain <span class="text-electricgreen font-bold">PP</span> by posting, commenting, and creating events!</p>
					</div>

					<CommunityList :communities="communities.data">
                        <template #title>Top Communities</template>
                    </CommunityList>
				</div>
			</div>
		</div>
	</AppLayout>
</template>

