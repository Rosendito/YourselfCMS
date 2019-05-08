<template lang="pug">
	
.cms-menulateral.is-shadow-8(:class="{ 'is-toggle': isMenuToggle }")

	//- Brand
	.cms-menulateral-brand
		span.complete MyBoard
		span.first-char M
	
	//- Options
	VuePerfectScrollbar.cms-menulateral-options
	
		.cms-menulateral-item(@click="changeMenuToggle")
			b-icon(icon="menu")
			span Esconder menu

		//- Primary Action
		.cms-menulateral-primary
			.button.is-info.is-rounded(
				@click="toArticleCreate"
			)
				b-icon(icon="pencil")
				span Crear artículo

		.cms-menulateral-section(v-for="section in sections")
			router-link.cms-menulateral-item(
				v-for="item in section.items"
				:to="{ name: item.route }"
				:key="item.name"
			) 
				b-icon(:icon="item.icon")
				span {{ item.name }}

</template>

<script>
// Components
import VuePerfectScrollbar from 'vue-perfect-scrollbar'

// Sections - Items
const sections = [
	{
		label: 'Tablero',
		items: [
			{ name: 'Escritorio', icon: 'home', route: 'dashboard' },
		]
	},
	{
		label: 'Gestión de Entradas',
		items: [
			{ name: 'Artículos', icon: 'library-books', route: 'article' },
			{ name: 'Categorías', icon: 'shape', route: 'category' },
			{ name: 'Etiquetas', icon: 'tag', route: 'tag' },
		]
	},
	{
		label: 'Gestión de Usuarios',
		items: [
			{ name: 'Usuarios', icon: 'account-multiple', route: 'user' },
		]
	},
]

export default {
	props: {
		isMenuToggle: {
			required: true,
			type: Boolean,
		},
	},

	data () {
		return {
			sections,
		}
	},

	components: {
		VuePerfectScrollbar
	},

	methods: {
		changeMenuToggle () {
			this.$emit('changedMenuToggle')
		},

		toArticleCreate () {
			let previous

			if (this.$route.name == 'article/create') {
				previous = this.$route.query.previous ? this.$route.query.previous : 'dashboard'
			}else {
				previous = this.$route.name
			}

			this.$router.push({ name: 'article/create', query: { previous: previous } })
		}
	}
}

</script>