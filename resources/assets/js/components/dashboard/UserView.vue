<template>
    <div class="user-view container">
        <div class="row">
            <div class="col-md-12">

                <div id="users" class="users">
                    <div class="panel panel-default">
                        <div class="panel-heading">Users</div>

                        <div class="loading" v-if="loading">
                            Loading...
                        </div>

                        <div v-if="error" class="error">
                            {{ error }}
                        </div>

                        <div v-if="tableData" >
                            <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data () {
            return {
                error: null,
                loading: false,
                tableData: null
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
                this.error = this.data = null
                this.loading = true

                this.columns = [
                    'name',
                    'email',
                    'phone',
                    'registration_date'
                ]

                this.options = {
                    dateColumns: ['registration_date'],
                    headings: {
                        name: 'Name',
                        email: 'Email',
                        phone: 'Phone',
                        registration_date: 'Registration Date',
                        // edit: 'Edit',
                        // delete: 'Delete'
                    },
                    // templates: {
                    //     edit: function(h, row) {
                    //         return <edit id={row.id}></edit>
                    //     },
                    //     delete: function(h, row) {
                    //         return <delete id={row.id}></delete>
                    //     }
                    // },
                }

                    // templates: {
                    //     edit: function(h, row) {
                    //         return "<a href='/user/{id}/edit'><i class='glyphicon glyphicon-edit'></i></a>"
                    //     },
                    //     delete: function(h, row) {
                    //         return "<a href='javascript:void(0);' @click='$parent.deleteMe({id})'><i class='glyphicon glyphicon-erase'></i></a>"
                    //     }
                    // },

                this.$http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#_token').getAttribute('content');
                this.$http.get('/api/users').then(({data}) => {
                    this.tableData = data
                    this.loading = false
                }, (response) => {
                    // error callback
                    console.log(response.status);
                    console.log(response.statusText);
                });
            },
            deleteMe: function(id) {
                alert("Delete " + id);
            },
        },
    }
</script>

<style lang="scss">
    th,
    td {
        text-align: left;
    }

    th:nth-child(n+2), td:nth-child(n+2) {
        text-align: center;
    }

    thead tr:nth-child(2) th {
        font-weight: normal;
    }

    .VueTables__sort-icon {
        margin-left: 10px;
    }

    .VueTables__dropdown-pagination {
        margin-left: 10px;
    }

    .VueTables__highlight {
        background: yellow;
        font-weight: normal;
    }

    .VueTables__sortable {
        cursor: pointer;
    }

    .VueTables__date-filter {
        border: 1px solid #ccc;
        padding: 6px;
        border-radius: 4px;
        cursor: pointer;
    }

    .VueTables__filter-placeholder {
        color: #aaa;
    }

    .VueTables__list-filter {
        width:120px;
    }
</style>