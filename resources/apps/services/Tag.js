import Api from './Api'

class TagService extends Api{
	constructor () {
		super()

		this.path = this.baseUrl + '/tags/'
	}
}

export default TagService