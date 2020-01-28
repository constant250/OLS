<template>
    <div class="app-modal">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Family List</h6>
            </div>
            <div class="card body">
                    <v-client-table :data="disciplines" :columns="columns" :options="options">
                        <div slot="afterLimit" class="ml-2">
                            <div class="btn-group">
                                <a class="btn btn-info" slot="afterLimit">Add Family</a>
                            </div>
                        </div>
                        <div class="btn-group" slot="actions" slot-scope="{row}">
                            <a class="btn btn-primary btn-sm" @click="disciplineDetail(row.id)">Edits</a>
                            <a class="btn btn-danger btn-sm text-white" @click="disciplineDelete(row.id)">Delete</a>
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
        data() {
            return {
                disciplines: [],

                // for table
                columns: ['id','name', 'action'],
                optionsz: {
                    initialPage:1,
                    perPage:10,
                    highlightMatches:true,
                    sortIcon: {base:'fas',up:'fa-sort-amount-down', down:'fa-sort-amount-down', is:'fa-sort'},
                    headings: {
                        id: '#',
                        name:'Discipline',
                        action:'Actions',
                    },
                    sortable: ['name'],
                    rowClassCallback(row){
                        return row.id=row.id;
                    },
                    columnClassess: {id:'class-is'},
                    text: {
                        filterPlaceholder: 'Seach keywords'
                    }
                }
            }
        },
        created() {
            this.fetchList();
        },
        methods: {
            fetchList() {
                let vm=this;
                axios.get('/discip/list')
                .then(function(r){
                    console.log(r.data);
                    vm.disciplines=r.data;
                })
                .catch(function(error){
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