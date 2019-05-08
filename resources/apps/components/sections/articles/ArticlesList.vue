<template lang="pug">
	
.columns.is-multiline
	.column.is-12.cms-section-subtitle
		.subtitle Todos tús artículos

	.column.is-12
		.cms-articles-list
			ArticleListFilters(
				:userOptions="filterUsersOptions"
				:statusOptions="filterStatusOptions"
				:userSelected.sync="filterUserSelected"
				:statusSelected.sync="filterStatusSelected"
				:articleSearch.sync="filterArticleSearch"
			)

			ArticleListTable(
				:articles="articles"
				:paginated="tablePaginated"
				:simplePagination="tableSimplePagination"
				:perPage="tablePerPage"
				:loading="awaitServer"
				:sortProperty.sync="tableSortProperty"
				:sortDirection.sync="tableSortDirection"
				@changeStatus="changeStatus"
				@deleteArticle="confirmDeleteArticle"
			)
					
</template>

<script>
// Components
import AccountImageBase from '@/components/reusable/AccountImageBase'
import ArticleListTable from './ArticleListTable'
import ArticleListFilters from './ArticleListFilters'

export default {
	components: {
		AccountImageBase,
		ArticleListTable,
		ArticleListFilters,
	},

	data () {
		return {
			articles: [],
			awaitServer: false,
			tablePaginated: true,
			tablePerPage: 5,
			tableSimplePagination: true,
			tableSortProperty: 'created_at',
			tableSortDirection: 'desc',
			tableSortPropertySecondary: 'id',
			tableSortDirectionSecondary: 'desc',
			filterUsersOptions: this.setFilterUsersOptions(),
			filterUserSelected: null,
			filterStatusOptions: this.setFiltersStatusOptions(),
			filterStatusSelected: null,
			filterArticleSearch: null,
		}
	},

	watch: {
		filterStatusSelected (value) {
			this.articles = this.setArticles()
		},

		filterUserSelected (value) {
			this.articles = this.setArticles()
		},

		filterArticleSearch (value) {
			this.articles = this.setArticles()
		},

		tableSortProperty (value) {
			this.articles = this.setArticles()
		},

		tableSortDirection (value) {
			this.articles = this.setArticles()
		}
	},

	methods: {
		setArticles () {
			let articles = this.$store.state.articles.items

			if (this.filterArticleSearch) {
				articles = _.filter(articles , ({ title }) => {
					return title.toString()
						.toLowerCase()
						.indexOf(this.filterArticleSearch.toLowerCase()) >= 0
				})
			}

			if (this.filterUserSelected) {
				articles = _.filter(articles, o => o.user.id == this.filterUserSelected)
			}

			if (this.filterStatusSelected) {
				articles = _.filter(articles, o => o.status == this.filterStatusSelected)
			}

			let 
				sortProp    = this.tableSortProperty,
				sortPropSec = this.tableSortDirectionSecondary,
				sortDir     = this.tableSortDirection,
				sortDirSec  = this.tableSortDirectionSecondary

			articles = _.orderBy(articles, [sortProp, sortPropSec], [sortDir, sortDirSec])

			return articles
		},

		setFilterUsersOptions () {
			let users = this.$store.state.users.items

			return users 
		},

		setFiltersStatusOptions () {
			let status = [
				{ name: 'Publicado', value: '1' },
				{ name: 'Edición', value: '0' }
			]

			return status
		},
		changeStatus (article) {
			this.awaitServer = true

			this.$store.dispatch('articles/serverUpdateItem', {
				id: article.id,
				modified: {
					status: article.status == '0' ? '1' : '0'
				}
			})
				.then(newArticle => {
					this.$store.commit('articles/saveRelations', { article: newArticle, store: this.$store })

					this.articles = this.setArticles()

					let message = article.status == '0' ? 'Se ha puesto el artículo en estado de "Edición"' : 'Se ha puesto el artículo en estado de "Publicado"'

					this.$toast.open({
						duration: 3000,
						message: message,
						position: 'is-bottom-right',
					})
					this.awaitServer = false
				})
		},
		confirmDeleteArticle (id) {
			let self = this

			this.$dialog.confirm({
				title: 'Estás seguro?',
				message: 'Estás a punto de borrar un artículo para siempre, confirma si quieres continuar.',
				confirmText: 'Confirmar',
				onConfirm () {
					self.deleteArticle(id)
				}
			})
		},
		deleteArticle (id) {
			this.awaitServer = true

			this.$store.dispatch('articles/serverDeleteItem', id)
				.then(item => {
					this.awaitServer = false

					this.$toast.open({
						duration: 3000,
						message: 'Se ha borrado el artículo exitosamente!',
						position: 'is-bottom-right',
					})

					this.articles = this.setArticles()
				})
		}
	},

	created () {
		this.articles = this.setArticles()
	}
}

</script>
