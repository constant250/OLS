<template>
    <div class="app-modal">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Family Type List</h6>
            </div>
            <div class="card-body">
               <v-client-table :data="familytypes" :columns="columns" :options="options">
                   <div slot="afterLimit" class="ml=2">
                       <div class="btn-group">
                           <a class="btn btn-info text-white" slot="afterLimit">Add Family Type</a>
                        </div>
                       </div>
                       <div class="btn-group" slot="actions" slot-scope="{row}">
                           <a class="btn btn-primary btn-sm" @click="familytypeDetail(row.id)">Edit</a>
                           <a class="btn btn-danger btn-sm text-white" @click="familytypeDelete(row.id)">Delete</a>
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
            return{
                familytypes: [],

                /* for table */
                columns: ['id', 'name', 'action'],
                options: {
                    initialPage:1,
                    perPage:10,
                    highlightMatches:true,
                    sortIcon: { base:'fas', up:'fa-sort-amount-up', down:'fa-sort-amount-down', is:'fa-sort'},
                    headings: {
                        id: '#',
                        name: 'Family Type',
                        action: 'Actions',
                    },
                    sortable: ['name'],
                    rowClassCallback(row){
                        return row.id = row.id;
                    },
                    columnClasses : {id: 'class-is'},
                    texts: {
                        filterPlaceholder: 'Search keywords'
                    },
                }

            }
        },
        created(){
            this.fetchlist();
        },
        methods: {
            fetchlist(){
                let vm = this;
                axios.get('/ft/list')
                .then( function (r) {
               /*       console.log(r.data); */
                     vm.familytypes = r.data
                     console.log(vm.familytypes);

                })
                .catch(function (error){
                  console.log(r.data);     
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