<script setup lang="ts">
import { Input } from '@/components/ui/input';
import {Button} from '@/components/ui/button';
import {useForm} from '@inertiajs/vue3';
import {Label} from '@/components/ui/label';
import {Form} from '@inertiajs/vue3';

interface Props {
    lat_long?: string;
}

const props = withDefaults(defineProps<Props>(), {
    lat_long: '',
});

const form = useForm({
    location: '',
});

const submit = () => {
    console.log('Submitting form for location:', form.location);
    let lat_long = form.get(route('weather.location', form.location), {
    onFinish: () => props.lat_long = lat_long, 
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
    <div>
        {{ props.lat_long }}
    </div>
</template>