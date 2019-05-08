// Save All Items 
export function saveAllItems (state, newItems) {
	state.items = newItems
}

// Save Item
export function saveItem (state, newItem) {
	let index = _.findIndex(state.items, ['id', newItem.id])

	if (index > -1)
		state.items[index] = newItem
	else 
		state.items.push(newItem)
}

// Delete Item
export function deleteItem (state, deletedItem) {
	let index = _.findIndex(state.items, ['id', deletedItem.id])

	if (index > -1)
		state.items.splice(index, 1)
	else
		console.log('Este item ya ha sido eliminado o nunca ha existido en el sistema')
}