<template lang="pug">

.level.cms-articles-list-filters
	.level-left
		b-field.level-item.cms-input-search
			p.control
				a.cms-input-search-icon(
					@click="clearArticleSearch"
				)
					b-icon(
						v-if="myArticleSearch == null"
						icon="magnify"
					)
					b-icon(
						v-else
						icon="close"
					)
			InputBase(
				:model.sync="myArticleSearch"
				placeholder="Busca un artículo por su título"
			)

	.level-right

		.level-item
			b-select(
				v-model="myUserSelected"
				placeholder="Usuarios"
				icon="account"
			)
				option(
					v-for="user in userOptions"
					:key="user.id"
					:value="user.id"
				)
					| {{ user.name | shortUserName }} 

				option(:value="null") Ninguno

		.level-item
			b-select(
				v-model="myStatusSelected"
				placeholder="Estado"
				icon="earth"
			)
				option(
					v-for="status in statusOptions"
					:key="status.value"
					:value="status.value"
				)
					| {{ status.name }}

				option(:value="null") Ninguno

</template>

<script>
// Components
import InputBase from '@/components/reusable/InputBase'
import AccountImageBase from '@/components/reusable/AccountImageBase'

export default {
	props: {
		userOptions: Array,
		statusOptions: Array,
		userSelected: [Number, String],
		statusSelected: [Number, String],
		articleSearch: [String],
	},

	components: {
		InputBase,
		AccountImageBase,
	},

	data () {
		return {
			myUserSelected: this.userSelected,
			myStatusSelected: this.statusSelected,
			myArticleSearch: this.articleSearch,
		}
	},

	watch: {
		userSelected (value) {
			this.myUserSelected = value
		},

		statusSelected (value) {
			this.myStatusSelected = value
		},

		articleSearch (value) {
			this.myArticleSearch = value
		},

		myUserSelected (value) {
			this.$emit('update:userSelected', value)
		},

		myStatusSelected (value) {
			this.$emit('update:statusSelected', value)
		},

		myArticleSearch (value) {
			if (value == '')
				this.$emit('update:articleSearch', null)
			else
				this.$emit('update:articleSearch', value)
		}
	},

	computed: {
		myUserSelectedImage () {
			return this.userSelected.image ? 'http://localhost:8000/img/' + this.userSelected.image : false
		}
	},

	methods: {
		clearArticleSearch () {
			if (!this.articleSearch) return

			this.myArticleSearch = null
		}
	},
}

</script>