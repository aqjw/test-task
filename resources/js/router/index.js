import Vue from 'vue'
import Router from 'vue-router'

// routes
import Routes from './routes';

Vue.use(Router)

export default new Router({
	mode: 'history',
	routes: [
		Routes,
	]
})
