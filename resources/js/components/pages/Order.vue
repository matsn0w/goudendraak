<template>
    <div class="level">
        <div class="level-left">
            <h1>Bestellen</h1>
        </div>

        <div class="level-right">
            <button class="button" type="button" @click="enterDetails" :disabled="waiting || order.items.length === 0">Plaats bestelling</button>
        </div>
    </div>

    <div class="block has-text-centered" :hidden="!message">
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
        <table class="has-text-left">
            <thead>
                <th>#</th>
                <th>Naam</th>
                <th>Categorie</th>
                <th>Prijs</th>
            </thead>

            <tbody>
                <template v-for="dish in itemsSearched" :key="dish.id">
                    <tr>
                        <td>{{ dish.number }}{{ dish.number_addition }}.</td>
                        <td v-html="dish.name"></td>
                        <td>{{ dish.category.name }}</td>
                        <td>{{ euro((dish.amount || 1) * dish.price) }}</td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <small><em>{{ dish.description }}</em></small>
                        </td>
                        <td colspan="2" class="w-50">
                            <div class="is-flex is-align-items-center">
                                <button class="button" @click="remove(dish)" :disabled="dish.amount === 0 || waiting">-</button>
                                <span class="mx-3">{{ dish.amount }}</span>
                                <button class="button" @click="add(dish)" :disabled="waiting">+</button>

                                <input class="input ml-3" type="text" :disabled="dish.amount === 0" v-model="dish.notes">
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <div class="modal" :class="{ 'is-active': modal }">
        <div class="modal-background"></div>

        <div class="modal-content box content">
            <p class="has-text-centered">Orderbedrag: {{ euro(total) }}</p>

            <div class="field">
                <label class="label" for="table">Wat is uw tafelnummer?</label>

                <div class="control">
                    <input class="input" type="number" min="1" step="1" name="table" id="table" v-model.number="order.table">
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button type="submit" class="button is-primary" @click="placeOrder">Bestellen</button>
                </div>

                <div class="control">
                    <button type="button" class="button" @click="modal = false">Annuleren</button>
                </div>
            </div>
        </div>

        <button class="modal-close is-large" aria-label="close" @click="modal = false"></button>
    </div>
</template>

<script>
import shared from '../../shared';

export default {
    name: "Order",

    data() {
        return {
            order: {
                table: null,
                items: [],
            },
            items: [],
            search: '',
            message: '',
            waiting: false,
            modal: false,
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

        total() {
            return _.sum(this.order.items.map(item => item.amount * item.price));
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

        enterDetails() {
            this.modal = true;
        },

        placeOrder() {
            this.modal = false;
            this.message = 'Bestelling geplaatst! U kunt over 10 minuten een volgende bestelling plaatsen.';
            this.waiting = true;

            axios.post('api/v1/orders', this.order)
                .then(res => {
                    if (res.status == 200) {
                        setTimeout(() => {
                            this.resetOrder();
                        }, 10 * 60 * 1000); // 10 m * 60 s * 1000 ms
                    }
                })
                .catch(error => {
                    if (error.response) {
                        let data = error.response.data;

                        // add errors to the error bag
                        this.message = data.message;
                    } else if (error.request) {
                        console.log(error.request);
                    } else {
                        console.error(error.message);
                    }
                });
        },

        resetOrder() {
            this.message = '';
            this.waiting = false;
            this.order = {
                table: null,
                items: [],
            };
            this.fetchItems();
        },
    },
}
</script>
