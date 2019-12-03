
import Api from './api.js'

export default {
	state: {
		...Api.state
	},
	getters: {
		...Api.getters
	},
	actions: {
		...Api.actions
	},
	mutations: {
		...Api.mutations
	}
}
