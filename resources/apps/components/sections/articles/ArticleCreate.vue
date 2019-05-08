<template lang="pug">

SectionBase(title="Crear artículo")
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
		return {
			id: 0,
			title: null,
			slug: null,
			description: null,
			status: false,
			categoryId: 1,
			userId: this.$store.state.logged.userId,
			tags: [],
			image: null,
			body: '',
			awaitServer: false,
			clean: false,
		}
	},

	computed: {
		article () {
			return {
				title: this.title,
				slug: this.slug,
				description: this.description,
				body: this.body,
				image: this.image,
				status: this.status,
				tags: this.tags,
				categoryId: this.categoryId,
				userId: this.userId,
				clean: false,
			}
		}
	},

	methods: {
		save () {
			if (!validateIfCanSave(this.article, this)) {
				this.$dialog.alert({
					title: 'Espera un momento!',
					message: 'Debes redactar al menos el <strong>título</strong> para poder guardar el artículo y rellenar correctamente cualquier otro campo que tengas completado.',
					confirmText: 'De acuerdo!',
					type: 'is-warning',
				})

				return
			}

			this.awaitServer = true

			let data = convertDataToValidRequest(this.article), self = this

			this.$store.dispatch('articles/serverCreateItem', data)
				.then(item => {
					this.awaitServer = false

					this.$store.commit('articles/saveRelations', { article: item, store: this.$store })

					self.$toast.open({
						duration: 3000,
						message: 'Tú artículo se ha guardado exitosamente!',
						position: 'is-bottom-right',
						type: 'is-dark',
					})

					self.clearData()
					self.clean = true

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
			this.slug = null
			this.body = ''
			this.description = null
			this.categoryId = 1
			this.status = false
			this.image = null
			this.tags = []
		}
	},

	beforeRouteLeave (to, from, next) {
		if (!validateIfChanged(this.article)) {
			return next()
		}

		console.log(this.article)

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