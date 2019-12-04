/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

// app.vue
import App from './App'

// router
import router from './router'

// store
import { store } from './store/store'

// modal
import VModal from 'vue-js-modal'
Vue.use(VModal)

Vue.component('InfiniteLoading', require('vue-infinite-loading'))

import AcceptApplication from './global_components/AcceptApplication'
Vue.component('AcceptApplication', AcceptApplication)
 
if (document.getElementById('app')) {
    new Vue({
        store,
        router,
        render: h => h(App),
        components: { App }
    }).$mount('#app')
}

if (document.getElementById('app-admin')) {
    new Vue({
        el: '#app-admin',
        store
    })
}