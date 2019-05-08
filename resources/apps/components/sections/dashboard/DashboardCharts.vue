<template lang="pug">

.columns.is-multiline
	.column.is-12.cms-section-subtitle
		.subtitle Tus números

	.column(v-for="chart in charts")
		.cms-dashboard-chart.is-shadow-2(:class="chart.style")
			.cms-dashboard-chart-heading
				b-icon(:icon="chart.icon")
				strong {{ chart.value }}

			span {{ chart.name }}


</template>

<script>

export default {
	data () {
		let 
			articlesCount   = this.$store.state.articles.items.length,
			categoriesCount = this.$store.state.categories.items.length,
			tagsCount       = this.$store.state.tags.items.length,
			usersCount      = this.$store.state.users.items.length

		return{
			charts: [
				{ name: 'Artículos', value: articlesCount, icon: 'library-books', style: 'is-info' },
				{ name: 'Categorías', value: categoriesCount, icon: 'shape', style: 'is-success' },
				{ name: 'Etiquetas', value: tagsCount, icon: 'tag', style: 'is-warning' },
				{ name: 'Usuarios', value: usersCount, icon: 'account-multiple', style: 'is-primary' },
			],
		}
	}
}

</script>