<template lang="pug">

.cms-app-loading(v-if="loading")
	h1.title.is-size-5.has-text-grey Cargando...

main(v-else)
	TheMenuLateral(
		:isMenuToggle="isMenuToggle"
		@changedMenuToggle="changeMenuToggle"
	)

	.cms-content(:class="{ 'is-expanded': isMenuToggle }")
		TheMenuNavbar
		
		router-view
	

</template>

<script>
// Components
import TheMenuLateral from './layouts/TheMenuLateral'
import TheMenuNavbar from './layouts/TheMenuNavbar'

// Functions 
import InitializeStore from '@/functions/InitializeStore'

// Store
import { mapState, mapMutations } from 'vuex'

export default {
	data () {
		return {
			loading: true,
		}
	},

	components: {
		TheMenuLateral, TheMenuNavbar
	},

	computed: {
		...mapState(['isMenuToggle']),
	},

	methods: {
		...mapMutations(['changeMenuToggle']),
	},

	mounted () {
		InitializeStore(this)
	},
}

</script>