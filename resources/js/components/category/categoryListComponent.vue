<template>
     <div class="app-modal">
        <create-category
        v-bind:form-settings='makeForm'
        v-bind:form-values='getValues'
        v-bind:save-form='"/category"'
        v-bind:modal-title='"Add Category"'
        v-bind:back-route='"/category"'

        ></create-category>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Category list</h6>
                </div>
                <div class="card-body">
                    <v-client-table :data="categories" :columns="columns" :options="options">
                        <div slot= "afterLimit" class="ml-2">
                            <div class="btn-group">
                                <a class="btn btn-info text-white" @click="showCreateCategory" slot="afterLimit">Add Category</a>
                            </div>
                        </div>
                        <div slot="name" slot-scope="{row}">
                            <a href="#" @click="viewSubCat(row.id)">{{row.name}}</a>
                        </div>
                        <div class="btn-group" slot="actions" slot-scope="{row}">
                            <a class="btn btn-primary btn-sm text-white" @click=categoryDetail(row.id)><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm text-white" @click="categoryDelete(row.id)"><i class="far fa-trash-alt"></i></a>
                        </div>
                    </v-client-table>
                </div>
            </div>
    </div>
</template>


<script>

    import CreateCategory from './../globals/form/createModalComponent.vue'



    export default {
        
        name:'app-modal',
        components: {
            CreateCategory
        },
        data() {
            return {
                sub_discipline_id : typeof window.id !== 'undefined' ? window.id : null,
                // for create modal
                makeForm: [{

                    FormBody : [
                        {
                                type: 'text',
                                lable: 'Category Name',
                                name: 'name'
                        } 
                    ]
                }
                     
                ],

                getValues:{},

                //list
                categories: [],

                //for table
                columns:['id', 'name', 'actions'],
                options: {
                    initialPage:1,
                    perPage:10,
                    highlightMatches:true,
                    sortIcon: {base:'fas', up:'fa-sort-amount-up', down:'fa-sort-amount-dow', is:'fa-sort'},
                    headings: {
                        id: '#',
                        name: 'Category',
                        actions: 'Actions'
                    },
                    sortable:['name'],
                    rowClassCallback(row){
                        return row.id = row.id;
                    },
                    columnClasses : {id: 'class-is'},
                    texts:{
                        filterPlaceholder: 'Search Keywords'
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
                let url = vm.sub_discipline_id != null ? '/subdiscip/'+vm.sub_discipline_id+'/category/list' : '/cat/list';
                axios.get(url)
                .then(function (r) {
                    console.log(r.data);
                    vm.categories = r.data;
                    console.log(vm.categories);
                })
                .catch(function (error) {
                    console.log(error);
                })

            },
            viewSubCat(id) {
               window.location.href='/category/'+id+'/family-type';
            },
            showCreateCategory() {
                console.log(this.makeForm);
                this.$modal.show('size-modal')
            },
            categoryDetail(id) {
                window.location.href = '/category/'+id;
            },
            categoryDelete(id){
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

                    axios.delete('/category/'+id)
                    .then(function(res){
                        if(res.data.status=='success'){
                            swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
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
    td{
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