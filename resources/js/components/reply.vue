<script>
    export default {
        props: ['attributes'],

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
