<template>
    <div class="columns">
        <div class="column">
            <div class="block component">
                <div v-for="category in categories" :key="category.id">
                    <h3>{{ category.name }}</h3>
                    <table>
                        <tbody>
                            <tr v-for="item in category.items" :key="item.id">
                                <td>{{ item.id }}</td>
                                <td>{{ item.name }}</td>
                                <td>€ {{ item.price }}</td>
                                <td>
                                    <button type="button">Toevoegen</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="column">
            <div class="block component">
                <!-- {{-- order --}} -->
            </div>

            <div class="block component">
                <!-- {{-- total --}} -->
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
        }
    },
    mounted() {
        axios.get('/api/v1/menuitems')
            .then(res => res.data)
            .then(res => this.categories = res.data);
    }
}
</script>
