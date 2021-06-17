<template>
    <form action="" method="get" class="block">
        <div class="field">
            <div class="control">
                <input class="input" type="text" name="s" placeholder="Zoek een gerecht..." v-model="search">
            </div>
        </div>
    </form>

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
            <tr v-for="item in itemsSearched" :key="item.id">
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
import shared from '../../../shared';

export default {
    name: "Dishes",

    data() {
        return {
            items: [],
            search: '',
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
    },

    mounted() {
        axios.get('/api/v1/menuitems')
            .then(res => res.data)
            .then(res => this.items = res.data);
    },

    created() {
        this.euro = shared.euro.bind(this);
    },
}
</script>
