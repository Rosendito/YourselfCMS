// Import Service
import CommentService from '@/services/Comment'

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
	service: new CommentService(),
}

// Mutations 
const mutations = {
	saveAllItems, 
	saveItem,  
	deleteItem,
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


