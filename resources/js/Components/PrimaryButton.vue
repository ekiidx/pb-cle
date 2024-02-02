<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="items-center border-transparent bg-darkorchid fw-500 text-white font-xsss p-3 ms-auto w100 text-center lh-20 rounded-xl">
        <slot />
    </button>
</template>
