<template>
    <form :action="route" method="post" @submit="save">
        <p>{{ response.message }}</p>

        <div>
            <label for="title">Titel</label>
            <input type="text" name="title" id="title" v-model="form.title">
            <ul>
                <li v-for="error in response.errors.title">{{ error }}</li>
            </ul>
        </div>

        <div>
            <label for="body">Inhoud</label>
            <textarea name="body" id="body" cols="30" rows="10" v-model="form.body"></textarea>
            <ul>
                <li v-for="error in response.errors.body">{{ error }}</li>
            </ul>
        </div>

        <div>
            <button type="submit">Opslaan</button>
        </div>
    </form>
</template>

<script>
export default {
    name: "NewsCreate",
    data() {
      return {
        route: '/api/v1/newsitems',
        form: {
            title: null,
            body: null,
        },
        response: {
            message: '',
            errors: [],
        },
      };
    },
    methods: {
        save(e) {
            e.preventDefault();

            // reset errors
            this.errors = [];

            // reset success
            this.success = '';

            // submit form data
            axios.post(this.route, this.form)
                .then(res => {
                    if (res.status == 201) {
                        // reset the form
                        this.form = {};

                        // show a success message
                        this.response.message = 'News item created successfully!';
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
