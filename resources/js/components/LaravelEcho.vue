<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 card card-body">
                <div v-for="message in messages">
                    <span
                        :class="message.to_id==to_id ? 'float-right':'float-left'"
                    >{{message.message}}</span>
                </div>
                <div class="form-inline">
                    <input
                        v-model="form.message"
                        type="text"
                        class="form-control"
                        style="width: calc(100% - 50px);"
                    >
                    <button @click.prevent="sendMessage()" class="btn btn-outline-primary">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                        >
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                            <path d="M0 0h24v24H0z" fill="none"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: ["to_id", "init_messages", "auth_id"],
    data() {
        return {
            messages: Object.keys(this.init_messages).map(key => {
                return this.init_messages[key];
            }),
            form: {
                to_id: this.to_id,
                message: ""
            }
        };
    },
    mounted() {
        Echo.channel("messages").listen("MesssageSent", e => {
            this.messages.push(e.message);
        });
    },
    methods: {
        sendMessage() {
            axios
                .post("/api/message", this.form)
                .then(response => {
                    this.messages.push({
                        message: this.form.message,
                        to_id: this.to_id
                    });
                    this.form.message = "";
                })
                .catch(error => console.log(error));
        }
    }
};
</script>
