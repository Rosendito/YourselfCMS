import Api from './Api'

class ArticleService extends Api{
	constructor () {
		super()

		this.path = this.baseUrl + '/articles/'
	}
}

export default ArticleService

