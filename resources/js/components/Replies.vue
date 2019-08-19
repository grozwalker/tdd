<template>
    <div>
        <div v-for="reply in replies" :key="reply.id" class="mb-4 mt-4">
            <reply :data="reply" @destroy="remove"></reply>
        </div>
    </div>
</template>

<script>
    import Reply from './Reply';

    export default {
        name: "Replies",

        props: ['data'],

        components: { Reply },

        data() {
            return {
                replies: this.data
            }
        },

        methods: {
            remove: function (id) {
                this.replies = this.replies.filter(reply => {
                   return reply.id !==  id;
                });

/*                this.$emit('reduce');

                flash('Reply has been deleted');*/
            }
        }
    }
</script>

<style scoped>

</style>