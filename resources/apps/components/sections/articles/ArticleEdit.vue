<template lang="pug">

SectionBase(title="Editar artículo")
	template(slot="actions")
		.buttons
			.button.is-info.is-rounded.is-shadow-2(
				@click="save"
			)
				b-icon(icon="content-save")
				span Guardar
			.button.is-simple.is-rounded.is-shadow-2(
				@click="cancel"
			)
				b-icon(icon="close")
				span Cancelar

	.cms-section-wrapper.cms-articles-create
		ArticleForm(
			:id="id"
			:title.sync="title"
			:slug="slug"
			:body.sync="body"
			:description.sync="description"
			:image.sync="image"
			:status.sync="status"
			:category-id.sync="categoryId"
			:user-id.sync="userId"
			:tags.sync="tags"
		)

		b-loading(
			:is-full-page="false"
			:active="awaitServer"
		)

</template>

<script>
// Components
import ArticleForm from './ArticleForm'

// Functions
import {
	validateIfCanSave,
	validateIfChanged,
	convertDataToValidRequest
} from '@/functions/validateArticleFields'

export default {
	components: {
		ArticleForm,
	},

	data () {
		const 
			articleId  = parseInt(this.$route.params.id),
			article    = this.$store.getters['articles/getById'](articleId),
			articleOld = {
				title: article.title,
				description: article.description ? article.description : null,
				body: article.body ? article.body : '',
				image: article.image ? article.image : null,
				status: article.status == '0' ? false : true,
				categoryId: article.category_id ? article.category_id : null,
				tags: _.map(article.tags, o => {
					return { id: o.id, name: o.name }
				})
			}

		return {
			awaitServer: false,
			id: article.id,
			title: article.title,
			slug: article.slug,
			description: article.description ? article.description : null,
			status: article.status == '0' ? false : true,
			categoryId: article.category_id,
			userId: article.user_id,
			image: article.image ? article.image : null,
			body: article.body ? article.body : '',
			articleOld: articleOld,
			tags: _.map(article.tags, o => {
				return { id: o.id, name: o.name }
			}),
			clean: false,
		}
	},

	computed: {
		article () {
			return {
				id: this.id,
				title: this.title,
				slug: this.slug,
				description: this.description,
				body: this.body,
				image: this.image,
				status: this.status,
				categoryId: this.categoryId,
				tags: this.tags,
				clean: this.clean,
			}
		}
	},

	methods: {
		save () {
			let next = false

			if (!validateIfCanSave(this.article, this)) {
				this.$dialog.alert({
					title: 'Hay un problema...',
					message: 'Debes llenar los campos correctamente para poder guardar los cambios.',
					confirmText: 'De acuerdo!',
					type: 'is-warning',
				})

				return
			}

			if (!validateIfChanged(this.article, this.articleOld)) {
				this.$dialog.alert({
					title: 'Hay un problema...',
					message: 'Tienes que realizar cambios para poder modificar un artículo.',
					confirmText: 'De acuerdo!',
					type: 'is-warning',
				})

				return
			}

			this.awaitServer = true

			let data = convertDataToValidRequest(this.article)
			let self = this

			this.$store.dispatch('articles/serverUpdateItem', { id: this.article.id, modified: data })
				.then(item => {
					this.awaitServer = false

					self.$toast.open({
						duration: 3000,
						message: 'Tú artículo se ha guardado exitosamente!',
						position: 'is-bottom-right',
					})

					this.$store.commit('articles/saveRelations', { article: item, store: this.$store })

					self.clearData()

					self.$router.push({ name: 'article' })
				})
				.catch(err => {
					console.log(err)
				})
		},

		cancel () {
			if (this.$route.query.previous) {
				this.$router.push({ name: this.$route.query.previous })
				
				return
			}

			this.$router.push({ name: 'dashboard' })
		},

		clearData () {
			this.title = null
			this.body = ''
			this.description = null
			this.categoryId = 1
			this.status = false
			this.image = null
			this.tags = []
			this.clean = true
		}
	},

	beforeRouteLeave (to, from, next) {
		if (!validateIfChanged(this.article, this.articleOld)) {
			return next()
		}

		this.$dialog.confirm({
			title: 'Seguro que quieres salir?',
			message: 'No has guardado los cambios y se perderían permanentemente!',
			confirmText: 'Salir',
			cancelText: 'Cancelar',
			type: 'is-danger',
			onConfirm () {
				next()
			},
			onCancel () {
				next(false)
			}
		})
	}

}

</script>