<template>
    <table class="table is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>Titel</th>
                <th>Datum</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="item in items" :key="item.id">
                <td>{{ item.title }}</td>
                <td>{{ item.date }}</td>
                <td>
                    <a :href="`/admin/news/${item.id}/edit`">Bewerken</a>
                </td>
            </tr>

            <tr v-if="items.length === 0">
                <td colspan="3">
                    <em>Er is geen nieuws!</em>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "NewsIndex",
    data() {
        return {
            route: '/api/v1/newsitems',
            items: [],
        }
    },
    mounted() {
        axios.get(this.route)
            .then(res => res.data)
            .then(res => this.items = res.data);
    }
}
</script>
