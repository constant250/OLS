<template>
    <div class="app-modal">
        <create-familytype/>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Equipment List</h6>
            </div>
            <div class="card-body">
                <v-client-table :data="familytypeList" :columns="columns" :options="options" ref="courseTable">
                        <div slot="afterLimit" class="ml-2">
                            <div class="btn-group">
                                <a href="javascript:void(0)"  @click="showCreatefamilytype" class="btn btn-info" slot="afterLimit"><i class="fas fa-plus"></i> Add familytype</a>
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

    import Createfamilytype from './createfamilytypeComponent.vue'

    export default {
        name: 'app-modal',
        // mounted() {
        //     console.log('Component mounted.')
        // }
        components: {
            Createfamilytype
        },
        data() {
            return {
                familytypeList : [],
                familytype : {},
                familytype_id : '',
                pagination : {},
                edit: false,
                searchfamilytypeName: '',
                url: 'familytype/show/',

                // Vue-Tables-2 Syntax
                columns: ['id', 'name', 'familytype_type.name', 'user.party.name', 'actions'],
                options: {
                    initialPage:1,
                    perPage:10,
                    highlightMatches:true,
                    sortIcon: { base:'fas', up:'fa-sort-amount-up', down:'fa-sort-amount-down', is:'fa-sort' },
                    headings: {
                        id: '#',
                        name: 'familytype Name',
                        'familytype_type.name': 'familytype Type',
                        'user.party.name': 'User',
                        actions: 'Actions'
                    },
                    sortable: ['name', 'familytype_type.name', 'user.party.name'],
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
            this.fetchfamilytype();
        },
        methods: {
            // searchfamilytype() {
            //     let vm = this;
            //     console.log(this.searchfamilytypeName);
            //     let search = (this.searchfamilytypeName ? this.searchfamilytypeName : '');

            //     fetch('/familytype/list/search/'+search)
            //         .then(res => res.json())
            //         .then(res => {
            //             this.familytypeList = res.data;
            //             vm.makePagination(res);
            //         })
            //         .catch(err => console.log(err));
            // },
            fetchfamilytype(page_url) {
                let vm = this;
                page_url = page_url || '/proj/list'
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        console.log(res);
                        this.familytypeList = res;
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
            showCreatefamilytype () {
                this.$modal.show('size-modal',{
                    edit : false,
                    id : '',
                    course_id : '',
                    name : '',
                    code : '',
                })
            },
            equipDetail (id) {
                window.location.href = '/familytype/'+id;
            },
            removeEquip(id) {
                let vm = this;
                swal.fire({
                    title: 'Are you sure delete familytype?',
                    text: " this won't be able to revert!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/familytype/'+id)
                        .then(function(res){
                        // vm.files = res.data;
                        if(res.data.status == 'success'){
                            swal.fire(
                                'Deleted!',
                                'Equipment has been deleted.',
                                'success'
                            )
                            vm.fetchfamilytype();
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