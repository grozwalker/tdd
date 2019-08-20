<template>
    <nav aria-label="Page navigation example" v-if="shouldPaginatorShow">
        <ul class="pagination">
            <li class="page-item" v-show="prevUrl"><a class="page-link" href="#" @click.prevent="page--">Previous</a></li>
            <li class="page-item" v-show="nextUrl"><a class="page-link" href="#" @click.prevent="page++">Next</a></li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: "Paginator",

        props: ['dataSet'],

        data() {
            return {
                page: 1,
                nextUrl: false,
                prevUrl: false
            }
        },

        computed: {
            shouldPaginatorShow: function () {
                return !! (this.nextUrl || this.prevUrl);
            }
        },

        watch: {
            dataSet: function () {
                this.nextUrl = this.dataSet.next_page_url;
                this.prevUrl = this.dataSet.prev_page_url;
            },

            page: function () {
                this.broadcast().updateUrl();
            }
        },

        methods: {
            broadcast: function () {
                return this.$emit('refetch', this.page);
            },
            updateUrl: function () {
                history.pushState(null, null, `?page=${this.page}`)
            }
        }
    }
</script>

<style scoped>

</style>