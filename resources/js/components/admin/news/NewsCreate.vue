<template>
    <form :action="route" method="post" @submit="save">
        <div class="field">
            <label class="label" for="title">Titel</label>

            <div class="contro">
                <input class="input" type="text" name="title" id="title" v-model="form.title">
            </div>

            <div class="content help is-danger">
                <ul v-if="response.errors.title !== undefined">
                    <li v-for="error in response.errors.title">{{ error }}</li>
                </ul>
            </div>
        </div>

        <div class="field">
            <label class="label" for="body">Inhoud</label>

            <div class="control">
                <textarea class="textarea" name="body" id="body" cols="30" rows="10" v-model="form.body"></textarea>
            </div>

            <div class="content help is-danger">
                <ul v-if="response.errors.body !== undefined">
                    <li v-for="error in response.errors.body">{{ error }}</li>
                </ul>
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-primary">Opslaan</button>
            </div>

            <div class="control">
                <a href="/admin/news" class="button">Terug</a>
            </div>
        </div>

        <p class="help">{{ response.message }}</p>
    </form>
</template>

<script>
export default {
    name: "NewsCreate",
    data() {
      return {
        route: '/api/v1/newsitems',
        form: {},
        response: {
            message: '',
            errors: [],
        },
      };
    },
    methods: {
        save(e) {
            e.preventDefault();

            // submit form data
            axios.post(this.route, this.form)
                .then(res => {
                    if (res.status == 201) {
                        // reset the form
                        this.form = {};

                        // show a success message
                        this.response.message = 'News item created successfully!';
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
