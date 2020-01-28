<template>
    <div class="app-modal">
        <div class="card shadow mb-4"> 
            <!-- mb -> margin bottom -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Sub-disciplines</h6>
            </div>
            <div class="card-body">
                <v-client-table :data="subdiscipline" :columns="columns" :options="options">
                    <div slot= "afterLimit" class="ml-2">
                        <div class="btn-group">
                            <a class="btn btn-info" slot="afterLimit">Add Sub-Category</a>
                        </div>
                    </div>
                    <div class = "btn-group" slot="actions" slot-scope="{row}">
                        <a class="btn btn-primary btn-sm" @click="subdisciplineDetail(row.id)">Edit</a>
                        <a class="btn btn-danger btn-sm text-white" @click="subdisciplineDetail(row.id)">Delete</a>
                    </div>
                </v-client-table>
            </div>
            
        </div>
    </div>

</template>


<script>

    export default {
        name:'app-modal',
        components: {},
        data(){
            return {
                subdiscipline: [],

                //for table
                columns: ['id', 'name', 'action'],
                options: {
                    initialPage:1,
                    perPage:10,
                    highlightMatches:true,
                    sortIcon: { base:'fas', up:'fa-sort-amount-up', down:'fa-sort-amount-down', is:'fa-sort'},
                    headings: {
                        id: '#',
                        name: 'Sub-Discipline',
                        action: 'Actions'
                    },
                    sortable: ['name'],
                    rowClassCallback(row) {
                        return row.id = row.id
                    },
                    columnClasses: {id: 'class-is'},
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
                console.log(vm.subdiscipline);
                axios.get('/subdiscip/list')
                .then( function(r) {
                    vm.subdiscipline = r.data
                    console.log(vm.subdiscipline);
                } )
                .catch( function (error) {
                    console.log (error);
                } )
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