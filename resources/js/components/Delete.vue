<template>
    <button class="button is-inverted is-danger" @click="delete">Verwijderen</button>
</template>

<script>
    export default {
        name: 'Delete',

        props: [
            'route',
            'redirect',
        ],

        methods: {
            delete() {
                axios.delete(this.route)
                    .then(res => {
                        if (res.status === 204) {
                            alert('Deleted successfully!');
                            location.href = this.redirect;
                        }
                    })
                    .catch(error => {
                        if (error.response) {
                            alert(error.response.data.message);
                        } else if (error.request) {
                            console.log(error.request);
                        } else {
                            console.error(error.message);
                        }
                    });
            },
        },
    }
</script>
