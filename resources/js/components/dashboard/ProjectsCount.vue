<template>
    <div class="card text-white bg-info">
        <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
                <i class="icon-people"></i>
            </div>
            <div class="text-value">{{projects}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Projects Added</small>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            projects: 0
        }
    },
    mounted() {
        this.getProjectsCount()
    },
    methods: {
        getProjectsCount(){
            axios.get(`/api/projects/count`)
            .then(response => {
                this.projects = response.data
            })
        },
    }
}
</script>

<style scoped>

</style>
