// Config Bootstrap
require('@/config/bootstrap')

// Vue sources
import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'

// Buefy
import Buefy from 'buefy/src/index'

// VueMoment 
import VueMoment from 'vue-moment'
import moment from 'moment'

require('moment/locale/es')

// Components 
import App from '@/components/App'
import SectionBase from '@/components/sections/SectionBase'

// Store Data
import storeData from '@/store/store'

// Routes
import routes from '@/config/routes'

// Vue Filters
import filters from '@/config/filters'

// Prepare Plugins
Vue.use(Vuex)
Vue.use(VueRouter)
Vue.use(Buefy)
Vue.use(VueMoment, {
	moment
})

filters(Vue)

Vue.component('SectionBase', SectionBase)

// Prepare Store
const store = new Vuex.Store(storeData)

// Prepare Routes
const router = new VueRouter({
	routes,
	linkActiveClass: 'is-active',
	mode: 'history'
})

// Vue App
const app = new Vue({
	el: '#app',
	router,
	store,
	render: h => h(App),
})