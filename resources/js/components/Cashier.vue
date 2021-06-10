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
                                    <button class="is-pulled-right" type="button">Toevoegen</button>
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
            </div>

            <div class="block component">
                <div class="is-size-5 has-text-weight-bold is-flex is-flex-direction-row is-justify-content-space-between is-align-items-center">
                    <p>Totaal:</p>
                    <p>{{ euro(total) }}</p>
                    <div>
                        <button class="is-block mb-1" type="button">Afrekenen</button>
                        <button class="is-block" type="button">Verwijderen</button>
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
            total: 0,
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
        }
    }
}
</script>
