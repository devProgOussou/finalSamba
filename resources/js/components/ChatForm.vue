<template>
<div class="input-group">
    <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Ecrivez votre message ici..." v-model="newMessage" @keyup.enter="sendMessage">
    <input type="hidden" name="user_id" value="">
    <span class="input-group-btn">
        <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
            Envoyer
        </button>
    </span>
</div>
</template>

<script>
export default {
    props: ['user'],

    data() {
        return {
            newMessage: ''
        }
    },

    methods: {
        sendMessage() {
            this.$emit('messagesent', {
                user: this.user,
                message: this.newMessage
            });

            this.newMessage = ''
        }
    }
}
</script>
