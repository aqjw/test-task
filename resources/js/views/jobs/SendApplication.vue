<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" v-if="job">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Application for <b>{{ job.title }}</b></span>
                        <router-link :to="`/spa/jobs/${job.id}`" class="btn btn-sm btn-primary">
                            back to job post
                        </router-link>
                    </div>

                    <div class="card-body">
                        <div v-if="message" class="alert alert-success" role="alert">
                            <strong v-html="message"></strong>
                        </div>

                        <h3>Application's form</h3>
                        <form @submit.prevent="sendApplication" enctype="multipart/form-data" ref="form">
                            <div class="form-group">
                                <label for="yourName">Name</label>
                                <input type="text" class="form-control" ref="name" id="yourName" placeholder="Enter your name" required>
                            </div>

                            <div class="form-group">
                                <label for="yourEmail">Email</label>
                                <input type="email" class="form-control" ref="email" id="yourEmail" placeholder="Enter your email" required>
                            </div>

                            <div class="form-group">
                                <label for="yourCV">Choose CV</label><br>
                                <input type="file" ref="file" id="yourCV" required>
                            </div>

                            <button class="btn btn-success">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['job_id'],
        data() {
            return {
                message: null,
            }
        },
        computed: {
            job() {
                return this.$store.getters.show_job
            }
        },
        mounted() {
            this.message = null
            this.$store.dispatch('loadJob', this.job_id)
        },
        methods: {
            sendApplication(event) {
                let formData = new FormData()
                formData.append('name', this.$refs.name.value)
                formData.append('email', this.$refs.email.value)
                formData.append('file', this.$refs.file.files[0])

                this.$store.dispatch('sendApplication', {
                    job_id: this.job_id,
                    formData: formData
                })
                    .then(response => {
                        event.target.reset()
                        this.message = 'Application sent successfully.<br>You will be redirected to the post page in 5 seconds.'
                        setTimeout(() => {
                            this.$router.push({path: `/spa/jobs/${this.job.id}`})
                        }, 5000);
                    })
                    .catch(response =>{
                        console.log(response)
                    })
            }
        }
    }
</script>
