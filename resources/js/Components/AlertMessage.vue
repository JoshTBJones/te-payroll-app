<template>
    <div
        :class="[
            'p-4 mb-4 text-sm rounded-lg',
            type === 'error' ? 'text-red-800 bg-red-50' : 'text-green-800 bg-green-50',
        ]"
        role="alert"
    >
        <span class="font-medium">{{ message }}</span>
    </div>
</template>

<script>
export default {
    props: {
        message: String,
        type: {
            type: String,
            default: 'error',
        },
    },
};
</script>
