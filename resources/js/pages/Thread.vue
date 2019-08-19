<script>
    import Replies from "../components/Replies";

    export default {
        name: "Thread",

        props: ['defaultCount'],

        components: { Replies },

        data() {
          return {
              repliesCount: this.defaultCount
          }
        },

        methods: {
            reduce: function () {
                this.repliesCount--;
            }
        }
    }
</script>

<style scoped>

</style>