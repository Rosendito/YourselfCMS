// Shortcut QuerySelector
export function $ (selector, all = false) {
	if (all) return document.querySelectorAll(selector)

	return document.querySelector(selector)
}

// Clone Objects 
export function deepClone (object) {

	if (typeof object == 'array') {
		return JSON.parse(JSON.stringify(object))
	}

	const clone = {}

	for (let key in object) {
		let value = object[key]

		if (typeof value != 'object') {
			clone[key] = value
		} else {
			clone[key] = deepClone(value)
		}
	}

	return clone;
}


const basePath = window.location.origin

export const URL = {
	images: basePath + '/img/',
	api: basePath + '/api',
	logout: basePath + '/cms/logout'
}