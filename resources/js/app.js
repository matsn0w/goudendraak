require('./bootstrap');

import { createApp } from 'vue';

import News from './components/News.vue';
import NewsIndex from './components/admin/news/NewsIndex.vue';
import NewsCreate from './components/admin/news/NewsCreate.vue';
import NewsEdit from './components/admin/news/NewsEdit.vue';

import Order from './components/Order.vue';

import MenuIndex from './components/admin/menu/MenuIndex.vue';
import MenuCreate from './components/admin/menu/MenuCreate.vue';
import MenuEdit from './components/admin/menu/MenuEdit.vue';

import MenuCategoryIndex from './components/admin/menu/categories/MenuCategoryIndex.vue';
import MenuCategoryCreate from './components/admin/menu/categories/MenuCategoryCreate.vue';
import MenuCategoryEdit from './components/admin/menu/categories/MenuCategoryEdit.vue';

import UserIndex from './components/admin/users/UserIndex.vue';
import UserCreate from './components/admin/users/UserCreate.vue';
import UserEdit from './components/admin/users/UserEdit.vue';

import Cashier from './components/Cashier.vue';
import Sales from './components/Sales.vue';
import Dishes from './components/Dishes.vue';
import Orders from './components/Orders.vue';

createApp({
    components: {
        News,
        NewsIndex,
        NewsCreate,
        NewsEdit,

        Order,

        MenuIndex,
        MenuCreate,
        MenuEdit,

        MenuCategoryIndex,
        MenuCategoryCreate,
        MenuCategoryEdit,

        UserIndex,
        UserCreate,
        UserEdit,

        Cashier,
        Sales,
        Dishes,
        Orders,
    }
}).mount('#app');

// get current language
const lang = document.querySelector('html').lang;

// set global axios language
axios.defaults.headers.common['Accept-Language'] = lang;
