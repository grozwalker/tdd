<template>
    <button :class="classes" @click="subscribe" v-text="title"></button>
</template>

<script>
    export default {
        name: "SubscribeButton",

        props: ['active'],

        data() {
            return {
                activeStatus: this.active
            }
        },

        computed: {
            title: function () {
                return this.activeStatus ? 'Отписаться' : 'Подписаться';
            },

            classes: function() {
                return ['btn', this.activeStatus ? 'btn-outline-secondary' : 'btn-primary'];
            }
        },

        methods: {
            subscribe: function() {
                axios[
                    this.activeStatus ? 'delete' : 'post'
                    ](`${location.pathname}/subscriptions`)
                    .then(response => {
                        this.activeStatus = !this.activeStatus;
                    })
            }
        }
    }
</script>

<style scoped>

</style>