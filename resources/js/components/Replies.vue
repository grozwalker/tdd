<template>
    <div>
        <div v-for="reply in replies" :key="reply.id" class="mb-4 mt-4">
            <reply :data="reply" @destroy="remove"></reply>
        </div>


        <new-reply @added="add"></new-reply>
    </div>
</template>

<script>
    import Reply from './Reply';
    import NewReply from "./NewReply";

    export default {
        name: "Replies",

        props: ['data'],

        components: { Reply, NewReply },

        data() {
            return {
                replies: this.data
            }
        },

        methods: {
            add: function(data) {
                this.replies.push(data);

                this.$emit('added');
            },

            remove: function (id) {
                this.replies = this.replies.filter(reply => {
                   return reply.id !==  id;
                });

                this.$emit('reduce');

                flash('Reply has been deleted');
            }
        }
    }
</script>

<style scoped>

</style>