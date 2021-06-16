require('./bootstrap');

import { createApp } from 'vue';

import News from './components/News.vue';
import NewsIndex from './components/admin/NewsIndex.vue';
import NewsCreate from './components/admin/NewsCreate.vue';
import NewsEdit from './components/admin/NewsEdit.vue';
import Cashier from './components/Cashier.vue';
import Sales from './components/Sales.vue';
import Dishes from './components/Dishes.vue';

createApp({
    components: {
        News,
        NewsIndex,
        NewsCreate,
        NewsEdit,
        Cashier,
        Sales,
        Dishes,
    }
}).mount('#app');
