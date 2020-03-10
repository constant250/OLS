<template>
    <div>
        <div class="row mb-3">
            <div class="col-md-6 pull-left text-left">
                <a v-bind:href="backRoute" class="btn btn-info" ><i class="fas fa-chevron-circle-left"></i> Back</a>
            </div>
            <div class="col-md-6 pull-right text-right">
                <button class="btn btn-success" @click="saveChanges()" ><i class="far fa-save"></i> Save Changes</button>
            </div>
        </div>
        <div v-for="(form, key) in this.formSettings" :key="key">
            <div class="horizontal-line-wrapper mb-2">
                <h6>{{form.FormTitle}}</h6>
            </div>
            <div class="clearfix"></div>
            <div class="form-padding-left-right">
                <div class="row">
                    <div v-for="(itm, k) in form.FormBody" :key="k" v-bind:class="typeof itm['col_size'] !== 'undefined' ? 'col-md-'+itm['col_size'] : 'col-md-6'">
                        <div v-if="itm['type'] === 'text'">
                            <!-- text -->
                            <div class="form-group">
                                <label for="company_name">{{itm['label']}}</label>
                                <input class="form-control" v-bind:name="itm['name']" type="text"  v-bind:id="itm['name']" v-model="inputs[itm['name']]">
                            </div>
                        </div>
                        <div v-else-if="itm['type'] === 'select'">
                            <!-- selectbox -->
                            <div class="form-group">
                                <label for="agent_type">{{itm['label']}}</label>
                                <select name="agent_type" class="form-control" v-model="inputs[itm['name']]">
                                    <option v-for="(opt, optKy) in itm['items']" v-bind:key="optKy" v-bind:value="optKy">{{opt}}</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div v-else-if="itm['type'] === 'checkbox'">
                            <!-- checkbox -->
                            <div class="form-group">
                                <label v-bind:for="itm['name']">{{itm['label']}}</label>
                                <div class="custom-control custom-switch my-2">
                                    <input type="checkbox" class="custom-control-input" v-bind:id="itm['name']" v-model="inputs[itm['name']]">
                                    <label class="custom-control-label" v-bind:for="itm['name']"></label> 
                                </div>
                            </div>
                        </div>
                        <div v-else-if="itm['type'] === 'number'">
                            <!-- number -->
                            <div class="form-group">
                                <label v-bind:for="itm['name']">{{itm['label']}}</label>
                                <input class="form-control" v-bind:name="itm['name']" type="number"  v-bind:id="itm['name']" v-model="inputs[itm['name']]">
                            </div>
                        </div>
                        <div v-else-if="itm['type'] === 'radio'">
                            <!-- radiobox -->
                        </div>
                        <div v-else-if="itm['type'] === 'email'">
                            <!-- emailbox -->
                            <div class="form-group">
                                <label for="company_name">{{itm['label']}}</label>
                                <input class="form-control" v-bind:name="itm['name']" type="email"  v-bind:id="itm['name']" v-model="inputs[itm['name']]">
                            </div>
                        </div>
                        <div v-else-if="itm['type'] === 'password'">
                            <!-- passwordbox -->
                            <div class="form-group">
                                <label for="company_name">{{itm['label']}}</label>
                                <input class="form-control" v-bind:name="itm['name']" type="password"  v-bind:id="itm['name']" v-model="inputs[itm['name']]">
                            </div>
                        </div>
                        <div v-else-if="itm['type'] === 'textbox'">
                            <!-- textbox -->
                            <div class="form-group">
                                <label v-bind:for="itm['name']">{{itm['label']}}</label>
                                <textarea class="form-control" v-bind:name="itm['name']"  v-bind:id="itm['name']" v-model="inputs[itm['name']]"></textarea>
                            </div>
                        </div>
                        <div v-else-if="itm['type'] === 'multiselect'">
                            <!-- multiselect -->
                            <div class="form-group">
                                <label v-bind:for="itm['name']">{{itm['label']}}</label>
                                <multiselect 
                                    v-model="inputs[itm['name']]" 
                                    :options="itm['selections']" 
                                    :multiple="true"  
                                    placeholder="Type to search" 
                                    :close-on-select="false"  
                                    track-by="value" 
                                    label="value"
                                >
                                    <span slot="noResult">Oops! No units found. Consider changing the search query.</span>
                                </multiselect>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="clearfix"></div>
        </div>
        
        
    </div>
</template>


<script>

    import FormTitle from "./FormTitleComponent.vue";

    export default {
        components: {
            FormTitle
        },
        props : {
            formSettings : Array,
            formValues : Object,
            saveForm: String,
            backRoute: String,
        },
        mounted() {
            this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
        },
        data() {
            return {
                inputs: this.formValues,
                csrfToken: '',
                rowCount: 1,
            };
        },
        created() {
            this.fetchData();
            // console.log(this);
        },
        methods: {
            fetchData() {
                // console.log(this.formSettings);
                console.log(this.inputs);
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
                console.log(this.inputs);
                // console.log(this.saveForm);
                // alert(this.csrfToken);

                axios.post(this.saveForm,{
                    inputs: this.inputs,
                    _token: this.csrfToken
                })
                .then(res => {
                    console.log(res);
                    if(res.data.status == 'success'){
                         Toast.fire({
                            // position: 'top-end',
                            type: 'success', title: 'Changes saved successfully',
                        })
                    }else{
                         Toast.fire({
                            // position: 'top-end',
                            type: 'error', title: 'Opss.. was not saved successfully',
                        })
                    }
                })
                .catch(err => console.log(err));
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

</style>