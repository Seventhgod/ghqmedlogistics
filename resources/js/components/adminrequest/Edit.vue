<template>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-9 col-xl-7">
                <div class="card-header px-0 mt-2 bg-transparent clearfix">
                    <h4 class="float-left pt-2">Edit Request</h4>
                    <div class="card-header-actions mr-1">
                        <a class="btn btn-primary" href="#" :disabled="submitting" @click.prevent="update">
                            <i class="fas fa-spinner fa-spin" v-if="submitting"></i>
                            <i class="fas fa-check" v-else></i>
                            <span class="ml-1">Save</span>
                        </a>
                        <a class="card-header-action ml-1" href="#" :disabled="submittingDestroy" @click.prevent="destroy">
                            <i class="fas fa-spinner fa-spin" v-if="submittingDestroy"></i>
                            <i class="far fa-trash-alt" v-else></i>
                            <span class="d-md-down-none ml-1">Delete</span>
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="row" v-if="!loading">
                        <div class="form-group col-md-9">
                            <label>Project Name</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.project_name}" v-model="adminrequest.project_name" placeholder="Project Name">
                            <div class="invalid-feedback" v-if="errors.project_name">{{errors.project_name[0]}}</div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>ID</label>
                            <input class="form-control" type="text" v-model="adminrequest.id" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Project Date</label>
                            <input class="form-control" type="text" v-model="adminrequest.date" readonly>
                        </div>
                        <div class="form-group col-md-9">
                            <label>Initiator</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.initiator}" v-model="adminrequest.initiator" placeholder="Project Initiator">
                            <div class="invalid-feedback" v-if="errors.initiator">{{errors.initiator[0]}}</div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Unit</label>
                                <input type="text" class="form-control" :class="{'is-invalid': errors.unit}" v-model="adminrequest.unit">
                                <div class="invalid-feedback" v-if="errors.unit">{{errors.unit[0]}}</div>
                            </div>
                            <div class="form-group">
                                <label>Pharmacist</label>
                                <input type="text" class="form-control" :class="{'is-invalid': errors.pharmacist}" v-model="adminrequest.pharmacist">
                                <div class="invalid-feedback" v-if="errors.pharmacist">{{errors.pharmacist[0]}}</div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>File Number</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.file_number}" v-model="adminrequest.file_number" placeholder="File Number">
                            <div class="invalid-feedback" v-if="errors.file_number">{{errors.file_number[0]}}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Indent Number</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.indent_number}" v-model="adminrequest.indent_number" placeholder="Indent Number">
                            <div class="invalid-feedback" v-if="errors.indent_number">{{errors.indent_number[0]}}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mission Code</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.mission_code}" v-model="adminrequest.mission_code" placeholder="Mission Code">
                            <div class="invalid-feedback" v-if="errors.mission_code">{{errors.mission_code[0]}}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <multiselect
                                v-model="adminrequest.status"
                                :options="['Approved','Pending']"
                                :searchable="false"
                                :show-labels="false"
                                :allow-empty="false">
                            </multiselect>
                            <small class="form-text text-danger" v-if="errors.status">{{errors.status[0]}}</small>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-form-label">Created At</label>
                            <p class="form-control-plaintext text-muted">{{adminrequest.created_at | moment("LLL")}}</p>
                        </div>
                    </div>
                    <div class="row" v-else>
                        <div class="col-md-12">
                            <content-placeholders>
                                <content-placeholders-text/>
                            </content-placeholders>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            adminrequest:{},
            errors:{},
            loading:true,
            submitting: false,
            submittingDestroy:false,
        }
    },
    mounted(){
        this.getAdminRequest()
    },
    methods:{
        getAdminRequest() {
            this.loading = true
            let str = window.location.pathname
            let res = str.split('/')
            axios.get(`/api/adminrequest/getadminrequest/${res[2]}`)
                .then(response => {
                    this.adminrequest = response.data
                })
                .catch(error=>{
                    this.$toasted.global.errors('Request Has been deleted or is lost')
                })
                .then(()=>{
                    this.loading = false
                })
        },
        update(){
            if (!this.submitting){
                this.submitting = true
                axios.put(`/api/adminrequest/update/${this.adminrequest.id}`, this.adminrequest)
                    .then(response =>{
                        this.$toasted.global.error('request Details Updated')
                        location.href = '/projects'
                    })
                    .catch(error=>{
                        this.errors = error.response.data.errors
                        this.submitting = false
                    })
            }
        },
        destroy(){
            if (!this.submittingDestroy) {
                this.submittingDestroy = true
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover project data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            axios.delete(`/api/adminrequest/${this.adminrequest.id}`)
                                .then(response => {
                                    this.$toasted.global.error('Deleted Request!')
                                    location.href = '/adminreq'
                                })
                                .catch(error => {
                                    this.errors = error.response.data.errors
                                })
                        }
                        this.submitingDestroy = false
                    })
            }
        }
    }
}
</script>

<style scoped>

</style>
