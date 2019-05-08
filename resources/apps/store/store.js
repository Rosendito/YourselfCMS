// Import Modules
import users        from './modules/users'
import categories   from './modules/categories'
import tags         from './modules/tags'
import articles     from './modules/articles'
import articlesTags from './modules/articlesTags'
import comments     from './modules/comments'


// Global Store
import { state, mutations } from './global'

export default {
	state,
	mutations,

	// Modules
	modules: {
		users,
		categories,
		tags,
		articles,
		articlesTags,
		comments,
	}
}