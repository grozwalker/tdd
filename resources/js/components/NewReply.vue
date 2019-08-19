<template>
    <div>
        <div v-if="signedIn">
            <div class="form-group">
        <textarea
                class="form-control"
                id="body"
                name="body"
                rows="5"
                placeholder="Type your answear"
                v-model="body"
                required
        ></textarea>
            </div>

            <button
                    type="submit"
                    class="btn btn-primary"
                    @click="add"
            >Add</button>
        </div>
        <p v-else class="text-center">Please <a href="/login">sign in</a> to participate in forum.</p>
    </div>


</template>

<script>
    export default {
        name: "NewReply",

        data() {
            return {
                body: '',
                endpoint: location.pathname + '/replies'
            }
        },

        computed: {
            signedIn: function () {
              return window.App.signedIn;          }
        },

        methods: {
            add: function () {
                axios.post(this.endpoint, { body: this.body})
                    .then(({ data }) => {
                        this.body = '';

                        flash('Reply has been added');

                        this.$emit('added', data);
                });
            }
        }
    }
</script>

<style scoped>

</style>