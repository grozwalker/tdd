<script>
    import Replies from "../components/Replies";
    import SubscribeButton from "../components/SubscribeButton";

    export default {
        name: "Thread",

        props: ['defaultCount'],

        components: { Replies, SubscribeButton },

        data() {
          return {
              repliesCount: this.defaultCount
          }
        },

        methods: {
            added: function () {
                this.repliesCount++;
            },

            reduce: function () {
                this.repliesCount--;
            }
        }
    }
</script>

<style scoped>

</style>