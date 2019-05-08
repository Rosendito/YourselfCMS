// Global State
export const state = {
	logged: {
		userId: 0,
	},
	isMenuToggle: false,
}

// Global Mutations
export const mutations = {
	changeMenuToggle (state) {
		state.isMenuToggle = !state.isMenuToggle
	},

	saveUserLogged (state, userId) {
		state.logged.userId = userId
	},
}