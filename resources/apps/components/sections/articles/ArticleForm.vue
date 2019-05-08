<template lang="pug">

.columns.is-multiline
	.column.is-two-thirds-widescreen.is-12
		.box.is-shadow-2.cms-articles-form
			.cms-articles-form-header
				h2.subtitle Redacción

			b-field(
				label="Título"
				label-for="article_title"
				:message="errors.title.message"
				:type="errors.title.type"
			)
				InputBase(
					type="text"
					placeholder="Escribe el título de tu artículo"
					:model.sync="myTitle"
					input-id="article_title"
					:blur="checkTitle"
					:is-focused="errors.title.message ? true : false"
				)

			b-field(
				label="Url"
				label-for="article_slug"
			)
				p.cms-articles-form-slug {{ mySlug ? mySlug : 'Este será el url de tu artículo' }}

			b-field(
				label="Descripción o extracto"
				label-for="article_description"
				:message="errors.description.message"
				:type="errors.description.type"
			)
				InputBase(
					type="textarea"
					placeholder="Describe brevemente tu artículo (Extracto)"
					:model.sync="myDescription"
					input-id="article_description"
					:blur="checkDescription"
					:is-focused="errors.description.message ? true : false"
				)

			b-field(
				label="Cuerpo"
				label-for="article_body"
			)
				CKEditorBase(
					:value.sync="myBody"
					id="article_body"
				)
	.column
		.box.is-shadow-2.cms-articles-form
			.cms-articles-form-header
				h2.subtitle Complementarios

			b-field(
				label="Autor"
				label-for="article_autor"
			)
				.media
					.media-left
						AccountImageBase(
							:imageSrc="user.image ? 'http://localhost:8000/img/' + user.image : false"
						)

					.media-content
						b {{ user.name | shortUserName }}

			b-field(
				label="Categoría"
				label-for="article_category"
			)
				b-select(
					v-model="myCategoryId"
					placeholder="Categoría"
					icon="shape"
				)
					option(
						v-for="category in categoryOptions"
						:value="category.id"
						:key="category.id"
					)
						| {{ category.name }}

			b-field(
				label="Etiquetas"
				label-for="article_tags"
			)
				b-taginput(
					v-model="myTags"
					icon="label"
					placeholder="Añade una etiqueta"
					type="is-success"
					ellipsis
					autocomplete
					field="name"
					:data="filteredTags"
					@typing="getFilteredTags"
				)

			b-field(
				label="Estado"
				label-for="article_status"
			)
				b-tooltip(
					type="is-dark"
					label="Debes terminar el artículo para poder publicarlo"
					:active="!checkIfCanPublish"
					position="is-bottom"
				)
					b-switch(
						v-model="myStatus"
						type="is-success"
						id="article_status"
						:disabled="!checkIfCanPublish"
					)
						| {{ myStatus ? 'Publicar' : 'Dejar en edición' }}
</template>

<script>
// Store
import { mapState } from 'vuex'

// Components
import InputBase from '@/components/reusable/InputBase'
import CKEditorBase from '@/components/reusable/CKEditorBase'
import AccountImageBase from '@/components/reusable/AccountImageBase'

// Functions
import { validateIfCanPublish } from '@/functions/validateArticleFields'
import slugify from '@/functions/slugify'

export default {
	components: {
		InputBase,
		CKEditorBase,
		AccountImageBase,
	},

	computed: {
		...mapState(['isMenuToggle'])
	},

	props: {
		id: Number,
		title: String,
		slug: String,
		description: String,
		image: String,
		body: String,
		status: Boolean,
		userId: Number,
		tags: Array,
		categoryId: Number,
	},

	data () {
		return {
			myTitle: this.title,
			mySlug: this.slug,
			myDescription: this.description,
			myImage: this.image,
			myBody: this.body,
			myStatus: this.status,
			myTags: this.tags,
			myCategoryId: this.categoryId,
			user: this.$store.getters['users/getById'](this.userId),
			categoryOptions: this.$store.state.categories.items,
			filteredTags: this.setTagsOptions(),
			errorTitle: false,
			errors: {
				title: { message: null, type: null},
				description: { message: null, type: null},
			}
		}
	},

	watch: {
		title (value) {
			this.myTitle = value
		},
		description (value) {
			this.myDescription = value
		},
		image (value) {
			this.myImage = value
		},
		body (value) {
			this.myBody = value
		},
		status (value) {
			this.myStatus = value
		},
		userId (value) {
			this.myUserId = value
		},
		tags (value) {
			this.myTags = value
		},
		categoryId (value) {
			this.myCategoryId = value
		},
		myTitle (value) {
			this.$emit('update:title', value)

			this.mySlug = slugify(value)
		},
		myDescription (value) {
			this.$emit('update:description', value)
		},
		myImage (value) {
			this.$emit('update:image', value)
		},
		myBody (value) {
			this.$emit('update:body', value)
		},
		myStatus (value) {
			this.$emit('update:status', value)
		},
		myTags (value) {
			this.$emit('update:tags', value)

			this.filteredTags = this.setTagsOptions()
		},
		myCategoryId (value) {
			this.$emit('update:categoryId', value)
		},
		checkIfCanPublish (value) {
			if (!value) {
				this.myStatus = false
			}
		}
	},

	computed: {
		checkIfCanPublish () {
			return validateIfCanPublish(this.article, this)
		},

		article () {
			return {
				id: this.id,
				title: this.title,
				description: this.description,
				body: this.body,
				image: this.image,
				status: this.status,
				tags: this.tags,
				categoryId: this.categoryId,
				userId: this.userId,
			}
		}
	},

	methods: {
		setTagsOptions () {
			let 
				tags = this.$store.state.tags.items,
				self = this

			tags = _.map(tags, o => {
				return { id: o.id, name: o.name }
			})

			tags = _.filter(tags, o => !_.some(self.myTags, ['name', o.name]))

			return tags
		},
		getFilteredTags(text) {
			if (text == '') {
				return this.filteredTags = this.setTagsOptions()
			}

	        this.filteredTags = _.filter(this.setTagsOptions(), o => {
	        	return o.name
	        		.toString()
	        		.toLowerCase()
	        		.indexOf(text.toLowerCase()) >= 0
	        })
	    },
	    checkTitle () {
	    	if (this.myTitle && this.myTitle.length >= 12) {
	    		let 
	    			titles = _.map(this.$store.state.articles.items, o => {
	    				return {
	    					title: o.title,
	    					id: o.id,
	    				}
	    			}),
	    			result = false

	    		titles.forEach(o => {
	    			if (o.title == this.myTitle && o.id !== this.id) {
	    				result = true
	    			}
	    		})

	    		if (result) {
	    			this.errors.title.message = 'Ya hay un artículo con el mismo título y no se puede tener 2 con el mismo dentro del sistema.'
	    			this.errors.title.type = 'is-danger'

	    			return
	    		}
	    	}

	    	if (!this.myTitle || this.myTitle == '' || this.myTitle.length >= 12) {
	    		this.errors.title.message = null
	    		this.errors.title.type    = null

	    		return
	    	}

	    	this.errors.title.message = 'Intenta escribir un título más largo'
	    	this.errors.title.type    = 'is-danger'
	    },
		checkDescription () {
			if (!this.myDescription || this.myDescription == '' || this.myDescription.length >= 40) {
				this.errors.description.message = null
	    		this.errors.description.type    = null

	    		return
			}

			this.errors.description.message = 'Intenta escribir una descripción más larga'
	    	this.errors.description.type    = 'is-danger'
	    },
	},
}

</script>