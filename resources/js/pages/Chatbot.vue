<script setup lang="ts">

import {useForm} from '@inertiajs/vue3';
import {Input} from '@/components/ui/input';
import {Button} from '@/components/ui/button';
import { withDefaults } from 'vue';
import { defineProps, ref, watch } from 'vue';
import { useRouter } from 'vue-router';
import router from '@/index'
import Chatbot from '@/layouts/chatbot/Chatbot.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

interface Props {
    prompt_reply?: string;
}

withDefaults(defineProps<Props>(), {
    prompt_reply: () => ''
});

const form = useForm({
    prompt: '',
});

const submit = () => {
    form.get(route('chatbot.prompt', form.prompt), {
        onFinish: () => {
        }
    });
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Simple Chatbot',
        href: '/chatbot',
    },
];

</script>

<template>
	<AppLayout :breadcrumbs="breadcrumbs">
		<div class="pr-4 pl-5 pt-4">
			<div>
				Chat with our AI-powered chatbot here!
			</div>
			<div class="mt-4">
				<Input
				id="prompt"
				v-model="form.prompt"
				type="text"
				placeholder="Ask me anything..."
				class="w-1/2" />
				<Button type="submit" class="mt-4 mr-4" @click="submit">
					Send
				</Button>
			</div>
			<div v-if="prompt_reply">
				<h2 class="text-lg font-semibold mb-2">Chatbot Reply</h2>
				<div class="border-black w-1/2 bg-green-500/50 border-4 border-stone-400 rounded-lg mb-8">
						<Chatbot :prompt_reply="prompt_reply" />
				</div>
			</div>
		</div>
	</AppLayout>
</template>