<template>
    <div>
        <div v-for="reply in replies" :key="reply.id" class="mb-4 mt-4">
            <reply :data="reply" @destroy="remove"></reply>
        </div>

        <paginator :data-set="dataSet" @refetch="fetch"></paginator>

        <new-reply @added="add"></new-reply>
    </div>
</template>

<script>
    import Reply from './Reply';
    import NewReply from "./NewReply";
    import collection from "../mixins/collection";

    export default {
        name: "Replies",

        components: { Reply, NewReply },

        mixins: [collection],

        data() {
            return {
                replies: [],
                dataSet: null
            }
        },

        computed: {
            url: function () {
                return location.pathname + '/replies';
            }
        },

        created() {
          this.fetch();
        },

        methods: {
            fetch: function (page) {

                if (! page) {
                    const query = location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1;
                }

                axios.get(`${this.url}?page=${page}`).then(( {data} ) => this.refresh(data));
            },

            refresh: function (response) {
                this.replies = response.data;
                this.dataSet = response;
            }
        }
    }
</script>

<style scoped>

</style>