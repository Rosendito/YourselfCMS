// Create Item Resources
export function serverCreateItem ({ commit, state }, data) {
	let service = state.service

	return new Promise((resolve, rejection) => {
		service.createItem(data)
			.then(res => {
				let item = res.data.data

				commit('saveItem', item)

				resolve(item)
			})
			.catch(err => {
				console.log(err)

				rejection(err)
			})
	})
}

// Update Item Resources
export function serverUpdateItem ({ commit, state }, { id , modified }) {
	let service = state.service

	return new Promise((resolve, rejection) => {
		service.updateItem(id, modified)
			.then(res => {
				let item = res.data.data

				commit('saveItem', item)

				resolve(item)
			})
			.catch(err => {
				console.log(err)

				rejection(err)
			})
	})
}

// Delete Item Resource
export function serverDeleteItem ({ commit, state }, id) {
	let service = state.service

	return new Promise((resolve, rejection) => {
		service.deleteItem(id)
			.then(res => {
				let item = res.data.data

				commit('deleteItem', item)

				resolve(item)
			})
			.catch(err => {
				console.log(err)

				rejection(err)
			})
	})
}