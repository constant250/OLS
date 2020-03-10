<template>
    <div class="app-modal">
        <create-project 
        v-bind:form-settings='makeForm' 
        v-bind:form-values='getValues'
        v-bind:modal-title='"Add Project"'
        v-bind:save-form='"/project"'>
        </create-project>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Equipment List</h6>
            </div>
            <div class="card-body">
                <v-client-table :data="projectList" :columns="columns" :options="options" ref="courseTable">
                        <div slot="afterLimit" class="ml-2">
                            <div class="btn-group">
                                <a href="javascript:void(0)"  @click="showCreateProject" class="btn btn-info" slot="afterLimit"><i class="fas fa-plus"></i> Add Project</a>
                                
                            </div>
                        </div>
                        <div slot="name" slot-scope="{row}">
                            <a href="#" @click="viewFamilyDiscipline(row.id)">{{row.name}}</a>
                        </div>
                        <div class="btn-group" slot="actions" slot-scope="{row}">
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm" @click="projectDetail(row.id)"> <i class="fas fa-edit"> </i></a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm text-white" @click="removeEquip(row.id)"> <i class="fas fa-trash"> </i></a>
                        </div>
                </v-client-table>
            </div>
        </div>
    </div>
</template>


<script>

    import CreateProject from './../globals/form/createModalComponent.vue'

    export default {
        name: 'app-modal',
        // mounted() {
        //     console.log('Component mounted.')
        // }
        components: {
            CreateProject
        },
        data() {
            return {
                projectList : [],
                project : {},
                project_id : '',
                pagination : {},
                edit: false,
                searchProjectName: '',
                url: 'project/show/',

                // Vue-Tables-2 Syntax
                columns: ['id', 'name', 'project_type.name', 'user.party.name', 'actions'],
                options: {
                    initialPage:1,
                    perPage:10,
                    highlightMatches:true,
                    sortIcon: { base:'fas', up:'fa-sort-amount-up', down:'fa-sort-amount-down', is:'fa-sort' },
                    headings: {
                        id: '#',
                        name: 'Project Name',
                        'project_type.name': 'Project Type',
                        'user.party.name': 'User',
                        actions: 'Actions'
                    },
                    sortable: ['name', 'project_type.name', 'user.party.name'],
                    rowClassCallback(row) {
                        return row.id = row.id;
                    },
                    columnClasses: {id: 'class-is'},
                    texts: {
                        // filter: "Search:",
                        filterPlaceholder: "Search keywords",
                    }
                },
                
                getValues : {},
                makeForm : [{
                    FormTitle : 'Add Project',
                    FormBody : [
                        {
                            type : 'text',
                            lable : 'Project Name',
                            name : 'name',
                        },
                        {
                            type : 'select',
                            lable : 'Project Type',
                            name : 'project_type_id',
                            items :window.project_types,
                        },                   
                    ]
                }],

            };
        },
        created() {
            this.fetchList();
        },
        methods: {
            // searchProject() {
            //     let vm = this;
            //     console.log(this.searchProjectName);
            //     let search = (this.searchProjectName ? this.searchProjectName : '');

            //     fetch('/project/list/search/'+search)
            //         .then(res => res.json())
            //         .then(res => {
            //             this.projectList = res.data;
            //             vm.makePagination(res);
            //         })
            //         .catch(err => console.log(err));
            // },
            fetchList(page_url) {
                let vm = this;
                page_url = page_url || '/proj/list'
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        console.log(res);
                        this.projectList = res;
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
            showCreateProject () {
                this.$modal.show('size-modal')
            },
            viewFamilyDiscipline(id) {
                window.location.href = 'project/'+id+'/discipline';
            },
            projectDetail (id) {
                window.location.href = '/project/'+id;
            },
            removeEquip(id) {
                let vm = this;
                swal.fire({
                    title: 'Are you sure delete project?',
                    text: " this won't be able to revert!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/project/'+id)
                        .then(function(res){
                        // vm.files = res.data;
                        if(res.data.status == 'success'){
                            swal.fire(
                                'Deleted!',
                                'Equipment has been deleted.',
                                'success'
                            )
                            vm.fetchList();
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