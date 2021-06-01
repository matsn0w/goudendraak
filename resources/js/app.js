require('./bootstrap');

import { createApp } from 'vue';

import News from './components/News.vue';
import NewsCreate from './components/NewsCreate.vue';

createApp({
    components: {
        News,
        NewsCreate,
    }
}).mount('#app');
