import Api from './Api'

class UserService extends Api{
	constructor () {
		super()

		this.path = this.baseUrl + '/users/'
	}
}

export default UserService