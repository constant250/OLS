<template>
    <div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Familty Type Details</h6>
            </div>
        </div>
        <div class="card-bod">
            <dynamic-form
            v-bind:form-settings="makeForm"
            v-bind:form-values="getValues"
            v-bind:save-form="'/family-type'"
            v-bind:back-route="'/family-type'"
            ></dynamic-form>
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
            this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
            console.log(window.familytype)
        },
        data() {
            return {
                csrfToken:'',
                makeForm: [
                    {
                        FormTitle : 'Family Type Information',
                        FormBody : [
                            {
                                type : 'text',
                                label : 'Family Type Name',
                                name: 'name',
                            }
                        ]
                    }
                ],
                getValues: window.familytype,

            }
        }
    }
</script>

<style>

.horizontal-line-wrapper {
    

}
.horizontal-line-wrapper h6{
    padding: 10px;
    color: #fff;
    font-weight: 700;
    
}

</style>