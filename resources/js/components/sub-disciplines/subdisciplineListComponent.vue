<template>
    <div class="app-modal">
        <create-sub-discipline
        v-bind:form-settings='makeForm'
        v-bind:form-values='getValues'
        v-bind:save-form='"/sub-discipline"'
        v-bind:modal-title='"Add Sub-Discipline"'
        v-bind:back-route='"/sub-discipline"'

        ></create-sub-discipline>
        <div class="card shadow mb-4"> 
            <!-- mb -> margin bottom -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Sub-disciplines</h6>
            </div>
            <div class="card-body">
                <v-client-table :data="subdiscipline" :columns="columns" :options="options">
                    <div slot= "afterLimit" class="ml-2">
                        <div class="btn-group">
                            <a class="btn btn-info text-white" @click="showCreateSubDiscipline" slot="afterLimit">Add Sub-Discipline</a>
                        </div>
                    </div>
                    <div slot="name" slot-scope="{row}">
                            <a href="#" @click="viewSub(row.id)">{{row.name}}</a>
                        </div>
                    <div class = "btn-group" slot="action" slot-scope="{row}">
                        <a class="btn btn-primary btn-sm text-white" @click="subdisciplineDetail(row.id)"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm text-white" @click="subdisciplineDelete(row.id)"><i class="fas fa-trash"></i></a>
                    </div>
                </v-client-table>
            </div>
            
        </div>
    </div>

</template>


<script>

    import CreateSubDiscipline from './../globals/form/createModalComponent.vue'

    export default {
        name:'app-modal',
        components: {
            CreateSubDiscipline
        },
        data(){
            return {
                discipline_id : typeof window.id !== 'undefined' ? window.id : null,
                // for create modal (based on createModalComponent)
                makeForm: [{
                   
                   FormBody : [
                        {
                        type: 'text',
                        label: 'Sub-Discipline Name', 
                        name: 'name'
                        }
                    ]
                } ],
                
                getValues: {},
                    // for object, curly brackets
                

                // for list
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
                let url = vm.discipline_id != null ? '/discipline/'+vm.discipline_id+'/subdiscip/list' : '/subdiscip/list';
                // console.log(vm.subdiscipline);
                // axios.get('/subdiscip/list')
                axios.get(url)
                .then( function(r) {
                    vm.subdiscipline = r.data
                    console.log(vm.subdiscipline);
                } )
                .catch( function (error) {
                    console.log (error);
                } )
            },
            viewSub(id){
                window.location.href='/subdiscip/'+id+'/category';
            },
            showCreateSubDiscipline(){
                console.log(this.makeForm);
                this.$modal.show('size-modal')
            },

            subdisciplineDetail(id){
                window.location.href = '/sub-discipline/'+id;
            },
            subdisciplineDelete(id){
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

                        axios.delete('/sub-discipline/'+id)
                        .then(function(res){
                            if(res.data.status == 'success'){
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
        text-align:center;
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