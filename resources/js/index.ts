import {createRouter, createWebHistory} from 'vue-router';
import Weather from '@/pages/Weather.vue';

const routes = [
    {
        path: '/weather', 
        component: Weather, 
        name: 'weather'},
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;