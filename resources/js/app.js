require('./bootstrap');

import { createApp } from 'vue';

import News from './components/pages/News.vue';
import NewsIndex from './components/pages/admin/news/NewsIndex.vue';
import NewsCreate from './components/pages/admin/news/NewsCreate.vue';
import NewsEdit from './components/pages/admin/news/NewsEdit.vue';

import Order from './components/pages/Order.vue';

import MenuIndex from './components/pages/admin/menu/MenuIndex.vue';
import MenuCreate from './components/pages/admin/menu/MenuCreate.vue';
import MenuEdit from './components/pages/admin/menu/MenuEdit.vue';

import MenuCategoryIndex from './components/pages/admin/menu/categories/MenuCategoryIndex.vue';
import MenuCategoryCreate from './components/pages/admin/menu/categories/MenuCategoryCreate.vue';
import MenuCategoryEdit from './components/pages/admin/menu/categories/MenuCategoryEdit.vue';

import AllergenIndex from './components/pages/admin/menu/allergens/AllergenIndex.vue';
import AllergenCreate from './components/pages/admin/menu/allergens/AllergenCreate.vue';
import AllergenEdit from './components/pages/admin/menu/allergens/AllergenEdit.vue';

import UserIndex from './components/pages/admin/users/UserIndex.vue';
import UserCreate from './components/pages/admin/users/UserCreate.vue';
import UserEdit from './components/pages/admin/users/UserEdit.vue';

import Cashier from './components/pages/cashier/Cashier.vue';
import Sales from './components/pages/cashier/Sales.vue';
import Dishes from './components/pages/cashier/Dishes.vue';
import Orders from './components/pages/cashier/Orders.vue';

import Delete from './components/Delete.vue';

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

        AllergenIndex,
        AllergenCreate,
        AllergenEdit,

        UserIndex,
        UserCreate,
        UserEdit,

        Cashier,
        Sales,
        Dishes,
        Orders,

        Delete,
    }
}).mount('#app');
