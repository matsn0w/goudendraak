<template>
    <table class="table is-striped is-hoverable">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Nummer</th>
                <th>Prijs</th>
                <th>Categorie</th>
                <th>Omschrijving</th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="item in items" :key="item.id">
                <td v-html="item.name"></td>
                <td>{{ item.number }}{{ item.number_addition }}</td>
                <td>{{ euro(item.price) }}</td>
                <td>{{ item.category.name }}</td>
                <td>{{ item.description }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "Dishes",
    data() {
        return {
            items: [],
        }
    },
    mounted() {
        axios.get('/api/v1/menuitems')
            .then(res => res.data)
            .then(res => this.items = res.data);
    },
     methods: {
        euro(price) {
            let f = new Intl.NumberFormat('nl-NL', {
                style: 'currency',
                currency: 'EUR',
            });

            return f.format(price);
        },
     }
}
</script>
