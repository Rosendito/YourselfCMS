<template lang="pug">
	
SectionBase(title="Artículos")
	template(slot="actions")
		.button.is-info.is-rounded.is-shadow-2(
			@click="$router.push({ name: 'article/create', query: { previous: 'article' } })"
		)
			b-icon(icon="pencil")
			span Crear artículo

	.cms-section-wrapper.cms-articles
		ArticlesList

</template>

<script>
// Components
import ArticlesList from './ArticlesList'

export default {
	components: {
		ArticlesList,
	},
}

</script>
