<template>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="pusher">
                    <div class="form-group">
                        <v-select v-model="selectedUser"
                                  :options="usersList"
                                  label="name"
                                  placeholder="Choose user"
                        ></v-select>
                    </div>

                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea v-model="message"
                                  class="form-control"
                                  rows="5" id="comment"
                        ></textarea>
                    </div>

                    <button @click="send" type="button" class="btn btn-primary">
                        Send
                    </button>
                </div>
            </div>
            <div class="col-md-5">
                <div class="notify-wrapper">
                    <div class="notify" @click="showUnreadMessages">
                        <i class="far fa-bell fa-3x"></i>
                        <div class="count-unread"
                             v-show="unreadMessages.length"
                             v-text="unreadMessages.length"
                        ></div>
                    </div>
                </div>

                <div class="notify-messages" v-show="messages.length">
                    <div class="message" v-for="message in messages">
                        <div class="user-info">
                            <p>User {{ message.sender.name }} sent you a message:</p>
                            <span>{{ message.data }}</span>
                        </div>

                        <p>
                            {{ message.text }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    var socket = io('http://127.0.0.1:3008');
    import vSelect from 'vue-select';

    export default {
        name: "ChatComponent",
        components: {
            'v-select': vSelect,
        },
        data() {
            return {
                user: {},
                usersList: [],
                selectedUser: '',
                message: '',
                unreadMessages: [],
                messages: [],
            }
        },
        mounted() {
            this.getUser();
            this.getUserList();

            socket.on('chat-channel:App\\Events\\UserPushMessage', (data) => {
                if (data.receiver.id === this.user.id) {
                    this.unreadMessages.push(data);
                }
            })
        },
        methods: {
            getUser: function() {
                axios.get('/api/user', {
                    params: {
                        format: 'json'
                    }
                }).then(response => {
                    if (response.data) {
                        this.user = response.data;
                    }
                });
            },
            getUserList: function () {
                axios.get('/api/users', {
                    params: {
                        format: 'json'
                    }
                }).then(response => {
                    if (response.data) {
                        this.usersList = response.data;
                    }
                });
            },
            showUnreadMessages: function() {
                this.messages = this.messages.concat(this.unreadMessages);
                this.unreadMessages = [];
            },
            send: function () {
                if (!this.selectedUser) {
                    alert('Choose User');
                    return;
                }
                axios.post('/push', {
                    user_id: this.selectedUser.id,
                    message: this.message,
                }).then(response => {
                    if (response.status === 200) {
                        this.message = '';
                    }
                }).catch(error => {
                    if (error.response.data.errors.message.length) {
                        let errors = error.response.data.errors.message;
                        let errorMessage = '';
                        for (let index in errors) {
                            if (!errors.hasOwnProperty(index)) continue;
                            errorMessage += errors[index];
                        }
                        alert(errorMessage);
                    }
                });
            }
        }
    }
</script>

<style lang="scss">
    .dropdown-toggle::after {
        display: none;
    }
    .notify-wrapper {
        text-align: right;
        .notify {
            display: inline-block;
            position: relative;
            cursor: pointer;
            i {
                color: blue;
            }
            .count-unread {
                display: flex;
                justify-content: center;
                vertical-align: middle;
                align-items: center;
                position: absolute;
                right: -5px;
                z-index: 10;
                bottom: 0;
                color: white;
                background-color: red;
                border-radius: 50%;
                height: 25px;
                min-width: 25px;
            }
        }
    }
    .notify-messages {
        .message {
            background-color: #f0e6ff;
            border-radius: 4px;
            padding: 5px 10px;
            margin: 5px 0;
            p {
                margin: 0;
            }
            .user-info {
                margin: 0 0 15px;
                p {
                    color: #484848;
                }
                span {
                    font-size: 12px;
                    color: #9e9e9e;
                }
            }
        }
    }
</style>
