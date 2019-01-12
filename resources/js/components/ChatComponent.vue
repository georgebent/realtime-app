<template>
    <ul>
        <li v-for="user in users">
            {{ user }}
        </li>
    </ul>
</template>

<script>
    var socket = io('http://127.0.0.1:3008');

    export default {
        name: "ChatComponent",
        data() {
            return {
                users: []
            }
        },
        mounted() {
            socket.on('test-channel:App\\Events\\UserSignedUp', (data) => {
                this.users.push(data.user.name);
            })
        },
    }
</script>

<style scoped>

</style>
