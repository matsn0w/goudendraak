<template>
    <div class="level">
        <div class="level-left">
            <h1>Bestellen</h1>
        </div>

        <div class="level-right">
            <button class="button" type="button" @click="placeOrder" :disabled="waiting">Plaats bestelling</button>
        </div>
    </div>

    <div :hidden="!message">
        {{ message }}
    </div>

    <form action="" method="get" class="block">
        <div class="field">
            <div class="control">
                <input class="input" type="text" name="s" placeholder="Zoek een gerecht..." v-model="search" :disabled="waiting">
            </div>
        </div>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <th>#</th>
                <th>Naam</th>
                <th>Categorie</th>
                <th>Prijs</th>
                <th>Aantal</th>
            </thead>

            <tbody>
                <template v-for="dish in itemsSearched" :key="dish.id">
                    <tr>
                        <td>{{ dish.number }}{{ dish.number_addition }}.</td>
                        <td>{{ dish.name }}</td>
                        <td>{{ dish.category.name }}</td>
                        <td>{{ euro(dish.price) }}</td>
                        <td>
                            <button class="button" @click="remove(dish)" :disabled="dish.amount === 0 || waiting">-</button>
                            <span>{{ dish.amount }}</span>
                            <button class="button" @click="add(dish)" :disabled="waiting">+</button>
                        </td>
                    </tr>
                    <tr v-if="dish.description">
                        <td colspan="5" class="has-text-left">
                            <small><em>{{ dish.description }}</em></small>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import shared from '../shared';

export default {
    name: "Order",

    data() {
        return {
            order: {
                items: [],
            },
            items: [],
            search: '',
            message: '',
            waiting: false,
        }
    },

    computed: {
        itemsSearched() {
            const s = this.search?.toLowerCase();

            return this.items.filter((item) => {
                if (item.name?.toLowerCase().includes(s)) {
                    return true;
                }

                if (item.category?.name.toLowerCase().includes(s)) {
                    return true;
                }

                if (`${item.number}` == s
                    || item.number_addition?.toLowerCase().includes(s)) {
                    return true;
                }

                return false;
            });
        },
    },

    mounted() {
        this.fetchItems();
    },

    created() {
        this.euro = shared.euro.bind(this);
    },

    methods: {
        fetchItems() {
            axios.get('api/v1/menuitems')
                .then(res => res.data)
                .then(res => {
                    res.data.forEach(item => {
                        item.amount = 0;
                    });

                    this.items = res.data
                });
        },

        add(item) {
            let orderItem = this.order.items.find(oi => oi.id === item.id);

            if (!orderItem) {
                orderItem = item;
                this.order.items.push(item);
            }

            orderItem.amount++;
        },

        remove(item) {
            item.amount--;

            if (item.amount === 0) {
                this.order.items = this.order.items.filter(oi => oi.id !== item.id);
            }
        },

        placeOrder() {
            this.message = 'Bestelling geplaatst! U kunt over 10 minuten een volgende bestelling plaatsen.';
            this.waiting = true;

            setTimeout(() => {
                this.resetOrder();
            }, 0.1 * 60 * 1000); // 10 m * 60 s * 1000 ms
        },

        resetOrder() {
            this.message = '';
            this.waiting = false;
            this.order = {
                items: [],
            };
            this.fetchItems();
        },
    },
}
</script>
