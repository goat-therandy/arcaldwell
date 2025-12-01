import {createRouter, createWebHistory} from 'vue-router';
import Weather from '@/pages/Weather.vue';
import Chatbot from '@/pages/Chatbot.vue';

const routes = [
    {
        path: '/weather', 
        component: Weather, 
        name: 'weather'
    },
    {
        path: '/chatbot',
        component: Chatbot,
        name: 'chatbot'
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;