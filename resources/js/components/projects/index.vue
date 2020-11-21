<template>
    <div class="container">
        <div class="card-header px-0 mt-2 bg-transparent clearfix">
            <h4 class="float-left pt-2">Projects</h4>
            <div class="card-header-actions mr-1">
                <a class="btn btn-success" href="/projects/create">New Project</a>
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
                <th>
                    <a href="#" class="text-dark" @click.prevent="sort('project_code')">Project Code</a>
                    <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'project_code' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'project_code' && filters.orderBy.direction == 'desc'}"></i>
                </th>
                <th>
                    <a href="#" class="text-dark" @click.prevent="sort('project_name')">Project Name</a>
                    <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'project_name' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'project_name' && filters.orderBy.direction == 'desc'}"></i>
                </th>
                <th>
                    <a href="#" class="text-dark" @click.prevent="sort('date')">Date</a>
                    <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'date' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'date' && filters.orderBy.direction == 'desc'}"></i>
                </th>
                <th>
                    <a href="#" class="text-dark" @click.prevent="sort('type')">Type</a>
                    <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'type' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'type' && filters.orderBy.direction == 'desc'}"></i>
                </th>
                <th>
                    <a href="#" class="text-dark" @click.prevent="sort('initiator')">Initiator</a>
                    <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'initiator' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'initiator' && filters.orderBy.direction == 'desc'}"></i>
                </th>
                <th>
                    <a href="#" class="text-dark" @click.prevent="sort('unit')">Unit</a>
                    <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'unit' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'unit' && filters.orderBy.direction == 'desc'}"></i>
                </th>
                <th>
                    <a href="#" class="text-dark" @click.prevent="sort('status')">Status</a>
                    <i class="mr-1 fas" :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'status' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'status' && filters.orderBy.direction == 'desc'}"></i>
                </th>
                <th class="d-none d-sm-table-cell">
                    Edit
                </th>
                <th class="d-none d-sm-table-cell">
                    Details
                </th>
                <th class="d-none d-sm-table-cell">
                    Add Request
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="project in projects">
                <td class="d-none d-sm-table-cell">{{project.project_code}}</td>
                <td class="d-none d-sm-table-cell">{{project.project_name}}</td>
                <td class="d-none d-sm-table-cell">{{project.date}}</td>
                <td class="d-none d-sm-table-cell">{{project.type}}</td>
                <td class="d-none d-sm-table-cell">{{project.initiator}}</td>
                <td class="d-none d-sm-table-cell">{{project.unit}}</td>
                <td class="d-none d-sm-table-cell">{{project.status}}</td>
                <td class="d-none d-sm-table-cell" @click="editProject(project.id)">
                    <a href="#" class="text-muted"><i class="fa fa-edit"></i></a>
                </td>
                <td class="d-none d-sm-table-cell" @click="showprojectdetails(project.id)">
                    <a href="#" class="text-muted"><i class="fa fa-eye"></i></a>

                <td class="d-none d-sm-table-cell" @click="addRequest(project.id)">
                    <a href="#" class="text-muted"><i class="fa fa-plus"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row" v-if='!loading && filters.pagination.total > 0'>
        <div class="col pt-2">
          {{filters.pagination.from}}-{{filters.pagination.to}} of {{filters.pagination.total}}
        </div>
        <div class="col" v-if="filters.pagination.last_page>1">
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
              <li class="page-item" :class="{'disabled': filters.pagination.current_page <= 1}">
                <a class="page-link" href="#" @click.prevent="changePage(filters.pagination.current_page -  1)"><i class="fas fa-angle-left"></i></a>
              </li>
              <li class="page-item" v-for="page in filters.pagination.last_page" :class="{'active': filters.pagination.current_page == page}">
                <span class="page-link" v-if="filters.pagination.current_page == page">{{page}}</span>
                <a class="page-link" href="#" v-else @click.prevent="changePage(page)">{{page}}</a>
              </li>
              <li class="page-item" :class="{'disabled': filters.pagination.current_page >= filters.pagination.last_page}">
                <a class="page-link" href="#" @click.prevent="changePage(filters.pagination.current_page +  1)"><i class="fas fa-angle-right"></i></a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <div class="no-items-found text-center mt-5" v-if="!loading && !projects.length > 0">
        <i class="icon-magnifier fa-3x text-muted"></i>
        <p class="mb-0 mt-3"><strong>Could not find any items</strong></p>
        <p class="text-muted">Try changing the filters or add a new one</p>
        <a class="btn btn-success" href="/projects/create" role="button">
          <i class="fa fa-plus"></i>&nbsp; New Project
        </a>
      </div>
    <content-placeholders v-if="loading">
        <content-placeholders-text/>
    </content-placeholders>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return{
            projects:[],
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
        localStorage.getItem("filtersTableProjects", this.filters);
        this.getProjects()
    },
    methods: {
        getProjects(){
            this.loading = true
            this.projects = []

            localStorage.setItem('filtersTableProjects', JSON.stringify(this.filters));

            axios.post(`/api/projects/filter?page=${this.filters.pagination.current_page}`, this.filters)
            .then(response=> {
                this.projects = response.data.data
                delete response.data.data
                this.filters.pagination = response.data
                this.loading = false
            })
        },
        editProject(id){
            location.href =`/projects/${id}/edit`
        },
        showProject(id){
            location.href = `/projects/${id}/show`
        },
        getReport(){
            axios.get(`/getReport`)
        },
        showprojectdetails(id){
            location.href = `/projects/${id}/projectdetails`
        },
        addRequest(id){
            location.href =`/projects/${id}/addrequest`
        },
        filter(){
            this.filters.pagination.current_page = 1
            this.getProjects()
        },
        changeSize(perPage){
            this.filters.pagination.current_page = 1
            this.filters.pagination.per_page = perPage
            this.getProjects()
        },
        sort(column){
            if(column == this.filters.orderBy.column) {
                this.filters.orderBy.direction = this.filters.orderBy.direction == 'asc' ? 'desc' : 'asc'
            } else {
                this.filters.orderBy.column = column
                this.filters.orderBy.direction = 'asc'
            }
            this.getProjects()
        },
        changePage(page){
            this.filters.pagination.current_page = page
            this.getProjects()
        }
    },
    destroy(id){
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
                        axios.delete(`/api/projects/${id}`)
                            .then(response => {
                                this.$toasted.global.error('Deleted Request!')
                                location.href = '/projects'
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
</script>

<style scoped>

</style>
