// Import Service
import TagService from '@/services/Tag'

// Import Mutations Mixins
import { 
	saveAllItems,
	saveItem,
	deleteItem,
} from '@/store/mixins/mutations'

// Import Getters Mixins
import { 
	getOrderBy,
	getFilter,
	getById
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
	service: new TagService(),
}

// Mutations 
const mutations = {
	saveAllItems,
	saveItem,  
	deleteItem,

	saveRelations (state, { tag, store }) {
		let 
			index      = _.findIndex(state.items, ['id', tag.id]),
			articlesId = store.getters['articlesTags/getArticlesId'](tag.id)

		state.items[index].articles = store.getters['articles/getByTag'](articlesId)		
	},
}

// Getters
const getters = {
	getOrderBy,
	getFilter,
	getById,

	getByArticle: ({ items  }) => (articleId) => {
		let tags = []

		items.forEach((tag, index) => _.indexOf(articleId, tag.id) !== -1 ? tags.push(tag) : null)

		return tags
	},
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


