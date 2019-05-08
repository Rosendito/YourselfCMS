<template lang="pug">
	
.columns.is-multiline
	.column.is-12.cms-section-subtitle
		.subtitle Tús Artículos
	.column.is-half-widescreen(
		:class="isMenuToggle ? 'is-half' : 'is-12'"
	)
		DashboardArticlesList(:data="recents")
			a(slot="action") Ver todos


	.column.is-half-widescreen(
		:class="isMenuToggle ? 'is-half' : 'is-12'"
	)
		DashboardArticlesList(
			:data="drafts"
			:awaitServer="awaitServer"
		)
			a(slot="action") Ver todos
			.cms-dashboard-articles-column(
				slot="customColumn"
				slot-scope="{ article }"
			)
				b-tooltip(
					position="is-bottom"
					type="is-dark"
					:label="changeStatusLabel(article)"
				)
					b-switch(
						@input="changeStatus(article)"
						type="is-success"
						size="is-small"
						:value="article.status == '0' ? false : true"
						:disabled="!checkIfCanPublish(article)"
					)
</template>

<script>
// Components
import DashboardArticlesList from './DashboardArticlesList'

// Functions
import { validateIfCanPublish } from '@/functions/validateArticleFields'

export default {
	props: {
		isMenuToggle: {
			type: Boolean,
			required: true
		}
	},

	data () {
		return {
			awaitServer: false,
			recents: this.setArticlesRecents(),
			drafts: this.setArticlesDrafts(),
		}
	},

	methods: {
		changeStatus (article) {
			this.awaitServer = true

			this.$store.dispatch('articles/serverUpdateItem', {
				id: article.id,
				modified: {
					status: article.status == '0' ? '1' : '0'
				}
			}).then(newArticle => {
				this.$store.commit('articles/saveRelations', { article: newArticle, store: this.$store })

				article.status = article.status == '0' ? '1' : '0'


				let message = article.status == '0' ? 'Se ha puesto el artículo en estado de "Edición"' : 'Se ha puesto el artículo en estado de "Publicado"'

				this.$toast.open({
					duration: 3000,
					message: message,
					position: 'is-bottom-right',
				})
				this.awaitServer = false
			})
		},
		setArticlesRecents () {
			let articlesRecents = this.$store.getters['articles/getOrderBy']({
				attr: ['created_at', 'id'],
				order: ['desc', 'desc']
			})

			articlesRecents = articlesRecents.slice(0,6)

			return {
				title: 'Artículos más recientes',
				articles: articlesRecents,
			}
		},
		setArticlesDrafts () {
			let articlesDrafts  = this.$store.getters['articles/getFilter']({
				attr: 'status', value: '0'
			})

			articlesDrafts  = _.orderBy(articlesDrafts, ['created_at', 'id'], ['desc', 'desc'])
			articlesDrafts  = articlesDrafts.slice(0,6)

			return {
				title: 'Artículos en edición',
				articles: articlesDrafts,
			}
		},
		checkIfCanPublish (article) {
			article =  {
				title: article.title,
				description: article.description ? article.description : null,
				status: article.status == '0' ? false : true,
				categoryId: article.category_id,
				userId: article.user_id,
				image: article.image ? article.image : null,
				body: article.body ? article.body : null,
				tags: _.map(article.tags, o => {
					return { id: o.id, name: o.name }
				}),
			}

			return validateIfCanPublish(article)
		},
		changeStatusLabel (article) {
			if (!this.checkIfCanPublish(article)) {
				return 'Primero debes terminar el artículo.'
			}

			return article.status == '0' ? 'Publicar' : 'Poner en edición'
		}
	},

	components: {
		DashboardArticlesList,
	},
}

</script>