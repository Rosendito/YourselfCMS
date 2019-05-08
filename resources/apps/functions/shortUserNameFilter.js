function shortUserName (value) {
	if (!value) return ''

	let words = _.words(value.toString())

	return words[0] + ' ' + words[1].slice(0, 1) + '.'
}

export default shortUserName