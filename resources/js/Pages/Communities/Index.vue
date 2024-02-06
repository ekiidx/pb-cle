<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";

defineProps({
  communities: Object,
});
</script>

<template>
  <Head title="Communities" />

    <AppLayout title="Dashboard">

      <div class="main-container">
        <!-- Header -->
        <!-- <div class="bg-dark border rounded-lg mb-3 p-3"> -->
            <h2 class="font-semibold text-xl mb-4 text-white leading-tight">
              /Communities
            </h2>
        <!-- </div> -->

          
        <div class="row">
          <div class="col-12">

            <div
              class="
                overflow-hidden
                shadow
                ring-1 ring-black ring-opacity-5
                md:rounded-lg
                border
              "
            >
              <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                  <tr>
                    <th
                      scope="col"
                      class="
                        py-3.5
                        pl-4
                        pr-3
                        text-left text-sm
                        font-semibold
                        text-gray-900
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
                        text-gray-900
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
                <tbody class="divide-y divide-gray-200 bg-dark">
                  <tr
                    v-for="community in communities.data"
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

          <div class="m-2 p-2">
            <Pagination :links="communities.links" />
          </div>

        </div>
      </div>
    </div>
  </AppLayout>
</template>

