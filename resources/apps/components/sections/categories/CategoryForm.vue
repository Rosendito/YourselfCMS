<template lang="pug">

.modal-card.animation-content
	.modal-card-head
		h3.modal-card-title {{ title }}

	.modal-card-body
		b-field(
			label="Nombre"
			label-for="category_name"
		)
			InputBase(
				type="text"
				placeholder="Escribe el nombre de la categoría"
				:model.sync="myName"
				input-id="category_name"
			)
		b-field(
			label="Descripción"
			label-for="category_description"
		)
			InputBase(
				type="textarea"
				placeholder="Describe brevemente la categoría"
				:model.sync="myDescription"
				input-id="category_description"
				:max-length="180"
				:has-counter="true"
			)

	.modal-card-foot
		.buttons
			.button.is-info(@click="save")
				b-icon(icon="save")
				span Guardar
			.button.is-simple(@click="cancel")
				b-icon(icon="cancel")
				span Cancelar

	b-loading(
		:active="loading"
		:is-full-page="false"
	)


</template>

<script>
// Components
import InputBase from '@/components/reusable/InputBase'

export default {
	components: {
		InputBase,
	},

	props: {
		title: String,
		name: String,
		description: String,
		loading: Boolean,
	},

	data () {
		return {
			myName: this.name,
			myDescription: this.description,
		}
	},

	watch: {
		myName (value) {
			this.$emit('update:name', value)
		},
		myDescription (value) {
			this.$emit('update:description', value)
		}
	},

	methods: {
		save () {
			this.$emit('save')
		},
		cancel () {
			this.$emit('cancel')
		}
	}
}

</script>