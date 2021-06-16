<template>
    <table>
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
        </tbody>
    </table>

    <a href="/admin/news/create">Nieuw</a>
</template>

<script>
export default {
    name: "News",
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
