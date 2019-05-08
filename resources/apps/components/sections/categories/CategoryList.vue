<template lang="pug">

.columns.is-multiline
	.column.is-12.cms-section-subtitle
		.subtitle Tús categorías
	
	.column.columns.is-multiline.cms-categories-list
		.column.is-half-widescreen(
			:class="!isMenuToggle ? 'is-12' : 'is-half'"
			v-for="(category, index) in categories"
			:key="category.id"
		)
			.box.cms-categories-card.is-shadow-2
				.cms-categories-card-header(:class="styles[index > 3 ? index % 4 : index]")
					span {{ category.name }}
					b-dropdown(position="is-bottom-left")
						a.cms-categories-card-actions(slot="trigger")
							b-icon(icon="dots-vertical")
						b-dropdown-item(@click="edit(category.id)")
							b-icon(icon="pencil")
							span Editar
						b-dropdown-item(@click="remove(category.id)")
							b-icon(icon="trash-can")
							span Eliminar

				.cms-categories-card-body
					span {{ category.description }}
				.cms-categories-card-id
					b {{ category.id }}


</template>

<script>
// Components
import CategoryForm from './CategoryForm'

// Store
import { mapState } from 'vuex'

export default {
	components: {
		CategoryForm,
	},

	props: {
		categories: Array,
	},

	data () {
		return {
			styles: [
				'is-primary',
				'is-warning',
				'is-success',
				'is-info'
			],
		}
	},

	methods: {
		edit (id) {
			this.$emit('edit', id)
		},
		remove (id) {
			this.$emit('remove', id)
		}
	},

	computed: {
		...mapState(['isMenuToggle']),
	}
}

</script>