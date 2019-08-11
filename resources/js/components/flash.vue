<template>
    <div class="alert alert-success" role="alert" v-show="this.show">
        <strong>Success:</strong> {{ body}}
    </div>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                body: '',
                show: false
            }
        },

        created() {
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on('flash', ($message) => {
                this.flash($message);
            });
        },

        methods: {
            flash: function ($message) {
                this.body = $message;
                this.show = true;

                this.hide();
            },
            hide: function () {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    }
</script>

<style>
    .alert {
        position: fixed;
        top: 80px;
        right: 50px;
    }
</style>
