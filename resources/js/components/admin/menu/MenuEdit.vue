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

        <div class="field is-horizontal">
            <div class="field-body">
                <div class="field">
                    <label class="label" for="number">Nummer</label>

                    <div class="control">
                        <input class="input" type="number" name="number" id="number" v-model="form.number">
                    </div>

                    <div class="content help is-danger">
                        <ul v-if="response.errors.number !== undefined">
                            <li v-for="error in response.errors.number">{{ error }}</li>
                        </ul>
                    </div>
                </div>

                <div class="field">
                    <label class="label" for="number_addition">Toevoeging</label>

                    <div class="control">
                        <input class="input" type="text" name="number_addition" id="number_addition" v-model="form.number_addition">
                    </div>

                    <div class="content help is-danger">
                        <ul v-if="response.errors.number_addition !== undefined">
                            <li v-for="error in response.errors.number_addition">{{ error }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="category_id">Cateogrie</label>

            <div class="control">
                <div class="select is-fullwidth">
                    <select name="category_id" id="category_id" v-model="form.category_id">
                        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                    </select>
                </div>
            </div>

            <div class="content help is-danger">
                <ul v-if="response.errors.category_id !== undefined">
                    <li v-for="error in response.errors.category_id">{{ error }}</li>
                </ul>
            </div>
        </div>

        <div class="field">
            <label class="label" for="price">Prijs</label>

            <div class="control">
                <input class="input" type="number" min="0" step="any" name="price" id="price" v-model="form.price">
            </div>

            <div class="content help is-danger">
                <ul v-if="response.errors.price !== undefined">
                    <li v-for="error in response.errors.price">{{ error }}</li>
                </ul>
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Omschrijving</label>

            <div class="control">
                <textarea class="textarea" name="description" id="description" cols="30" rows="5" v-model="form.description"></textarea>
            </div>

            <div class="content help is-danger">
                <ul v-if="response.errors.description !== undefined">
                    <li v-for="error in response.errors.description">{{ error }}</li>
                </ul>
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-primary">Opslaan</button>
            </div>

            <div class="control">
                <a href="/admin/menu" class="button">Terug</a>
            </div>
        </div>

        <p class="help">{{ response.message }}</p>
    </form>
</template>

<script>
export default {
    name: "MenuEdit",
    props: [
        'id'
    ],
    data() {
      return {
        route: `/api/v1/menuitems/${this.id}`,
        form: {},
        categories: [],
        response: {
            message: '',
            errors: [],
        },
      };
    },
    mounted() {
        axios.get('/api/v1/categories')
            .then(res => res.data)
            .then(res => this.categories = res.data);

        axios.get(`${this.route}`)
            .then(res => res.data)
            .then(res => {
                this.form = res.data;
                this.form.category_id = res.data.category.id;
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
                        this.form.category_id = res.data.data.category.id;

                        // show a success message
                        this.response.message = 'Item updated successfully!';
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
