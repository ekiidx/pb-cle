<template>
    <div class="md:col-span-1 flex justify-between bg-dark shadow-md border rounded-lg">
        <div class="">
            <h2 class="text-lg font-semibold p-6 bg-darkorchid rounded-lg text-white">
                <slot name="title" />
            </h2>

            <p class="mt-1 py-3 sm:py-4 text-sm text-gray-400">
                <slot name="description" />
            </p>
        </div>

        <div class="">
            <slot name="aside" />
        </div>
    </div>
</template>
