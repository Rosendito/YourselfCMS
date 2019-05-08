// Import Filters

import shortUserName from '@/functions/shortUserNameFilter'

const filtersData = {
	shortUserName
}

function filters (Vue) {
	Object.keys(filtersData).forEach(filterName => {
		Vue.filter(filterName, filtersData[filterName])
	})
}

export default filters