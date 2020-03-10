<template>
    <div class="app-modal">
        <create-family-type
            v-bind:form-settings='makeForm'
            v-bind:form-values='getValues'
            v-bind:save-form='"/family-type"'
            v-bind:modal-title='"Add Family Type"'
            v-bind:back-route='"/family-type"'

        >

        </create-family-type>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Family Type List</h6>
            </div>
            <div class="card-body">
               <v-client-table :data="familytypes" :columns="columns" :options="options">
                   <div slot="afterLimit" class="ml=2">
                       <div class="btn-group">
                           <a class="btn btn-info text-white" @click="showCreateFamilyType" slot="afterLimit">Add Family Type</a>
                        </div>
                       </div>
                       <div class="btn-group" slot="action" slot-scope="{row}">
                           <a class="btn btn-primary btn-sm text-white" @click="familytypeDetail(row.id)"><i class="fas fa-pen-nib"></i></a>
                           <a class="btn btn-danger btn-sm text-white" @click="familytypeDelete(row.id)"><i class="fas fa-dumpster"></i></a>
                   </div>
                   </v-client-table>
            </div>
        </div>
    </div>
</template>


<script>


    import CreateFamilyType from './../globals/form/createModalComponent.vue'

    export default {
        name:'app-modal',
        components: {
            CreateFamilyType
        },
        data(){
            return{

                

                /* for create modal */
                makeForm: [{
                    FormBody: [{
                        
                        type: 'text',
                        label: 'Family Type Name',
                        name: 'name'                   
                    },
                    ]
                    
                }],

                /* for value */
                getValues: {},

                /* for list */
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
                        action: 'Action',
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
            this.fetchList();
        },
        methods: {
            fetchList(){
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
            },

            showCreateFamilyType(){
                console.log(this.makeForm);
                this.$modal.show('size-modal')
            },
            familytypeDetail (id) {
                window.location.href = '/family-type/'+id;
                alert(id);
            },
            familytypeDelete (id) {
                let vm = this;
                swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {

                    axios.delete('/family-type/'+id)
                    .then(function(res){
                        if(res.data.status == 'success')
                        {
                            swal.fire(
                            'Deleted!',
                            'Your Family Type has been deleted.',
                            'success'
                            )
                        vm.fetchList();
                        
                        }
                    })
                    .catch(function(error){
                        consol.log(error);
                    });
                    
                }
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