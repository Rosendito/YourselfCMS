import Axios from 'axios';
import { URL } from '@/functions/tools'

console.log(URL)

let tokenCSRF = document.getElementById('csrf-token').getAttribute('content')

class Api{
	constructor () {
		this.http = Axios.create({
			headers: {
				common: {
					'X-Requested-With': 'XMLHttpRequest',
					'X-CSRF-TOKEN': tokenCSRF,
				},
			}
		})

		this.baseUrl = URL.api
		this.path    = this.baseUrl + '/'
	}

	getAll () {
		return this.http.get(this.path)
	}

	updateItem (id, data) {
		let path = this.path + id

		data['_method'] = 'PUT'

		return this.http.post(path, data)
	}

	createItem (data) {
		return this.http.post(this.path, data) 
	}

	deleteItem (id) {
		let path = this.path + id

		return this.http.delete(path)
	}
}

export default Api;