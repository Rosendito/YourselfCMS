// Import Service
import CategoryService from '@/services/Category'

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
	getById,
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
	service: new CategoryService(),
}

// Mutations 
const mutations = {
	saveAllItems, 
	saveItem,  
	deleteItem,

	saveRelations (state, { category, store }) {
		let index = _.findIndex(state.items, ['id', category.id])

		state.items[index].articles = store.getters['articles/getByCategory'](category.id)
	},
}

// Getters
const getters = {
	getOrderBy,
	getFilter,
	getById,
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


