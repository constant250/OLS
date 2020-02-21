<template>
    <div class="app-modal">
        <create-discipline
            v-bind:form-settings='makeForm'
            v-bind:form-values='getValues'
            v-bind:save-form='"/discipline"'
            v-bind:modal-title='"Add Discipline"'
            v-bind:back-route='"/discipline"'
        >
        </create-discipline>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Discipline List</h6>
            </div>
            <div class="card-body">
                    <v-client-table :data="disciplines" :columns="columns" :options="options">
                        <div slot="afterLimit" class="ml-2">
                            <div class="btn-group">
                                <a class="btn btn-info text-white" @click="showCreateDiscipline" slot="afterLimit">Add Discipline</a>
                            </div>
                        </div>
                        <div class="btn-group" slot="action" slot-scope="{row}">
                            <a class="btn btn-primary btn-sm text-white" @click="disciplineDetail(row.id)"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm text-white" @click="disciplineDelete(row.id)"><i class="fas fa-trash"></i></a>
                        </div>    
                    </v-client-table>
            </div>
        </div>
    </div>    
    
</template>


<script>

    import CreateDiscipline from './../globals/form/createModalComponent.vue'

    export default {
        name:'app-modal',

        components: {
            CreateDiscipline
        },
        data() {
            return {
                //for create modal
                makeForm: [{
                    FormBody : [
                          {
                        type: 'text',
                        label: 'Discipline Name',
                        name: 'name'
                    }
                    ]
                  
                }],
        
                getValues: {},

                //for list
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
            },
            showCreateDiscipline() {
                console.log(this.makeForm),
                this.$modal.show('size-modal')
            },
            disciplineDetail(id){
                window.location.href='/discipline/'+id;
            },
            disciplineDelete(id){
                alert('delete' + id);
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