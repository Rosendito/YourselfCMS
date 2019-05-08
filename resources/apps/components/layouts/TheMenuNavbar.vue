<template lang="pug">
	
.cms-menunavbar.is-shadow-4
	.level
		.level-left
			.level-item.cms-menunavbar-item.is-link
				span Homepage

		.level-right
			.level-item.cms-menunavbar-item
				span {{ userLogged.name | shortUserName }}

			.level-item
				b-dropdown(position="is-bottom-left")
					.cms-menunavbar-item.is-link(slot="trigger")
						AccountImageBase(:imageSrc="userLoggedImage")
						b-icon.menu-down(icon="menu-down")

					b-dropdown-item(
						@click="logout"
					)
						b-icon(icon="logout-variant")
						span Cerrar sesión


</template>

<script>
// Components
import AccountImageBase from '@/components/reusable/AccountImageBase';

export default {
	components: {
		AccountImageBase,
	},

	data () {
		let 
			userLoggedId = this.$store.state.logged.userId,
			userLogged   = this.$store.getters['users/getById'](userLoggedId)

		return {
			userLogged
		}
	},

	computed: {
		userLoggedName () {
			let words = _.words(_.startCase(this.userLogged.name))

			return words[0] + ' ' + words[1].slice(0, 1) + '.'
		},

		userLoggedImage () {
			if (this.userLogged.image == '' || this.userLogged.image == null)
				return false

			// Por terminar
			return 'http://localhost:8000/img/' + this.userLogged.image
		}
	},

	methods: {
		logout () {
			window.location.replace('http://localhost:8000/admin/logout')
		}
	}
}

</script>