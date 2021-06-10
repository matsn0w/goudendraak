<template>
    <div class="columns">
        <div class="column left">
            <div class="block component">
                <div class="content" v-for="category in categories" :key="category.id">
                    <h3 class="has-text-centered">{{ category.name }}</h3>

                    <table class="table is-fullwidth is-narrow">
                        <tbody>
                            <tr v-for="item in category_item(category.id)" :key="item.id">
                                <td>{{ item.number }}{{ item.number_addition }}.</td>
                                <td>{{ item.name }} <small><em>{{ item.description }}</em></small></td>
                                <td>{{ euro(item.price) }}</td>
                                <td>
                                    <button class="is-pulled-right" type="button" @click="addItem(item)">Toevoegen</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="column">
            <div class="block component content">
                <h3 class="has-text-centered">Bestelling</h3>

                <table class="table is-fullwidth is-narrow">
                    <tbody>
                        <tr v-for="(item, index) in orderItems" :key="item.id">
                            <td>{{ index+1 }}.</td>
                            <td>{{ item.name }}</td>
                            <td>{{ euro(item.amount * item.price) }}</td>
                            <td>
                                <input class="is-pulled-right" type="number" min="0" v-model.number="item.amount" @change="updateItem(item)">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="block component">
                <div class="is-size-5 has-text-weight-bold is-flex is-flex-direction-row is-justify-content-space-between is-align-items-center">
                    <p>Totaal:</p>
                    <p>{{ euro(total) }}</p>
                    <div>
                        <button class="is-block mb-1" type="button">Afrekenen</button>
                        <button class="is-block" type="button" @click="clearOrder">Verwijderen</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Cashier",
    data() {
        return {
            categories: [],
            items: [],
            orderItems: [],
        }
    },
    mounted() {
        axios.get('/api/v1/menucategories')
            .then(res => res.data)
            .then(res => this.categories = res.data);

        axios.get('/api/v1/menuitems')
            .then(res => res.data)
            .then(res => this.items = res.data);
    },
    computed: {
        total() {
            return _.sum(this.orderItems.map(item => item.amount * item.price));
        }
    },
    methods: {
        category_item(category) {
            return this.items.filter(item => item.category_id === category);
        },

        euro(price) {
            let f = new Intl.NumberFormat('nl-NL', {
                style: 'currency',
                currency: 'EUR',
            });

            return f.format(price);
        },

        addItem(item) {
            if (this.orderItems.includes(item)) {
                let orderItem = this.orderItems.find(oi => oi.id === item.id);
                orderItem.amount++;
                return;
            }

            let orderItem = item;
            orderItem.amount = 1;

            this.orderItems.push(orderItem);
        },

        removeItem(item) {
            this.orderItems = this.orderItems.filter(oi => oi.id !== item.id);
        },

        updateItem(item) {
            if (item.amount === 0) {
                // remove the item from the order
                this.removeItem(item);
            }
        },

        clearOrder() {
            this.orderItems = [];
        }
    }
}
</script>
