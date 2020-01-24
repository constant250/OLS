<template>
  <modal name="size-modal"
        transition="nice-modal-fade"
        classes="demo-modal-class"
        :min-width="200"
        :min-height="200"
        :pivot-y="0.1"
        :adaptive="true"
        :scrollable="true"
        :reset="true" 
        width="40%"
        height="auto"
        @before-open="beforeOpen"
        @opened="opened"
        @closed="closed"
        @before-close="beforeClose">
  <div class="size-modal-content">
    <h4>Add Project</h4>
    <form @submit.prevent="saveProject">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputAgentCode">Project Name</label>
                    <input type="text" class="form-control" v-model="project.name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="projectType">Project Type</label>
                    <select name="projectType" class="form-control" v-model="project.project_type_id">
                        <option v-for="(opt, optKy) in projectType" v-bind:key="optKy" v-bind:value="opt.id">{{opt.name}}</option> 
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-md-6">
                <div class="form-group">
                    <label for="is_active">Active</label>
                    <div class="custom-control custom-switch my-2">
                        <input type="checkbox" class="custom-control-input" v-model="project.is_active">
                        <label class="custom-control-label" for="is_active"></label> 
                    </div>
                </div>
            </div> -->
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
    
  </div>
</modal>
</template>
<script>
  export default {
    name: 'SizeModalProject',
    // props: ['id', 'code', 'name'],
    mounted() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    },
    data () {
      return {
        // agentList : [],
        project : {},
        projectType: window.project_types,
        // agent_id : '',
        // edit : false,
        // csrf: '',
      }
    },
    created(){
        // console.log(this.projectType);
    },
    methods: {
        saveProject() {
            console.log(this.project);
            let vm = this;
            axios.post('/project',{
                project : this.project,
                _token: this.csrfToken
            })
            .then(res => {
                if(res.data.status == 'success'){
                    Toast.fire({
                        // position: 'top-end',
                        type: 'success',
                        title: 'Project saved successfully',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    // this.agent = {};
                    // console.log(vm.$parent);
                    // vm.$parent.fetchAgents();
                    vm.$modal.hide('size-modal'); 
                }else{
                    Toast.fire({
                        // position: 'top-end',
                        type: 'error',
                        title: 'Opss.. was not saved successfully',
                        showConfirmButton: false,
                        timer: 1500
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
            this.$parent.fetchProject();
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