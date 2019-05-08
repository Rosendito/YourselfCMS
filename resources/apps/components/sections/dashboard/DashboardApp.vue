<template lang="pug">
	
SectionBase(title="Escritorio")

	.cms-section-wrapper.cms-dashboard
		DashboardCharts
		DashboardArticles(:isMenuToggle="isMenuToggle")

</template>

<script>
// Components
import DashboardCharts from './DashboardCharts'
import DashboardArticles from './DashboardArticles'

// Store
import { mapState } from 'vuex'

export default {
	components: {
		DashboardCharts, DashboardArticles
	},

	computed: {
		...mapState(['isMenuToggle'])
	},
}

</script>