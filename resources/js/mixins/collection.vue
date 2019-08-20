<script>
    export default {
        name: "collection",

        data() {
          return {
              items: []
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