<template>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-9 col-xl-7">
                <div class="card-header px-0 mt-2 bg-transparent clearfix">
                    <h4 class="float-left pt-2">Edit Request</h4>
                    <div class="card-header-actions mr-1">
                        <a class="btn btn-primary" href="#" :disabled="submiting" @click.prevent="update">
                            <i class="fas fa-spinner fa-spin" v-if="submiting"></i>
                            <i class="fas fa-check" v-else></i>
                            <span class="ml-1">Save</span>
                        </a>
                        <a class="card-header-action ml-1" href="#" :disabled="submitingDestroy" @click.prevent="destroy">
                            <i class="fas fa-spinner fa-spin" v-if="submitingDestroy"></i>
                            <i class="far fa-trash-alt" v-else></i>
                            <span class="d-md-down-none ml-1">Delete</span>
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="row" v-if="!loading">
                        <div class="form-group col-md-9">
                            <label>Project Name</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.project_name}" v-model="project.project_name" placeholder="Project Name">
                            <div class="invalid-feedback" v-if="errors.project_name">{{errors.project_name[0]}}</div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>ID</label>
                            <input class="form-control" type="text" v-model="project.id" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Project Date</label>
                            <input class="form-control" type="text" v-model="project.date" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Type</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.type}" v-model="project.type" placeholder="Project Type">
                            <div class="invalid-feedback" v-if="errors.type">{{errors.type[0]}}</div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Project Code</label>
                            <input class="form-control" type="text" v-model="project.project_code" readonly>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Initiator</label>
                                <input type="text" class="form-control" :class="{'is-invalid': errors.initiator}" v-model="project.initiator" placeholder="Project Initiator">
                                <div class="invalid-feedback" v-if="errors.initiator">{{errors.initiator[0]}}</div>
                            </div>
                            <div class="form-group">
                                <label>Unit</label>
                                <input type="text" class="form-control" :class="{'is-invalid': errors.unit}" v-model="project.unit">
                                <div class="invalid-feedback" v-if="errors.unit">{{errors.unit[0]}}</div>
                            </div>
                            <div class="form-group">
                                <label>Pharmacist</label>
                                <input type="text" class="form-control" :class="{'is-invalid': errors.pharmacist}" v-model="project.pharmacist">
                                <div class="invalid-feedback" v-if="errors.pharmacist">{{errors.pharmacist[0]}}</div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>File Number</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.file_number}" v-model="project.file_number" placeholder="File Number">
                            <div class="invalid-feedback" v-if="errors.file_number">{{errors.file_number[0]}}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mission Code</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.mission_code}" v-model="project.mission_code" placeholder="Mission Code">
                            <div class="invalid-feedback" v-if="errors.mission_code">{{errors.mission_code[0]}}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <input class="form-control" type="text" v-model="project.status" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Location</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.location}" v-model="project.location" placeholder="Location">
                            <div class="invalid-feedback" v-if="errors.location">{{errors.location[0]}}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Initiator Contact</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.init_contact}" v-model="project.init_contact" placeholder="Initiator Contact">
                            <div class="invalid-feedback" v-if="errors.init_contact">{{errors.init_contact[0]}}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Initiator Email</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.email}" v-model="project.email" placeholder="Initiator Email">
                            <div class="invalid-feedback" v-if="errors.email">{{errors.email[0]}}</div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Exchange Rate</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.exchange_rate}" v-model="project.exchange_rate" placeholder="Exchange Rate">
                            <div class="invalid-feedback" v-if="errors.exchange_rate">{{errors.exchange_rate[0]}}</div>
                        </div>
                        <div class="form-group col-md-9">
                            <label>Order Number</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.order_number}" v-model="project.order_number" placeholder="Order Number">
                            <div class="invalid-feedback" v-if="errors.order_number">{{errors.order_number[0]}}</div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Reference</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.reference}" v-model="project.reference" placeholder="Reference">
                            <div class="invalid-feedback" v-if="errors.reference">{{errors.reference[0]}}</div>
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
            project:{},
            errors:{},
            loading: true,
            submiting: false,
            submitingDestroy: false
        }
    },
    mounted(){
        this.getUser()
    },
    methods: {
        getUser(){
            this.loading = true
            let str = window.location.pathname
            let res = str.split("/")
            axios.get(`/api/projects/getProject/${res[2]}`)
            .then(response=> {
                this.project = response.data
            })
            .catch(error =>{
                this.$toasted.global.error('Project does not exist')
            })
            .then(()=>{
                this.loading = false
            })
        },
        update(){
            if (!this.submiting){
                this.submiting = true
                axios.put(`/api/projects/update/${this.project.id}`, this.project)
                .then(response =>{
                    this.$toasted.global.error('Project Details Updated')
                    location.href = '/projects'
                })
                .catch(error=>{
                    this.errors = error.response.data.errors
                    this.submiting = false
                })
            }
        },
        destroy () {
            if (!this.submitingDestroy) {
                this.submitingDestroy = true
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover project data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            axios.delete(`/api/projects/${this.project.id}`)
                                .then(response => {
                                    this.$toasted.global.error('Deleted Project!')
                                    location.href = '/project'
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
