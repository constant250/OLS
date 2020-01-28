<template>
    <div class="app-modal">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Family List</h6>
            </div>
            <div class="card-body">
                <v-client-table :data="families" :columns="columns" :options="options">
                    <div slot="afterLimit" class="ml-2">
                        <div class="btn-group">
                            <a class="btn btn-info text-white" slot="afterLimit">Add Family</a>
                        </div>
                    </div>
                    <div class="btn-group" slot="actions" slot-scope="{row}">
                        <a class="btn btn-primary btn-sm" @click="familyDetail(row.id)">Edit</a>
                        <a class="btn btn-danger btn-sm text-white" @click="familyDelete(row.id)">Delete</a>
                    </div>
                </v-client-table>
            </div>
        </div>
    </div>
</template>


<script>

    export default {
        name:'app-modal',
        components:  {},
        data() {
            return {
                families: [],

                // for table
                columns: ['id', 'name', 'action'],
                options: {
                    initalPage:1,
                    perPage:10,
                    highlightMatches:true,
                    sortIcon: { base:'fas', up:'fa-sort-amount-up', down:'fa-sort-amount-down', is:'fa-sort'},
                    headings: {
                        id: '#',
                        name: 'Family',
                        action: 'Actions'
                    },
                    sortable: ['name'],
                    rowClassCallback(row) {
                        return row.id = row.id;
                    },
                    columnClassess : {id: 'class-is'},
                    texts: {
                        filterPlaceholder: 'Search keywords'
                    }
                }


            }
        },
        created() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                let vm = this;
                console.log(vm.families);
                axios.get('/families/list')
                .then( function (r) {
                    vm.families = r.data;
                    console.log(vm.families);
                })
                .catch(function (error) {
                    console.log(error);
                })
            }
        } 
    }
   
</script>

<style>
    th{
        background-color: #36b9cc;
        text-align: center;
        color: #fff;
        border:1px solid #36b9cc !important;
        vertical-align: middle !important;
    }
    td.text-center{
        border-right-color: #fff !important;
        border-left-color: #fff !important;
        vertical-align: middle !important;
    }
</style>