// Import Service
import ArticleService from '@/services/Article'

// Import Mutations Mixins
import { 
	saveAllItems, 
	saveItem,
	deleteItem,
} from '@/store/mixins/mutations'

// Import Getters Mixins
import { 
	getOrderBy, 
	getById,
	getFilter,
} from '@/store/mixins/getters'

// Import Actions Mixins
import { 
	serverCreateItem,
	serverUpdateItem,
	serverDeleteItem,
} from './../mixins/actions'

// State
const state = {
	items: [],
	service: new ArticleService(),
}

// Mutations 
const mutations = {
	saveAllItems, 
	saveItem,  
	deleteItem,

	saveRelations (state, { article, store }) {
		let
			index      = _.findIndex(state.items, ['id', article.id]),
			userId     = article.user_id,
			categoryId = article.category_id,
			tagsId     = store.getters['articlesTags/getTagsId'](article.id)

		state.items[index].user     = store.getters['users/getById'](userId)
		state.items[index].category = store.getters['categories/getById'](categoryId)
		state.items[index].tags     = store.getters['tags/getByArticle'](tagsId)
	}
}

// Getters
const getters = {
	getOrderBy,
	getFilter,
	getById,

	getByTag: ({ items  }) => (tagsId) => {
		let articles = []

		items.forEach((article, index) => _.indexOf(tagsId, article.id) !== -1 ? articles.push(article) : null)

		return articles
	},

	getByUser: ({ items }) => (userId) => {
		let articles = []

		items.forEach(article => article.user_id == userId ? articles.push(article) : null)

		return articles
	},

	getByCategory: ({ items }) => (categoryId) => {
		let articles = []

		items.forEach(article => article.category_id == categoryId ? articles.push(article) : null)

		return articles
	}
}

// Actions
const actions = {
	serverCreateItem,
	serverUpdateItem,
	serverDeleteItem,
}

// Namespace
const namespaced = true

export default {
	state, mutations, actions, namespaced, getters
}


