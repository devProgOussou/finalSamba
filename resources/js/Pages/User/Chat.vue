<template>
<layout>
    <div class="container">
        <form @submit.prevent="handleSubmit">
            <div class="container">
                <div class="row">
                    <div class="co-md-12" style="margin-left: 20rem;">
                        <table>
                            <tr v-for="message in messages" :key="message.id">
                                <td>
                                    {{ message.name }} : {{ message.created_at }} : {{ message.message }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <input type="hidden" name="receiver_id" v-model="message.sender_id">
            <div class="form-group row">
                <h2 class="col-md-12 text-center" v-for="message in messages" :key="message.id">Reponse pour : {{ message.name }}</h2>
                <label>
                    <textarea cols="30" rows="10" name="message" class="col-md-12" v-model="message.message" required style="margin-left: 17rem;"></textarea>
                </label>
            </div>
            <button style="margin-left: 30rem;" class="btn btn-outline-success">
                SEND MESSAGE
            </button>
        </form>
    </div>
</layout>
</template>

<script>
import Layout from './../Shared/Layout'

export default {
    components: {
        layout: Layout
    },
    props: ['messages', 'userReceiver'],
    data: function () {
        return {
            message: {
                receiver_id: '',
                message: '',
                chemin: pathname
            }
        }
    },
    created() {

    },
    methods: {
        async handleSubmit() {
            let response = await this.$inertia.post(`${chemin}`, {})
            console.log(response)
        }
    },
}
</script>
