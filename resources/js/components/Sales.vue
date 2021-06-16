<template>
    <div class="columns gap">
        <div class="column is-narrow bordered">
            <form action="#" method="post" @submit.prevent="generate">
                <div class="field">
                    <label class="label" for="startdate">Begindatum</label>

                    <div class="control">
                        <input class="input" type="date" name="startdate" id="startdate" v-model="form.startdate">
                    </div>

                    <p class="help is-danger"></p>
                </div>

                <div class="field">
                    <label class="label" for="enddate">Einddatum</label>

                    <div class="control">
                        <input class="input" type="date" name="enddate" id="enddate" v-model="form.enddate">
                    </div>

                    <p class="help is-danger"></p>
                </div>

                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-primary">Maak Overzicht</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="colum revenue">
            <p><span>Omzet:</span> <span>{{ euro(financial.turnover) }}</span></p>
            <p><span>BTW:</span> <span>{{ euro(financial.tax) }}</span></p>
            <p><span>excl. BTW:</span> <span>{{ euro(financial.profit) }}</span></p>
        </div>
    </div>

    <hr>

    <div class="columns">
        <div class="column component">
            <table class="table is-fullwidth">
                <thead>
                    <tr>
                        <th>Datum</th>
                        <th>Omzet</th>
                        <th>BTW</th>
                        <th>Brutowinst</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="sale in sales">
                        <td>{{ sale.date }}</td>
                        <td>{{ euro(sale.financial.turnover) }}</td>
                        <td>{{ euro(sale.financial.tax) }}</td>
                        <td>{{ euro(sale.financial.profit) }}</td>
                    </tr>

                    <tr v-if="sales.length === 0">
                        <td colspan="4"><em>Maak eerst een overzicht!</em></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Sales",
    data() {
        return {
            form: {
                startdate: null,
                enddate: null,
            },
            sales: [],
        }
    },
    computed: {
        financial() {
            return {
                turnover: _.sum(this.sales.map(sale => sale.financial.turnover)),
                tax: _.sum(this.sales.map(sale => sale.financial.tax)),
                profit: _.sum(this.sales.map(sale => sale.financial.profit)),
            };
        },
    },
    methods: {
        euro(price) {
            let f = new Intl.NumberFormat('nl-NL', {
                style: 'currency',
                currency: 'EUR',
            });

            return f.format(price);
        },

        generate() {
            // get sales
            axios.get('/api/v1/orders', {
                params: {
                    startdate: this.form.startdate,
                    enddate: this.form.enddate,
                }
            })
                .then(res => res.data)
                .then(res => this.sales = res.data);
        },
    }
}
</script>
