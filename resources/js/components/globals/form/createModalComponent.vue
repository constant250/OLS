<template>
  <modal name="size-modal"
        transition="nice-modal-fade"
        classes="demo-modal-class"
        :min-width="200"
        :min-height="200"
        :pivot-y="0.1"
        :adaptive="true"
        :scrollabel="true"
        :reset="true" 
        width="40%"
        height="auto"
        @before-open="beforeOpen"
        @opened="opened"
        @closed="closed"
        @before-close="beforeClose" >
  <div class="size-modal-content">
    <h4>{{title}}</h4>
    <form @submit.prevent="saveChanges">
        <div v-for="(form, key) in this.formSettings" :key="key">
            <!-- <div class="horizontal-line-wrapper mb-2">
                <h6></h6>
            </div> -->
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
                                <!-- v-if="typeof itm['event']!== 'undefined'" @click="on_click"  -->
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
                        <div v-else-if="itm['type'] === 'attachment'">
                            <FamilyAttachment
                                v-bind:fileTypeValidate="['jpeg','jpg','png', 'pdf']"
                                v-bind:fileSizeValidate="5000000"
                            ></FamilyAttachment>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="clearfix"></div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
  </div>
</modal>
</template>
<script>
  import FamilyAttachment from './../FileDragDropInstantComponent.vue';


  export default {
    name: 'SizeModalProject',
    components: {
        FamilyAttachment
    },
    // props: ['id', 'code', 'name'],
    props : {
            formSettings : Array,
            formValues : Object,
            saveForm: String,
            modalTitle: String,
            backRoute: String,
    },
    mounted() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    data () {
      return {
        inputs: this.formValues,
        title: this.modalTitle,
        csrfToken: '',
        rowCount: 1,
        id : typeof window.id !== 'undefined' ? window.id : null,
      }
    },
    created(){
        // console.log(this.projectType);
    },
    methods: {
        saveChanges() {
            console.log(this.inputs);
            // console.log(this.saveForm);
            // alert(this.csrfToken);
            let vm = this;
            axios.post(this.saveForm,{
                inputs: this.inputs,
                id: this.id,
                _token: this.csrfToken
            })
            .then(res => {
                console.log(res);
                if(res.data.status == 'success'){
                    Toast.fire({
                        // position: 'top-end',
                        type: 'success', title: 'Changes saved successfully',
                    })
                    vm.$modal.hide('size-modal'); 
                }else{
                    Toast.fire({
                        // position: 'top-end',
                        type: 'error', title: 'Opss.. was not saved successfully',
                    })
                }
            })
            .catch(err => console.log(err));
        },
        beforeOpen (e) {
            this.project = {};

        // this.fetchAgents();
        },
        beforeClose (e){
            this.$parent.fetchList();
        },
        opened (e) {
        // e.ref should not be undefined here
            // console.log('opened', e)
            // console.log('ref', e.ref)
        },
        closed (e) {
            console.log('closed', e)
        }
    }
  }
</script>
<style>
  .size-modal-content {
    padding: 10px;
    margin: 10px;
    font-style: 13px;
  }
  .v--modal-overlay[data-modal="size-modal"] {
    background: rgba(0, 0, 0, 0.5);
  }
  .demo-modal-class {
    border-radius: 5px;
    background: #F7F7F7;
    box-shadow: 5px 5px 30px 0px rgba(46,61,73, 0.6);
  }
</style>