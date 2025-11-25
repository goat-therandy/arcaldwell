<script setup lang="ts">
import { Input } from '@/components/ui/input';
import {Button} from '@/components/ui/button';
import {useForm, Form} from '@inertiajs/vue3';
import {Label} from '@/components/ui/label';
import { defineProps } from 'vue';
import { useRouter } from 'vue-router';
import router from '@/index'
import ForecastCard from '@/layouts/Weather/ForecastCard.vue';

const props = defineProps<{
    forecast: any;
}>();

const form = useForm({
    location: ''
});

const submit = () => {
    form.get(route('weather.forecast', form.location), {
        onFinish: () => { 
            form.reset('location');
        }
        
    });
};



</script>

<template>
    <div>
        See the weather here! 
    </div>
    <div class="mt-4">
        <Label for="location" class="mb-2 block text-sm font-medium">
            Enter a location. Either a city, state (if in the US) or a city, country (if outside the US).
        </Label>
        <Input
        id="location"
        v-model="form.location"
        type="text"
        placeholder="Search for a city, country..." />
        <Button type="submit" class="mt-4" @click="submit">
            Get Weather
        </Button>   
    </div>
    <div v-if="forecast" class="mt-6">
       <div v-for="item in forecast">
            <ForecastCard :forecast="item" />
       </div>
    </div>
</template>