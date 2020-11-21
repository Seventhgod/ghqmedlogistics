<template>
    <div class="container">
        <div class="card-header px-0 mt-2 bg-transparent clearfix">
            <h4 class="float-left pt-2">Pending Requests</h4>
            <div class="card-header-actions mr-1">
            </div>
        </div>

        <div class="card-body px-0">
            <div class="row justify-content-between">
                <div class="col-7 col-md-5">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" @click="filter">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search" v-model.trim="filters.search" @keyup.enter="filter">
                    </div>
                </div>
                <div class="col-auto">
                    <multiselect
                        v-model="filters.pagination.per_page"
                        :options="[25,50,100,200]"
                        :searchable="false"
                        :show-labels="false"
                        :allow-empty="false"
                        @select="changeSize"
                        placeholder="Search">
                    </multiselect>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="d-none d-sm-table-cell">
                        <a href="#" class="text-dark" @click.prevent="sort('id')">ID</a>
                        <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'id' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'id' && filters.orderBy.direction == 'desc'}"></i>
                    </th>
                    <th>
                        <a href="#" class="text-dark" @click.prevent="sort('project_name')">Project Name</a>
                        <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'project_name' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'project_name' && filters.orderBy.direction == 'desc'}"></i>
                    </th>
                    <th>
                        <a href="#" class="text-dark" @click.prevent="sort('project_code')">Project Code</a>
                        <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'project_code' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'product_code' && filters.orderBy.direction == 'desc'}"></i>
                    </th>
                    <th>
                        <a href="#" class="text-dark" @click.prevent="sort('Date')">Date</a>
                        <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'date' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'date' && filters.orderBy.direction == 'desc'}"></i>
                    </th>
                    <th>
                        <a href="#" class="text-dark" @click.prevent="sort('unit')">Unit</a>
                        <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'unit' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'unit' && filters.orderBy.direction == 'desc'}"></i>
                    </th>
                    <th>
                        <a href="#" class="text-dark" @click.prevent="sort('pharmacist')">Pharmacist</a>
                        <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'pharmacist' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'pharmacist' && filters.orderBy.direction == 'desc'}"></i>
                    </th>
                    <th>
                        <a href="#" class="text-dark" @click.prevent="sort('status')">Status</a>
                        <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'status' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'status' && filters.orderBy.direction == 'desc'}"></i>
                    </th>
                    <th class="d-none d-sm-table-cell">
                        <a href="#" class="text-dark">Approval Status</a>
                    </th>
                    <th class="d-none d-sm-table-cell">
                        Edit
                    </th>
                    <th class="d-none d-sm-table-cell">
                        Details
                    </th>
                    <th class="d-none d-sm-table-cell">
                        Delete
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="adminrequest in adminrequest">
                    <td class="d-none d-sm-table-cell">{{adminrequest.id}}</td>
                    <td class="d-none d-sm-table-cell">{{adminrequest.project_name}}</td>
                    <td class="d-none d-sm-table-cell">{{adminrequest.project_code}}</td>
                    <td class="d-none d-sm-table-cell">{{adminrequest.date}}</td>
                    <td class="d-none d-sm-table-cell">{{adminrequest.unit}}</td>
                    <td class="d-none d-sm-table-cell">{{adminrequest.pharmacist}}</td>
                    <span class="label label-success"><td class="d-none d-sm-table-cell">{{adminrequest.status}}</td></span>
                    <td class="d-none d-sm-table-cell">
                        <toggle-button @change="onChangeEventHandler(adminrequest.id)" :labels="{checked: 'Approved', unchecked: 'Pending'}" style="margin-left: 20px" width="80" />
                    </td>
                    <td class="d-none d-sm-table-cell" @click="editAdminRequest(adminrequest.id)">
                        <a href="#" class="text-muted"><i class="fa fa-edit"></i></a>
                    </td>
                    <td class="d-none d-sm-table-cell" @click="showprojectdetails(adminrequest.id)">
                        <a href="#" class="text-muted"><i class="fa fa-eye"></i></a>
                    </td>
                    <td class="d-none d-sm-table-cell" :disabled="submitingDestroy" @click.prevent="destroy">
                        <a href="#" class="text-muted"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import {ToggleButton} from 'vue-js-toggle-button';
import $ from 'jquery';
export default {
    data(){
        return{
            adminrequest:[],
            filters:{
                pagination:{
                    from: 0,
                    to: 0,
                    total: 0,
                    per_page: 25,
                    current_page: 1,
                    last_page: 0
                },
                orderBy: {
                    column: 'id',
                    direction: 'asc'
                },
                search: ''
            },
            loading: true
        }
    },
    mounted() {
        localStorage.getItem("filtersTableAdminRequest", this.filters);
        this.getAdminRequest()
    },
    methods: {
        getAdminRequest(){
            this.loading = true
            this.adminrequest = []

            localStorage.setItem('filtersTableAdminRequest', JSON.stringify(this.filters));

            axios.post(`/api/adminrequest/filter?page=${this.filters.pagination.current_page}`, this.filters)
                .then(response=> {
                    this.adminrequest = response.data.data
                    delete response.data.data
                    this.filters.pagination = response.data
                    this.loading = false
                })
        },
        editAdminRequest(id){
            location.href =`/adminreq/${id}/edit`
        },
        showAdminRequest(id){
            location.href = `/adminreq/${id}/show`
        },
        getReport(){
            axios.get(`/api/adminreq/getPendingReport`)
        },
        filter(){
            this.filters.pagination.current_page = 1
            this.getAdminRequest()
        },
        changeSize(perPage){
            this.filters.pagination.current_page = 1
            this.filters.pagination.per_page = perPage
            this.getAdminRequest()
        },
        sort(column){
            if(column == this.filters.orderBy.column) {
                this.filters.orderBy.direction = this.filters.orderBy.direction == 'asc' ? 'desc' : 'asc'
            } else {
                this.filters.orderBy.column = column
                this.filters.orderBy.direction = 'asc'
            }
            this.getAdminRequest()
        },
        changePage(page){
            this.filters.pagination.current_page = page
            this.getAdminRequest()
        },
        onChangeEventHandler(id){
            var status = $(this).prop('checked') === true ? 'Pending' : 'Approved';

            $.ajax({
                type: "GET",
                dataType: "json",
                url: `/api/adminrequest/changestatus?status=${status}&id=${id}`,
                success: function(data) {
                    console.log(data.success)
                }
            });
        },
        showprojectdetails(name){
            location.href = `/adminreq/${name}/projectdetails`
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
                            axios.delete(`/api/adminrequest/${id}`)
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
