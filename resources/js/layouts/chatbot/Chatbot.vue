<script setup lang="ts">

import { defineProps } from 'vue';
import MarkdownRender from '@/components/MarkdownRender.vue';

defineProps<{
    prompt_reply: any;
}>();

</script>

<template>
    <div class="p-4 rounded-lg rounded-md">
        <div v-if="prompt_reply">
            <p>
                <MarkdownRender :content="prompt_reply" />
            </p>
        </div>
        <div v-else>
            <p>No reply available.</p>
        </div>
    </div>
</template>