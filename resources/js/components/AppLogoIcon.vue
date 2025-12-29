<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <img src="https://i.imgur.com/BNHJOHa.png" alt="ARCaldwell Logo" :class="className" />
</template>
