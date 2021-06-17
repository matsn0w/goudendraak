<template>
    <table class="table is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>Nummer</th>
                <th>Rollen</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.code }}</td>
                <td>{{ user.roles.map(role => role.name).join(', ') }}</td>
                <td>
                    <a :href="`/admin/users/${user.id}/edit`">Bewerken</a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "UserIndex",

    data() {
        return {
            route: '/api/v1/users',
            users: [],
        }
    },

    mounted() {
        axios.get(this.route)
            .then(res => res.data)
            .then(res => this.users = res.data);
    },
}
</script>
