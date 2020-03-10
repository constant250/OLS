<template>
    <div class="app-modal">
        <create-family
            v-bind:form-settings='makeForm'
            v-bind:form-values='getValues'
            v-bind:save-form='"/family"'
            v-bind:modal-title='"Add Family"'
            v-bind:back-route='"/family"'
        >
        </create-family>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Family List</h6>
            </div>
            <div class="card-body">
                <v-client-table :data="families" :columns="columns" :options="options">
                    <div slot="afterLimit" class="ml-2">
                        <div class="btn-group">
                            <a class="btn btn-info text-white" @click="showCreateFamily" slot="afterLimit">Add Family</a>
                        </div>
                    </div>
                    <div class="btn-group" slot="action" slot-scope="{row}">
                        <a class="btn btn-primary btn-sm text-white" @click="familyDetail(row.id)"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm text-white" @click="familyDelete(row.id)"><i class="fas fa-trash"></i></a>
                    </div>
                </v-client-table>
            </div>
        </div>
    </div>
</template>


<script>

    import CreateFamily from './../globals/form/createModalComponent.vue'

    export default {
        name:'app-modal',
        components:  {
            CreateFamily
        },
        data() {
            return {
                // for create modal
                makeForm: [{
                    FormBody : [
                        {
                            type: 'text',
                            label: 'Family Name',
                            name: 'name'
                        },
                         {
                            type: 'text',
                            label: 'Material Code',
                            name: 'material_code'
                        }
                    ]
                }],
                getValues: {},
                // for list
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
            },
            showCreateFamily() {
                console.log(this.makeForm);
                this.$modal.show('size-modal')
            },
            familyDetail(id) {
                window.location.href = '/family/'+id;
            },
            familyDelete(id){
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

                        axios.delete('/family/'+id)
                        .then(function(res){
                            if(res.data.status == 'success'){
                                swal.fire(
                                    'Deleted!',
                                    'Family has been deleted.',
                                    'success'
                                )
                                vm.fetchList();
                            }
                        })
                        .catch(function(error){
                            console.log(error);
                        });

                        
                    }
                })
            }
        } 
    }
   
</script>

<style>
    td {
        text-align: center;
    }
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