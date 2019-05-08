// Import Mutations Mixins
import { saveAllItems } from '@/store/mixins/mutations'

// State
const state = {
	items: [],
}

// Mutations
const mutations = {
	saveAllItems
}

// Getters
const getters = {
	getTagsId: ({ items }) => (articleId) => {
		let tags = []

		items.forEach(relation => relation.article_id == articleId ? tags.push(relation.tag_id) : null)
		return tags
	},

	getArticlesId: ({ items }) => (tagId) => {
		let articles = []

		items.forEach(relation => relation.tag_id == tagId ? articles.push(relation.post_id) : null)
		
		return articles
	}
}

// Namespace
const namespaced = true

export default {
	state, mutations, namespaced, getters
}