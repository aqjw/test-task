<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">List of jobs</div>

                    <div class="card-body">
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="job in jobs">
                                        <th scope="row">{{ job.id }}</th>
                                        <td>{{ job.title }}</td>
                                        <td>{{ job.description_short }}</td>
                                        <td>
                                            <router-link :to="`/spa/jobs/${job.id}`" class="btn btn-sm btn-warning">
                                                Details
                                            </router-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <infinite-loading @distance="1" @infinite="infiniteHandler"></infinite-loading>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                page: 1,
            }
          },
        computed: {
            jobs() {
                return this.$store.getters.jobs_list
            },
        },
        methods: {
            infiniteHandler(state) {
                this.$store.dispatch('loadJobs', this.page)
                    .then((jobs_length) => {
                        if (jobs_length) {
                            this.page++
                            state.loaded()
                        } else {
                            state.complete()
                        }
                    })
            },
        },
    }
</script>
