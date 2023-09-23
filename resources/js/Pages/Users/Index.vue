<template>
  <Head title="Users" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Users
      </h2>
    </template>
      
          
              <div
                class="
                  inline-block
                  min-w-full
                  py-2
                  align-middle
                  md:px-6
                  lg:px-8
                "
              >
                <div
                  class="
                    overflow-hidden
                    shadow
                    ring-1 ring-black ring-opacity-5
                    md:rounded-lg
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


                    
                    <tbody class="divide-y divide-gray-200 bg-white">
                      <tr
                        v-for="users in users.data"
                        :key="user.id"
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
                         
                        </td>
                        <td
                          class="
                            whitespace-nowrap
                            px-3
                            py-4
                            text-sm text-gray-500
                          "
                        >
                        
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
                         
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="m-2 p-2">
              
                  </div>
                </div>
              </div>
  
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Pagination from "../../Components/Pagination.vue";

defineProps({
  users: Object,
});
</script>

