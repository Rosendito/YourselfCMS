function InitializeStore (self) {
	self.loading = true

	const {
		users,
		categories,
		tags,
		articles,
		articlesTags,
		comments,
		logged,
	} = SERVER_DATA

	// Save Data in Store
	self.$store.commit('saveUserLogged', logged.id)
	self.$store.commit('users/saveAllItems', users)
	self.$store.commit('categories/saveAllItems', categories)
	self.$store.commit('tags/saveAllItems', tags)
	self.$store.commit('articles/saveAllItems', articles)
	self.$store.commit('articlesTags/saveAllItems', articlesTags)
	self.$store.commit('comments/saveAllItems', comments)

	// Relationing Data

	// Relation Users
	self.$store.state.users.items.forEach(user => {
		self.$store.commit('users/saveRelations', { user, store: self.$store })
	})

	// Relation Categories
	self.$store.state.categories.items.forEach(category => {
		self.$store.commit('categories/saveRelations', { category, store: self.$store })
	})

	// Relation Tags
	self.$store.state.tags.items.forEach(tag => {
		self.$store.commit('tags/saveRelations', { tag, store: self.$store })
	})

	// Relation Articles
	self.$store.state.articles.items.forEach(article => {
		self.$store.commit('articles/saveRelations', { article, store: self.$store })
	})

	self.loading = false
}

export default InitializeStore