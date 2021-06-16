require('./bootstrap');

import { createApp } from 'vue';

import News from './components/News.vue';
import NewsIndex from './components/admin/news/NewsIndex.vue';
import NewsCreate from './components/admin/news/NewsCreate.vue';
import NewsEdit from './components/admin/news/NewsEdit.vue';

import MenuIndex from './components/admin/menu/MenuIndex.vue';
import MenuCreate from './components/admin/menu/MenuCreate.vue';
import MenuEdit from './components/admin/menu/MenuEdit.vue';

import Cashier from './components/Cashier.vue';
import Sales from './components/Sales.vue';
import Dishes from './components/Dishes.vue';

createApp({
    components: {
        News,
        NewsIndex,
        NewsCreate,
        NewsEdit,

        MenuIndex,
        MenuCreate,
        MenuEdit,

        Cashier,
        Sales,
        Dishes,
    }
}).mount('#app');
