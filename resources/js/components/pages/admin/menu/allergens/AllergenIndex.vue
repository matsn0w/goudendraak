<template>
    <table class="table is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>Naam</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="allergen in allergens" :key="allergen.id">
                <td>{{ allergen.name }}</td>
                <td>
                    <a :href="`/admin/menu/allergens/${allergen.id}/edit`">Bewerken</a>
                </td>
            </tr>

            <tr v-if="allergens.length === 0">
                <td colspan="2">
                    <em>Er zijn geen allergenen gevonden!</em>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "AllergensIndex",

    data() {
        return {
            route: '/api/v1/allergens',
            allergens: [],
        }
    },

    mounted() {
        axios.get(this.route)
            .then(res => res.data)
            .then(res => this.allergens = res.data);
    },
}
</script>
