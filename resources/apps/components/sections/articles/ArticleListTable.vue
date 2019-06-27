<template lang="pug">
	
b-table.cms-articles-list-body(
	:data="articles"
	:paginated="paginated"
	:per-page="perPage"
	:pagination-simple="simplePagination"
	:loading="loading"
)

	template(
		slot-scope="{ column, index }"
		slot="header"
	)
		.th-wrap(
			v-if="index !== 2 && index !== 3 && index !== 5"
			@click="sort(column.field)"
			:class="{'is-sortable': true, 'is-current-sort': column.field == sortProperty }"
		)
			span {{ column.label }}
			b-icon(
				icon="menu-swap"
			)

		.th-wrap(v-else)
			span {{ column.label }}
			

	template(slot-scope="{ row }")
		b-table-column(
			field="id"
			label="Id"
		)
			a 
				b {{ row.id }}

		b-table-column(
			field="title"
			label="Título"
		)
			b {{ row.title }}

		b-table-column(
			field="user.name"
			label="Autor"
		)

			.media
				AccountImageBase.media-left(
					:imageSrc="row.user.image ? URL.images + row.user.image : false"
				)

				.media-content
					b {{ row.user.name | shortUserName }}

		b-table-column(
			field="status"
			label="Estado"
		)
			b-tag(
				v-if="row.status == '0'"
				type="is-warning"
			)
				| En edición
			b-tag(
				v-else
				type="is-success"
			)
				| Publicado

		b-table-column(
			field="created_at"
			label="Fecha"
		)
			span {{ row.created_at | moment('DD/MM/YY') }}

		b-table-column

			b-dropdown(position="is-bottom-left")
				a.cms-articles-list-body-action(slot="trigger")
					b-icon(icon="dots-vertical")

				b-dropdown-item(
					@click="$router.push({ name: 'article/edit', params: { id: row.id }, query: { previous: 'article' } })"
				)
					b-icon(icon="pencil")
					span Editar

				b-dropdown-item(
					@click="changeStatus(row)"
					:disabled="!checkIfCanPublish(row)"
				)
					template(
						v-if="row.status == '0'"
					)
						b-icon(icon="earth")
						span Publicar

					template(
						v-else
					)
						b-icon(icon="earth-off")
						span Despublicar

				b-dropdown-item(
					@click="$router.push({ name: 'article/detail', params: { id: row.id } })"
				)
					b-icon(icon="eye")
					span Ver

				b-dropdown-item(
					@click="deleteArticle(row.id)"
				)
					b-icon(icon="trash-can")
					span Eliminar
	

</template>

<script>
// Components
import AccountImageBase from '@/components/reusable/AccountImageBase'

// Functions
import { validateIfCanPublish } from '@/functions/validateArticleFields'

import { URL } from '@/functions/tools'

export default {
	components: {
		AccountImageBase,
	},

	data () {
		return {
			URL
		}
	},

	props: {
		articles: Array,
		paginated: Boolean,
		simplePagination: Boolean,
		perPage: Number,
		loading: Boolean,
		sortProperty: String,
		sortDirection: String,
	},

	methods: {
		sort (field) {
			if (this.sortProperty == field) {
				this.$emit('update:sortDirection', this.sortDirection == 'asc' ? 'desc' : 'asc')
				
				return
			}

			this.$emit('update:sortProperty', field)
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
		changeStatus (article) {
			if (!this.checkIfCanPublish(article)) return

			this.$emit('changeStatus', article)
		},
		deleteArticle (id) {
			this.$emit('deleteArticle', id)
		}
	}
}

</script>