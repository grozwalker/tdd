<template>
    <div :id="`reply-${reply.id}`" class="card">
        <div class="card-header">
            <div class="level">
                <div class="info">
                    <a :href="`/profile/${reply.owner.name}`">
                        {{ reply.owner.name }}
                    </a> said {{ reply.created_at}}
                </div>

<!--                @auth-->
                <div v-if="signedIn">
                    <favorite :reply="reply" v-cloak></favorite>
                </div>
                <!-- @endauth-->
            </div>
        </div>
        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-link mr-4" @click="editing = false">Close</button>
                <button type="submit" class="btn btn-sm btn-success" @click="update()">Save</button>
            </div>
            <div v-else v-text="body">
            </div>
        </div>

        <div class="card-footer level" v-if="canUpdate">
            <button type="submit" class="btn btn-sm btn-secondary" @click="editing = true">Edit</button>
            <button type="submit" class="btn btn-sm btn-danger" @click="destroy()">Delete</button>

        </div>
    </div>
</template>

<script>
    import favorite from "./Favorite";

    export default {
        props: ['data'],

        components: { favorite },

        data() {
            return {
                editing: false,
                reply: this.data,
                body: this.data.body
            }
        },

        computed: {
            signedIn: function() {
                return window.App.signedIn
            },
            canUpdate: function () {
                return this.authorize(user => this.reply.user_id === user.id)
                //return this.reply.user_id === window.App.user.id;
            }
        },

        methods: {
            update: function () {
                axios.patch('/replies/' + this.data.id, {
                    'body': this.body
                }).then(
                    () => {
                        this.editing = false;

                        flash('Reply is updated');
                    }
                );
            },

            destroy: function () {
                axios.delete('/replies/' + this.data.id).then(
                    () => this.$emit('destroy', this.data.id)
                );
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
