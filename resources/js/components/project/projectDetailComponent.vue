<template>
    <div>
        <!-- <div class="row mb-3">
            <div class="col-md-12 pull-right text-right">
                <button class="btn btn-success" @click="saveChanges()" ><i class="far fa-save"></i> Save Changes</button>
            </div>
        </div> -->
        <!-- <div class="row">
            <div class="col-md-6 pull-left text-left">
                <a v-bind:href="backRoute" class="btn btn-info" ><i class="fas fa-chevron-circle-left"></i> Back</a>
            </div>
        </div> -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Project Details</h6>
            </div>
            <div class="card-body">
                <dynamic-form 
                v-bind:form-settings='makeForm' 
                v-bind:form-values='getValues'
                v-bind:save-form='"/project"'
                v-bind:back-route='"/project"'
                ></dynamic-form>
            </div>
        </div>
        
    </div>
</template>


<script>

    import DynamicForm from "./../globals/form/DynamicFormComponent.vue";


    export default {
        components: {
            DynamicForm
        },
        mounted() {
            this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
        },
        data() {
            return {
                csrfToken: '',
                getValues : window.project,
                makeForm : [{
                    FormTitle : 'Project Details',
                    FormBody : [
                        {
                            type : 'text',
                            label : 'Project Name',
                            name : 'name',
                        },
                        {
                            type : 'select',
                            label : 'Project Type',
                            name : 'project_type_id',
                            items :window.project_types,
                        },
                        {
                            type : 'checkbox',
                            label : 'Active',
                            name : 'is_active',
                        },               
                    ]
                }],
            };
        },
        created() {
            // console.log(this.getValues);
            this.getValues.is_active = this.getValues.is_active == 1 ? true :false;
            // console.log(this);
        },
        methods: {
            fetchData() {
                // // console.log(course_id);
                // axios({
                //     method: 'get',
                //     url: '/agent/show/info/'+ this.agent_id
                // })
                // .then(res => {
                //     this.agent = res.data;
                // })
                // .catch(err => console.log(err));
            },
            saveChanges() {

                // axios.post('/api/equipment/',{
                //     equipments: this.getValues,
                //     _token: this.csrfToken
                // })
                // .then(res => {
                //     console.log(res);
                //     if(res.data.status == 'updated'){
                //          Toast.fire({
                //             // position: 'top-end',
                //             type: 'success', title: 'Changes saved successfully',
                //         })
                //         this.agent = res.data.agent;
                //     }else{
                //          Toast.fire({
                //             // position: 'top-end',
                //             type: 'error', title: 'Opss.. was not saved successfully',
                //         })
                //     }
                // })
                // .catch(err => console.log(err));
            },
        }
    }
</script>

<style>
    .tab-pane {
        border: 1px solid #e0dfdf;
        border-top: none;
        padding: 1.3rem;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
        background-color: #ffffff;
    }
    .horizontal-line-wrapper{
        background-color: #36b9cc;
    }

</style>