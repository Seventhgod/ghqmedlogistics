<template>
    <div class="card text-white bg-info">
        <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
                <i class="icon-people"></i>
            </div>
            <div class="text-value">{{drugrequest}}</div>
            <small class="text-muted text-uppercase font-weight-bold">Requests Made</small>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            drugrequest: 0
        }
    },
    mounted() {
        this.getProjectsCount()
    },
    methods: {
        getProjectsCount(){
            axios.get(`/requestcount`)
                .then(response => {
                    this.drugrequest = response.data
                })
        },
    }
}
</script>

<style scoped>

</style>
