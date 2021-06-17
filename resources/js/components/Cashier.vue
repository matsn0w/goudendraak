<template>
    <div class="notification is-success" v-if="response.success" v-show="response.visible">
        {{ response.success }}
    </div>

    <div class="notification is-danger content" v-if="response.errors.length">
        <p>{{ response.error }}</p>
        <ul v-for="error in response.errors">
            <li>{{ error }}</li>
        </ul>
    </div>

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
                                    <button class="button is-small is-pulled-right" type="button" @click="addItem(item)">Toevoegen</button>
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
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Naam</th>
                            <th>Prijs</th>
                            <th>Aantal</th>
                            <th>Opmerkingen</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(item, index) in order.items" :key="item.id">
                            <td>{{ index + 1 }}.</td>
                            <td>{{ item.name }}</td>
                            <td>{{ euro(item.amount * item.price) }}</td>
                            <td>
                                <input class="input is-small" type="number" min="0" v-model.number="item.amount" @change="updateItem(item)">
                            </td>
                            <td>
                                <input class="input is-small" type="text" v-model="item.notes">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="block component">
                <div class="is-size-5 has-text-weight-bold is-flex is-flex-direction-row is-justify-content-space-between is-align-items-center">
                    <p>Totaal:</p>
                    <p>{{ euro(total) }}</p>

                    <div class="buttons">
                        <button class="button" type="button" @click="clearOrder">Verwijderen</button>
                        <button class="button is-primary" type="button" @click="finishOrder">Afrekenen</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import shared from '../shared';

export default {
    name: "Cashier",

    data() {
        return {
            categories: [],
            items: [],
            order: {
                items: [],
            },
            response: {
                visible: true,
                success: '',
                error: '',
                errors: [],
            },
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

    created() {
        this.euro = shared.euro.bind(this);
    },

    computed: {
        total() {
            return _.sum(this.order.items.map(item => item.amount * item.price));
        }
    },

    methods: {
        category_item(category_id) {
            return this.items.filter(item => item.category.id === category_id);
        },

        addItem(item) {
            if (this.order.items.includes(item)) {
                let orderItem = this.order.items.find(oi => oi.id === item.id);
                orderItem.amount++;
                return;
            }

            let orderItem = item;
            orderItem.amount = 1
            orderItem.notes = '';

            this.order.items.push(orderItem);
        },

        removeItem(item) {
            this.order.items = this.order.items.filter(oi => oi.id !== item.id);
        },

        updateItem(item) {
            if (item.amount === 0) {
                // remove the item from the order
                this.removeItem(item);
            }
        },

        clearOrder() {
            this.order = {
                items: [],
            };

            this.response = {
                visible: true,
                success: '',
                error: '',
                errors: [],
            };
        },

        finishOrder() {
            axios.post('api/v1/orders', this.order)
                .then(res => {
                    if (res.status == 200) {
                        // show a success message for 3 seconds
                        this.response.visible = true;
                        this.response.success = 'Order created successfully!';
                        this.response.errors = [];

                        setTimeout(() => this.response.visible = false, 3000);
                    }
                })
                .catch(error => {
                    if (error.response) {
                        let data = error.response.data;

                        // add errors to the error bag
                        this.response.error = data.message;

                        for (const [key, value] of Object.entries(data.errors)) {
                            for (let item of value) {
                                this.response.errors.push(item);
                            }
                        }
                    } else if (error.request) {
                        console.log(error.request);
                    } else {
                        console.error(error.message);
                    }
                });

            // reset the form
            this.clearOrder();
        }
    },
}
</script>
