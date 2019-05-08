// Get Items Order by Property
export function getOrderBy ({ items }){
	return ({attr, order}) => _.orderBy(items, [attr[0], attr[1]], [order[0], order[1]])
}

// Get items Filter by

export function getFilter ({ items }) {
	return ({ attr, value }) => _.filter(items, [attr, value])
}

// Get Items by Identifier
export function getById ({ items }) {
	return (id) => _.find(items, ['id', id])
}