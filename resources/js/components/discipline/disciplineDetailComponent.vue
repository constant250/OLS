<template>
    <div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-info">Discipline Details</h6>
        </div>
        <div class = "card-body">
            <dynamic-form
            v-bind:form-settings="makeForm"
            v-bind:form-values="getValues"
            v-bind:save-form="'/discipline'"
            v-bind:back-route="'/discipline'"
            ></dynamic-form>
        </div>
    </div>
    </div>
</template>


<script>
import DynamicForm from "./../globals/form/DynamicFormComponent.vue"

export default {

    components: {
        DynamicForm
    },
    mounted(){
        this.csrfToken=document.querySelector('meta[name="csrf-token"]').content
    },
    data(){
        return{
            csrfToken:'',
            makeForm: [{
                FormTitle : 'Family Information',
                FormBody : [
                    {
                        type : 'text',
                        label : 'Family Name',
                        name : 'name',
                    }
                ]

            }],
            getValues:window.discipline,
        }
    }

}

</script>

<style>

.horizontal-line-wrapper h6{
    color: #fff;
    font-size: 16px;
    padding: 10px;
    font-weight: 700;
}
</style>