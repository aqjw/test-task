export default {
	state: {
		jobs_list: [],
		show_job: null,
	},
	getters: {
		jobs_list: state => state.jobs_list,
		show_job: state => state.show_job,
	},
	actions: {
		loadJobs({commit}, page) {
			return axios.get(`/api/jobs?page=${page}`)
				.then(response => {
	                commit('PUSH_JOBS_LIST', response.data)
	                return response.data.length;
	            })
		},
		loadJob({commit}, id) {
			return axios.get(`/api/jobs/${id}`)
				.then(response => {
	                commit('SET_SHOW_JOB', response.data)
	            })
		},
		sendApplication({state}, {job_id, formData}) {
			return axios.post(`/api/jobs/${job_id}/send-application`, formData, {
                headers: {'Content-Type': 'multipart/form-data'}
			})
		},
		
	},
	mutations: {
		PUSH_JOBS_LIST(state, response) {
			$.each(response, function(key, value) {
				state.jobs_list.push(value)
			})
		},
		SET_SHOW_JOB(state, response) {
			state.show_job = response
		},
	}
}