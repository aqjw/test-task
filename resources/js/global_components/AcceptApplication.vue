<template>
    <div class="d-inline-block">
        <modal name="accept_application" :width="500" :height="260">
            <div class="p-4">
                <form @submit.prevent="acceptApplication" ref="form">
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" v-model="location" placeholder="Enter location" required>
                    </div>

                    <div class="form-group">
                        <label for="location">Time</label>
                        <datetime v-model="appointed_time" type="datetime"
                            input-class="form-control" :format="appointed_time_format"
                            placeholder="Choose date and time"></datetime>
                    </div>
                    
                    <button class="btn btn-sm btn-success" v-if="!accepted">accept and send email</button>
                    <div role="alert" v-if="accepted" class="alert alert-info p-2">
                        <strong>Application accept successfully.</strong>
                    </div>
                </form>
            </div>
        </modal>
        
        <button class="btn btn-sm btn-success" @click="show" v-if="!accepted">accept</button>
    </div>
</template>

<script>
    import { Datetime } from 'vue-datetime'
    import 'vue-datetime/dist/vue-datetime.css'

    export default {
        props: ['application_id'],
        components: {Datetime},
        data() {
            return {
                accepted: false,

                appointed_time: null,
                location: null,

                appointed_time_format: { 
                    year: 'numeric', 
                    month: '2-digit', 
                    day: '2-digit', 
                    hour: 'numeric', 
                    minute: '2-digit', 
                    hour12: false
                },
            }
        },
        methods: {
            acceptApplication(event) {
                this.$store.dispatch('acceptApplication', {
                    application_id: this.application_id,
                    formData: {
                        location: this.location,
                        appointed_time: this.appointed_time,
                    }
                })
                    .then(response => {
                        event.target.reset()
                        this.accepted = true
                        setTimeout(() => {
                            this.hide()
                        }, 3000)
                    })
                    .catch(response =>{
                        console.log(response)
                    })
            },
            show() {
                this.$modal.show('accept_application')
            },
            hide() {
                this.$modal.hide('accept_application')
            }
        }
    }
</script>
