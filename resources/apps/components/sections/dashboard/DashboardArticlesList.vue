<template lang="pug">

.box.cms-dashboard-articles
	.level.cms-dashboard-articles-header
		.level-left
			b {{ title }}
		.level-right
			slot(name="action")

	VuePerfectScrollbar.cms-dashboard-articles-list
		.cms-dashboard-articles-empty(v-if="articles.length <= 0")
			b Parece que no tenemos elementos disponibles para esta sección.

		.cms-dashboard-articles-item(
			v-for="article in articles"
			:key="article.id"
		)
			.cms-dashboard-articles-column
				AccountImageBase(:imageSrc="article.user.image ? URL.images + article.user.image : false")

			.cms-dashboard-articles-column
				b {{ article.title }}
				small {{ article.created_at | moment('from') }}

			//- If custom Column
			slot(
				name="customColumn"
				:article="article"
				:awaitServer="awaitServer"
			)

			.cms-dashboard-articles-column
				b-dropdown(
					position="is-bottom-left"
					slot="options"
				)
					.button.is-white.is-rounded(slot="trigger")
						b-icon(
							icon="dots-vertical"
						)

					b-dropdown-item(
						@click="$router.push({ name: 'article/edit', params: { id: article.id }, query: { previous: 'dashboard' } })"
					)
						b-icon(icon="pencil")
						span Editar

					b-dropdown-item(
						@click="$router.push({ name: 'article/detail', params: { id: article.id } })"
					)
						b-icon(icon="eye")
						span Ver detalles

	b-loading(
		:active="awaitServer == null ? false : awaitServer"
		:is-full-page="false"
	)

</template>

<script>
// Components
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
import AccountImageBase from '@/components/reusable/AccountImageBase'

import { URL } from '@/functions/tools'

export default {
	props: {
		data: {
			type: Object,
			required: true,
		},

		awaitServer: {
			type: Boolean,
		}
	},

	data () {
		return {
			articles: this.data.articles,
			title: this.data.title,
			URL
		}
	},

	components: {
		VuePerfectScrollbar, AccountImageBase
	},
}

</script>