<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-electricgreen dark:bg-gray-800 border border-gray-300 rounded-md font-semibold text-xs text-black dark:text-gray-300 uppercase tracking-widest shadow-sm dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
