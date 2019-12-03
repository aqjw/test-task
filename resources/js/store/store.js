import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

// modules
import jobs from './modules/jobs'

export const store = new Vuex.Store({
	modules: {
		jobs
	},
})