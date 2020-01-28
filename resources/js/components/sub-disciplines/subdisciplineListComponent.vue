<template>
    <div class="app-modal">
        <create-subdiscipline/>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Equipment List</h6>
            </div>
            <div class="card-body">
                <v-client-table :data="subdisciplineList" :columns="columns" :options="options" ref="courseTable">
                        <div slot="afterLimit" class="ml-2">
                            <div class="btn-group">
                                <a href="javascript:void(0)"  @click="showCreatesubdiscipline" class="btn btn-info" slot="afterLimit"><i class="fas fa-plus"></i> Add subdiscipline</a>
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Export to
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="far fa-file-pdf text-danger"></i>&nbsp; PDF</a>
                                    <a class="dropdown-item" href="#"><i class="far fa-file-excel text-success"></i>&nbsp; Excel (CSV)</a>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group" slot="actions" slot-scope="{row}">
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm" @click="equipDetail(row.id)"> <i class="fas fa-edit"> </i></a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white" @click="removeEquip(row.id)"> <i class="fas fa-trash"> </i></a>
                        </div>
                </v-client-table>
            </div>
        </div>
    </div>
</template>


<script>

    import Createsubdiscipline from './createsubdisciplineComponent.vue'

    export default {
        name: 'app-modal',
        // mounted() {
        //     console.log('Component mounted.')
        // }
        components: {
            Createsubdiscipline
        },
        data() {
            return {
                subdisciplineList : [],
                subdiscipline : {},
                subdiscipline_id : '',
                pagination : {},
                edit: false,
                searchsubdisciplineName: '',
                url: 'subdiscipline/show/',

                // Vue-Tables-2 Syntax
                columns: ['id', 'name', 'subdiscipline_type.name', 'user.party.name', 'actions'],
                options: {
                    initialPage:1,
                    perPage:10,
                    highlightMatches:true,
                    sortIcon: { base:'fas', up:'fa-sort-amount-up', down:'fa-sort-amount-down', is:'fa-sort' },
                    headings: {
                        id: '#',
                        name: 'subdiscipline Name',
                        'subdiscipline_type.name': 'subdiscipline Type',
                        'user.party.name': 'User',
                        actions: 'Actions'
                    },
                    sortable: ['name', 'subdiscipline_type.name', 'user.party.name'],
                    rowClassCallback(row) {
                        return row.id = row.id;
                    },
                    columnClasses: {id: 'class-is'},
                    texts: {
                        // filter: "Search:",
                        filterPlaceholder: "Search keywords",
                    }
                },

            };
        },
        created() {
            this.fetchsubdiscipline();
        },
        methods: {
            // searchsubdiscipline() {
            //     let vm = this;
            //     console.log(this.searchsubdisciplineName);
            //     let search = (this.searchsubdisciplineName ? this.searchsubdisciplineName : '');

            //     fetch('/subdiscipline/list/search/'+search)
            //         .then(res => res.json())
            //         .then(res => {
            //             this.subdisciplineList = res.data;
            //             vm.makePagination(res);
            //         })
            //         .catch(err => console.log(err));
            // },
            fetchsubdiscipline(page_url) {
                let vm = this;
                page_url = page_url || '/proj/list'
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        console.log(res);
                        this.subdisciplineList = res;
                        vm.makePagination(res);
                    })
                    .catch(err => console.log(err));
            },
            makePagination(meta){
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: meta.next_page_url,
                    prev_page_url: meta.prev_page_url
                }
                this.pagination = pagination
            },
            showCreatesubdiscipline () {
                this.$modal.show('size-modal',{
                    edit : false,
                    id : '',
                    course_id : '',
                    name : '',
                    code : '',
                })
            },
            equipDetail (id) {
                window.location.href = '/subdiscipline/'+id;
            },
            removeEquip(id) {
                let vm = this;
                swal.fire({
                    title: 'Are you sure delete subdiscipline?',
                    text: " this won't be able to revert!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/subdiscipline/'+id)
                        .then(function(res){
                        // vm.files = res.data;
                        if(res.data.status == 'success'){
                            swal.fire(
                                'Deleted!',
                                'Equipment has been deleted.',
                                'success'
                            )
                            vm.fetchsubdiscipline();
                        }
                        })
                        .catch(function(error){
                        });
                    }
                });
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