<template>
    <form :action="route" method="post" @submit.prevent="save">
        <div class="field">
            <label class="label" for="name">Naam</label>

            <div class="control">
                <input class="input" type="text" name="name" id="name" v-model="form.name">
            </div>

            <div class="content help is-danger">
                <ul v-if="response.errors.name !== undefined">
                    <li v-for="error in response.errors.name">{{ error }}</li>
                </ul>
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-primary">Opslaan</button>
            </div>

            <div class="control">
                <a href="/admin/menu/allergens" class="button">Terug</a>
            </div>
        </div>

        <p class="help">{{ response.message }}</p>
    </form>
</template>

<script>
export default {
    name: "AllergensCreate",

    data() {
      return {
        route: '/api/v1/allergens',
        form: {},
        response: {
            message: '',
            errors: [],
        },
      };
    },

    methods: {
        save() {
            // submit form data
            axios.post(this.route, this.form)
                .then(res => {
                    if (res.status == 201) {
                        // reset the form
                        this.form = {};

                        // show a success message
                        this.response.message = 'Allergen created successfully!';
                        this.response.errors = [];
                    }
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
