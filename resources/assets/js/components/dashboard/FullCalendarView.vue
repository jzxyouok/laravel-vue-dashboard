<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>
    export default {

        data () {
            return {
                error: null,
                loading: false,
                calendarData: null
            }
        },
        created () {
            // fetch the data when the view is created and the data is
            // already being observed
            this.fetchData()
        },
        watch: {
            // call again the method if the route changes
            '$route': 'fetchData'
        },
        methods: {
            fetchData () {
                this.error = this.calendarData = null
                this.loading = true

                this.$http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');
                this.$http.get('/calendar/sb').then(({response}) => {
console.log(response)
                    this.calendarData = response
                    this.loading = false
                }, (response) => {
                    // error callback
                    console.log(response.status)
                    console.log(response.statusText)
                });
            },
        },
    }
</script>

<style lang="scss">

</style>