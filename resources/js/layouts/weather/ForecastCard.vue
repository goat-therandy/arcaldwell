<script setup lang="ts">

import { defineProps } from 'vue';

defineProps<{
    forecast: any;
}>();

</script>

<template>
    <div class="p-4 rounded-lg rounded-md">
        <div v-if="forecast">
            <img :src="forecast.icon" :alt="forecast.shortForecast" class="w-16 h-16 mb-2" />
            <p> <strong>{{forecast.name}}</strong></p>
            <p><strong>Temp:</strong> {{ forecast.temperature }} °F</p>
            <p><strong>Conditions:</strong> {{ forecast.shortForecast }}</p>
            <p><strong>Precip. Chance:</strong> {{ forecast.probabilityOfPrecipitation.value }}%</p>
            <p><strong>Summary:</strong> {{ forecast.detailedForecast }}</p>
        </div>
        <div v-else>
            <p>No forecast data available.</p>
        </div>
    </div>
</template>

