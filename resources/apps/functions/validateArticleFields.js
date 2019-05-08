export function validateIfCanPublish (article, self = null) {
	if (
		article.title &&
		article.title.length >= 12 &&
		self
	){
		let 
			titles = _.map(self.$store.state.articles.items, o => {
				return {
					title: o.title,
					id: o.id
				}
			}),
			result = false

		titles.forEach(o => {
			if (article.title == o.title && article.id !== o.id) {
				result = true
			}
		})


		if (result) return false
	}

	if (
		article.title &&
		article.title.length >= 12 &&
		article.description &&
		article.description.length >= 40 &&
		article.body !== '' 
	){
		return true
	}

	return false
}

export function validateIfCanSave (article, self) {
	if (article.title && article.title.length >= 12) {
		let 
			titles = _.map(self.$store.state.articles.items, o => {
				return {
					title: o.title,
					id: o.id
				}
			}),
			result = false

		titles.forEach(o => {
			if (article.title == o.title && article.id !== o.id) {
				result = true
			}
		})

		if (result) return false
	}
	
	if (!article.title) return false
	if (article.title && article.title.length < 12) return false
	if (article.description && article.description.length < 40) return false

	return true
}

export function validateIfChanged (article, articleOld = null) {
	if (article.clean) return false

	if (!articleOld) {
		if (
			article.title ||
			article.description ||
			article.body !== '' ||
			article.image ||
			article.tags.length > 0
		) {
			return true
		}

		return false
	}

	article.tags = _.map(article.tags, o => {
		return { id: o.id, name: o.name }
	})

	if (
		article.title !== articleOld.title ||
		article.description !== articleOld.description ||
		article.body !== articleOld.body ||
		article.image !== article.image ||
		JSON.stringify(article.tags) !== JSON.stringify(articleOld.tags) ||
		article.categoryId !== articleOld.categoryId ||
		article.status !== articleOld.status
	) {
		return true
	}

	return false
}

export function convertDataToValidRequest (article) {
	let data = {}

	data.title = article.title.toString()
	data.status = article.status ? '1' : '0'

	article.description ? data.description = article.description.toString() : null
	article.body ? data.body = article.body.toString() : null
	article.image ? data.image = article.image.toString() : null
	article.categoryId ? data.category_id = parseInt(article.categoryId) : null

	if (article.tags.length > 0) {
		let tagsId = _.map(article.tags, o => o.id)

		data.tags_array = JSON.stringify(tagsId)
	}

	return data
}