<script setup>
import SectionTitle from './SectionTitle.vue';
</script>

<template>
    <div class="border rounded-lg mb-3">
        <SectionTitle>
            <template #title>
                <slot name="title" />
            </template>
            <template #description>
                <slot name="description" />
            </template>
        </SectionTitle>

        <div class="">
            <div class="bg-dark text-gray-400 text-sm">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
