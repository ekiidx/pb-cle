<script setup>
import { computed, useSlots } from 'vue';
import SectionTitle from './SectionTitle.vue';

defineEmits(['submitted']);

const hasActions = computed(() => !! useSlots().actions);
</script>

<template>
    <div class="dark border rounded-lg mb-3">
        <SectionTitle>
            <template #title>
                <slot name="title" />
            </template>
            <template #description>
                <slot name="description" />
            </template>
        </SectionTitle>

        <form @submit.prevent="$emit('submitted')">
            <div
                class="px-4 bg-dark"
                :class="hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'"
            >
                <div class="pb-5">
                    <slot name="form" />
                </div>
            </div>

            <div v-if="hasActions" class="flex items-center justify-start pb-4 px-4 bg-dark text-right sm:rounded-bl-md sm:rounded-br-md">
                <slot name="actions" />
            </div>
        </form>
       
    </div>
</template>
