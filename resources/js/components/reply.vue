<script>
    import favorite from "./favorite";

    export default {
        props: ['attributes'],

        components: { favorite },

        data() {
            return {
                editing: false,
                body: this.attributes.body
            }
        },

        methods: {
            update: function () {
                axios.patch('/replies/' + this.attributes.id, {
                    'body': this.body
                }).then(
                    () => {
                        this.editing = false;

                        flash('Reply is updated');
                    }
                );
            },

            destroy: function () {
                axios.delete('/replies/' + this.attributes.id).then(
                    () => {
                        $(this.$el).fadeOut(300, () => {
                            flash('Reply is deleted');
                        });
                    }
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
