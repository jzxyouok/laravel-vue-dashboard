<template>
    <div class="dashboard-view container">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>
</template>

<script>
    export default {

        route: {
            data () {
                return this.$http.get('/dashboard')
                    .then(({data}) => ({ pusherKey: data }));
            },
        },

        data: function() {
            return {

            }
        },

        methods: {

        },

    };
</script>

<style lang="scss">

</style>