<template>
    <form :action="route" method="post" @submit.prevent="save">
        <div class="field">
            <label class="label" for="code">Nummer</label>

            <div class="control">
                <input class="input" type="number" name="code" id="code" v-model="form.code">
            </div>

            <div class="content help is-danger">
                <ul v-if="response.errors.code !== undefined">
                    <li v-for="error in response.errors.code">{{ error }}</li>
                </ul>
            </div>
        </div>

        <div class="field">
            <label class="label" for="roles">Rol</label>

            <div class="control" v-for="role in roles" :key="role.id">
                <label class="checkbox">
                    <input type="checkbox" name="roles[]" :value="role.id" v-model="form.checked">
                    {{ role.name }}
                </label>
            </div>

            <div class="content help is-danger">
                <ul v-if="response.errors.checked !== undefined">
                    <li v-for="error in response.errors.checked">{{ error }}</li>
                </ul>
            </div>
        </div>

        <div class="field">
            <label class="label" for="password">Wachtwoord</label>

            <div class="control">
                <input class="input" type="password" name="password" id="password" v-model="form.password">
            </div>

            <div class="content help is-danger">
                <ul v-if="response.errors.password !== undefined">
                    <li v-for="error in response.errors.password">{{ error }}</li>
                </ul>
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-primary">Opslaan</button>
            </div>

            <div class="control">
                <a href="/admin/users" class="button">Terug</a>
            </div>
        </div>

        <p class="help">{{ response.message }}</p>
    </form>
</template>

<script>
export default {
    name: "UserEdit",
    props: [
        'id'
    ],
    data() {
      return {
        route: `/api/v1/users/${this.id}`,
        form: {
            checked: [],
        },
        roles: [],
        response: {
            message: '',
            errors: [],
        },
      };
    },
    mounted() {
        axios.get('/api/v1/roles')
            .then(res => res.data)
            .then(res => this.roles = res.data);

        axios.get(`${this.route}`)
            .then(res => res.data)
            .then(res => {
                this.form = res.data;
                this.form.checked = res.data.roles.map(role => role.id);
            });
    },
    methods: {
        save() {
            // submit form data
            axios.put(this.route, this.form)
                .then(res => {
                    if (res.status == 200) {
                        // update the form
                        this.form = res.data.data;
                        this.form.checked = res.data.data.roles.map(role => role.id);

                        // show a success message
                        this.response.message = 'User updated successfully!';
                        this.response.errors = [];                    }
                })
                .catch(error => {
                    if (error.response) {
                        let data = error.response.data;

                        // add errors to the error bag
                        this.response.message = data.message;
                        this.response.errors = data.errors;
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
