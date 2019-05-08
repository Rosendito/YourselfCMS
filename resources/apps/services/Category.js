import Api from './Api'

class CategoryService extends Api{
	constructor () {
		super()

		this.path = this.baseUrl + '/categories/'
	}
}

export default CategoryService