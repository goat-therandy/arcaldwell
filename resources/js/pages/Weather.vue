<script setup lang="ts">
import { Input } from '@/components/ui/input';
import {Button} from '@/components/ui/button';
import {useForm} from '@inertiajs/vue3';
import {Label} from '@/components/ui/label';
import { defineProps, ref, watch } from 'vue';
import { useRouter } from 'vue-router';
import router from '@/index'
import ForecastCard from '@/layouts/weather/ForecastCard.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';


interface Props {
    forecast?: any[];
}

const form = useForm({
    location: '',
});

withDefaults(defineProps<Props>(), {
    forecast: () => []
});

const submit = () => {
    form.get(route('weather.forecast', form.location), {
        onFinish: () => {
            form.reset('location');
        }
    });
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Simple Weather',
        href: '/weather',
    },
];

</script>

<template>
	<AppLayout :breadcrumbs="breadcrumbs">
		<div class="pr-4 pl-5 pt-4">
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
				placeholder="Search for a city, country..."
				class="w-1/2" />
				<Button type="submit" class="mt-4 mr-4" @click="submit">
					Get Weather
				</Button>
			</div>
			<div v-if="forecast" class="mt-6">
				<h2 class="text-lg font-semibold mb-2">Weather Forecast</h2>
			<div v-for="item in forecast" class="border-black w-1/2 bg-cyan-500/50 border-4 border-stone-400 rounded-lg mb-8">
					<ForecastCard :forecast="item" />
			</div>
			</div>
		</div>
	</AppLayout>
</template>