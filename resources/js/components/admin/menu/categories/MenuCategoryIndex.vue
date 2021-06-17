<template>
    <form action="" method="get" class="block">
        <div class="field">
            <div class="control">
                <input class="input" type="text" name="s" placeholder="Zoek een categorie..." v-model="search">
            </div>
        </div>
    </form>

    <table class="table is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>Naam</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="category in categoriesSearched" :key="category.id">
                <td>{{ category.name }}</td>
                <td>
                    <a :href="`/admin/menu/categories/${category.id}/edit`">Bewerken</a>
                </td>
            </tr>

            <tr v-if="categoriesSearched.length === 0">
                <td colspan="2">
                    <em>Er zijn geen categorieën gevonden!</em>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>

export default {
    name: "MenuCategoryIndex",
    data() {
        return {
            route: '/api/v1/menucategories',
            categories: [],
            search: '',
        }
    },
    computed: {
        categoriesSearched() {
            const s = this.search?.toLowerCase();

            return this.categories.filter((category) => {
                if (category.name?.toLowerCase().includes(s)) {
                    return true;
                }

                return false;
            });
        },
    },
    mounted() {
        axios.get(this.route)
            .then(res => res.data)
            .then(res => this.categories = res.data);
    },
}
</script>
