<script setup>
import SectionTitle from './SectionTitle.vue';
</script>

<template>
    <div class="border bg-dark rounded-lg post-card">
        <SectionTitle>
            <template #title>
                <slot name="title" />
            </template>
            <template #description>
                <slot name="description" />
            </template>
        </SectionTitle>

        <div class="">
            <div class="rounded-lg text-gray-400 text-sm">
                <slot name="content" />
            </div>
        </div>
    </div>
</template>
