<template>
    <div class="columns">
        <div class="column component">
            <table class="table is-fullwidth">
                <thead>
                    <tr>
                        <th>Tafel</th>
                        <th>Tijd</th>
                        <th>Bedrag</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <template v-for="sale in sales" :key="sale.id">
                        <tr>
                            <td>{{ sale.table }}</td>
                            <td>{{ sale.time }}</td>
                            <td>{{ euro(sale.financial.turnover) }}</td>
                            <td>
                                <button class="button is-small is-pulled-right" @click="showDetails(sale)">Details</button>
                            </td>
                        </tr>

                        <tr :hidden="!sale.showDetails">
                            <td colspan="5">
                                <table class="table is-narrow is-fullwidth">
                                    <thead>
                                        <tr>
                                            <th>Naam</th>
                                            <th>Nummer</th>
                                            <th>Prijs</th>
                                            <th>Aantal</th>
                                            <th>Subtotaal</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="item in sale.items">
                                            <td>{{ item.name }}</td>
                                            <td>{{ item.number }}{{ item.number_addition }}</td>
                                            <td>{{ euro(item.price) }}</td>
                                            <td>{{ item.amount }}</td>
                                            <td>{{ euro(item.amount * item.price) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </template>

                    <tr v-if="sales.length === 0">
                        <td colspan="4"><em>Er zijn nog geen orders!</em></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import shared from '../shared';

export default {
    name: "Orders",

    data() {
        return {
            sales: [],
        }
    },

    mounted() {
        this.loadOrders();
    },

    created() {
        this.euro = shared.euro.bind(this);
    },

    methods: {
        loadOrders() {
            let date = Date.now();

            // get sales
            axios.get('/api/v1/orders', {
                params: {
                    startdate: new Intl.DateTimeFormat('nl').format(date),
                    enddate: new Intl.DateTimeFormat('nl').format(date),
                }
            })
                .then(res => res.data)
                .then(res => {
                    this.sales = res.data.filter(sale => sale.table); // only sales that have a table set
                });
        },

        showDetails(sale) {
            sale.showDetails = !sale.showDetails;
        },
    },
}
</script>
