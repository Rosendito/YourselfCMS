<template lang="pug">
	
SectionBase(title="Categorías")
	template(slot="actions")
		.button.is-info.is-rounded.is-shadow-2(
			@click="create"
		)
			b-icon(icon="plus")
			span Crear categoría

	.cms-section-wrapper.cms-categories
		CategoryList(
			:categories="categories"
			@edit="edit"
			@remove="remove"
		)

		b-modal(
			:active.sync="modalActive"
		)
			CategoryForm(
				:title="title"
				:name.sync="name"
				:description.sync="description"
				:loading="awaitServer"
				@save="save"
				@cancel="cancel"
			)

</template>

<script>
// Components
import CategoryList from './CategoryList'
import CategoryForm from './CategoryForm'

export default {
	components: {
		CategoryList,
		CategoryForm,
	},

	data () {
		return {
			categories: deepClone(this.$store.state.categories),
			modalActive: false,
			name: null,
			description: null,
			title: null,
			id: null,
			awaitServer: false,
		}
	},

	methods: {
		create () {
			this.title       = 'Crea una categoría'
			this.name        = null
			this.description = null
			this.modalActive = true
			this.id          = null
		},
		edit (id) {
			const category = this.$store.getters['categories/getById'](id)

			this.title       = 'Edita esta categoría'
			this.id          = id
			this.name        = category.name
			this.description = category.description
			this.modalActive = true
		},
		remove (id) {
			console.log('Eliminando ' + id)
		},
		save () {
			this.awaitServer = true

			const data = {
				name: this.name,
				description: this.description,
			}

			if (!this.id) {
				this.$store.dispatch('categories/serverCreateItem', data)
					.then(item => {
						const payload = {
							category: item,
							store: this.$store
						}

						this.$store.commit('categories/saveRelations', payload)

						this.awaitServer = false
						this.modalActive = false

						this.$toast.open({
							duration: 3000,
							message: 'La categoría se ha guardado exitosamente!',
							position: 'is-bottom-right',
							type: 'is-dark',
						})
					})
					.catch(err => {
						console.log(err)
					})

					return
			}

			const index = _.findIndex(this.categories, ['id', this.id])

			this.categories.splice(index, 1)

			this.$store.dispatch('categories/serverUpdateItem', { id: this.id, modified: data })
				.then(item => {
					const payload = {
						category: item,
						store: this.$store
					}

					this.$store.commit('categories/saveRelations', payload)

					console.log(this.categories)

					
					this.categories = this.$store.state.categories.items

					console.log(this.$store.state.categories.items)

					this.awaitServer = false
					this.modalActive = false


					this.$toast.open({
						duration: 3000,
						message: 'La categoría se ha guardado exitosamente!',
						position: 'is-bottom-right',
						type: 'is-dark',
					})
				})
				.catch(err => {
					console.log(err)
				})
		},
		cancel () {
			this.modalActive = false
		},
	},
}
</script>
