<template>
    <div class="bg-dark rounded-lg">
        <div class="">
            <h2 class="text-lg font-semibold px-4 pt-4 text-white">
                <slot name="title" />
            </h2>

            <p class="pt-2 pb-5 px-4 text-sm text-gray-500">
                <slot name="description" />
            </p>
        </div>

        <div class="">
            <slot name="aside" />
        </div>
    </div>
</template>
