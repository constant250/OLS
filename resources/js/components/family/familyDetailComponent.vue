<template>
    <div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-info">Family Details</h6>
            </div>
            <div class="card-body">
                <dynamic-form
                v-bind:form-settings="makeForm"
                v-bind:form-values="getValues"
                v-bind:save-form="'/family'"
                v-bind:back-route="'/family'"
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
            // console.log(window.family);
        },
        data() {
            return {
                csrfToken: '',
                makeForm: [{
                    FormTitle : 'Family Infomation',
                    FormBody : [
                        {
                            type : 'text',
                            label: 'Family Name',
                            name: 'name',
                        } 
                    ]
                }],
                getValues: window.family,
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