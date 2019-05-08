<template lang="pug">

SectionBase(title="Ver artículos")
	template(slot="actions")
		.buttons
			.button.is-info.is-shadow-2.is-rounded(
				@click="$router.push({ name: 'article/edit', params: { id: $route.params.id, previous: 'articles' } })"
			)
				b-icon(icon="pencil")
				span Editar
			.button.is-simple.is-shadow-2.is-rounded(
				@click="confirmDeleteArticle"
			)
				b-icon(icon="trash-can")
				span Eliminar

	.cms-section-wrapper.cms-articles-create(v-if="!error")
		.columns.is-multiline
			.column.is-two-thirds-widescreen.is-12
				.box.is-shadow-2.cms-articles-form
					b-field(label="Título")
						b.cms-articles-form-field.is-size-4 {{ title }}

					b-field(label="Url")
						span.cms-articles-form-field {{ slug }}

					b-field(label="Descripción o extracto")
						span.cms-articles-form-field {{ description }}

					b-field(label="Cuerpo")
						.content.cms-articles-form-field(v-html="body")
				
			.column
				.box.is-shadow-2.cms-articles-form
					b-field(label="Autor")
						.media
							.media-left
								AccountImageBase(
									:image-src="user.image ? 'http://localhost:8000/img/' + user.image : false"
								)
							.media-content
								b {{ user.name | shortUserName }}

					b-field(label="Categoría")
						b-tag(type="is-link") {{ category.name }}

					b-field(label="Etiquetas")
						b-taglist
							b-tag(
								v-for="tag in tags"
								type="is-info"
								:key="tag.id"
							)
								| {{ tag.name }}

					b-field(label="Estado")
						b-tag(
							v-if="status"
							type="is-success"
						)
							| Publicado
						b-tag(
							v-else
							type="is-warning"
						)
							| En edición

	b.is-size-3.has-text-centered(
		v-else
		style="display: block"
	)
		| {{ error }}

	b-loading(
		:active="awaitServer"
		:is-full-page="false"
	)

</template>

<script>
// Components
import AccountImageBase from '@/components/reusable/AccountImageBase'

export default {
	components: {
		AccountImageBase,
	},

	data () {
		const article = this.$store.getters['articles/getById'](parseInt(this.$route.params.id))

		if (!article) return { error: 'Artículo no encontrado' }

		return {
			id: article.id,
			title: article.title,
			slug: article.slug,
			description: article.description ? article.description : null,
			body: article.body ? article.body : null,
			tags: article.tags ? article.tags : [],
			image: article.image ? article.image : null,
			category: article.category,
			status: article.status == '0' ? false : true,
			user: article.user,
			error: null,
			awaitServer: false,
		}
	},

	methods: {
		confirmDeleteArticle () {
			let self = this

			this.$dialog.confirm({
				title: 'Estás seguro?',
				message: 'Estás a punto de borrar un artículo para siempre, confirma si quieres continuar.',
				confirmText: 'Confirmar',
				onConfirm () {
					self.deleteArticle()
				}
			})
		},
		deleteArticle () {
			this.awaitServer = true

			this.$store.dispatch('articles/serverDeleteItem', this.id)
				.then(item => {
					this.awaitServer = false

					this.$router.push({ name: 'article' })

					this.$toast.open({
						message: 'Su artículo ha sido borrado exitosamente!',
						type: 'is-dark',
						duration: 3000,
					})
				})
		}
	},
}

</script>