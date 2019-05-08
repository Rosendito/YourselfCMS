import Api from './Api'

class CommentService extends Api{
	constructor () {
		super()

		this.path = this.baseUrl + '/comments/'
	}
}

export default CommentService