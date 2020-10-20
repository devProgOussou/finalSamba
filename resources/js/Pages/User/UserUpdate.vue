<template>
<layout>
    <div class="container">
        <form @submit.prevent="handleSubmit">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">This is the Edit Page</h1>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Civilité</label>

                        <div class="col-md-6">
                            <select name="civility" v-model="personal.civility" class="custom-select">
                                <option value="M">Homme</option>
                                <option value="F">Femme</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" v-model="personal.name" name="name" required autocomplete="name" autofocus>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-4 col-form-label text-md-right">Adresse</label>

                        <div class="col-md-6">
                            <input type="text" name="address" v-model="personal.address" class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Téléphone</label>

                        <div class="col-md-6">
                            <input type="text" v-model="personal.phone" name="phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-outline-success">
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</layout>
</template>

<script>
import Layout from './../Shared/Layout.vue'

export default {
    components: {
        layout: Layout
    },
    props: {
        personalProp: Array
    },
    data: function () {
        return {
            personal: {
                name: ''
            }
        }
    },
    created() {
        this.personal = this.personalProp
    },
    methods: {
        async handleSubmit() {
            let response = await this.$inertia.put('/user/updateData', this.personal, )
            console.log(response)
        }
    },
}
</script>
