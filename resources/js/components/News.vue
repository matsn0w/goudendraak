<template>
    <div class="news-item content" v-for="(item, index) in items" :key="item.id">
        <h2>{{ item.title }}</h2>
        <p>
            <small>{{ item.date }}</small><br>
            {{ item.body }}
        </p>

        <hr v-if="index != Object.keys(items).length - 1">
    </div>

    <div v-if="items == []">
        <h2>Er is geen nieuws!</h2>
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
