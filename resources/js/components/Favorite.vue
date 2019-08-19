<template>
        <button type="submit" class="btn btn-outline-info" @click="toggle()">
            <i :class="iaActive" aria-hidden="true"></i>
            <span v-text="this.favoriteCount"></span>
        </button>
</template>

<script>
    export default {
        name: "favorite",

        props: ['reply'],

        data() {
            return {
                favoriteCount: this.reply.favoritesCount,
                isActive: this.reply.isFavorited
            }
        },

        computed: {
            iaActive: function () {
                return ['fa fa-heart', this.isActive ? 'isFavorited' : '']
            },

            endpoint: function () {
                return `/replies/${this.reply.id}/favorites`;
            }
        },

        methods: {
            toggle: function () {
                this.isActive ? this.destroy() : this.create();
            },

            destroy: function () {
                axios.delete(this.endpoint).then(
                    () => {
                        this.favoriteCount--;
                        this.isActive = false;
                    }
                );
            },

            create: function () {
                axios.post(this.endpoint).then(
                    () => {
                        this.favoriteCount++;
                        this.isActive = true;
                    }
                );
            }
        }
    }
</script>

<style scoped>
    .isFavorited {
        color: red;
    }
</style>