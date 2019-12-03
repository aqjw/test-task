<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" v-if="job">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ job.title }}</span>
                        <router-link to="/spa/jobs" class="btn btn-sm btn-primary">
                            back to list
                        </router-link>
                    </div>

                    <div class="card-body">
                        <p v-html="job.description"></p>
                        <div>
                            <router-link :to="`/spa/jobs/send-application/${job_id}`" class="btn btn-success">
                                Send application
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['job_id'],
        computed: {
            job() {
                return this.$store.getters.show_job
            }
        },
        mounted() {
            this.$store.dispatch('loadJob', this.job_id)
        }
    }
</script>
