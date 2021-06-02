<template>
    <div v-for="item in items" :key="item.id">
        <h2>{{ item.title }}</h2>
        <p>{{ item.date }}</p>
        <p>{{ item.body }}</p>
    </div>
</template>

<script>
export default {
    name: "News",
    data() {
        return {
            items: [],
        }
    },
    mounted() {
        axios.get('/api/v1/newsitems')
            .then(res => res.data)
            .then(res => this.items = res.data);
    }
}
</script>
