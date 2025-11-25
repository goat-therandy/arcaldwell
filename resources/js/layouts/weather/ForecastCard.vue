<script setup lang="ts">

import { defineProps } from 'vue';

defineProps<{
    forecast: any;
}>();

</script>

<template>
    <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-2">Weather Forecast</h2>
        <div v-if="forecast">
            <p><strong>Name:</strong> {{forecast.name}}</p>
            <p><strong>Temperature:</strong> {{ forecast.temperature }} °F</p>
            <p><strong>Conditions:</strong> {{ forecast.shortForecast }}</p>
        </div>
        <div v-else>
            <p>No forecast data available.</p>
        </div>
    </div>
</template>

