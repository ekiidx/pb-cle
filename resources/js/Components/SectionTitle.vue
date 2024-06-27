<template>
    <div class="bg-dark rounded-t-lg">
        <div class="">
            <h2 class="text-lg font-semibold px-3 pt-3 text-white">
                <slot name="title" />
            </h2>

            <p class="section-title-description pt-2 pb-5 px-3 text-sm text-gray-500">
                <slot name="description" />
            </p>
        </div>

        <div class="">
            <slot name="aside" />
        </div>
    </div>
</template>
