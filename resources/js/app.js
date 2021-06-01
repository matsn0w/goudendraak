require('./bootstrap');

import { createApp } from 'vue';

import News from './components/News.vue';

createApp({
    components: {
        News,
    }
}).mount('#app');
