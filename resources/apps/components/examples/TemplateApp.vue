<template lang="pug">

main
	section#ex-text
		.container
			.title Textos
			.columns.is-multiline
				.column.is-12
					.subtitle Título
					h1.title.is-size-3 {{ lorem }}
					small.ex-classs-detail Clases: .title, .is-size-3
				.column.is-12
					.subtitle Subtítulos
					h2.subtitle.is-size-5 {{ lorem }}
					small.ex-classs-detail Clases: .subtitle, .is-size-5
				.column.is-12
					.subtitle Membretes
					h3.title.is-size-6 {{ lorem }}
					small.ex-classs-detail Clases: .title, .is-size-6
				.column.is-12
					.subtitle Cuerpos
					p {{ loremBig }}

	section#ex-buttons
		.container
			.title Botones
			.columns.is-multiline
				.column.is-12
					.subtitle Botones Primarios
					.buttons
						.button.is-primary Mi botón
						.button.is-info Mi botón
					small Clases: Botón 1 .button, .is-primary | Botón 2 .button, .is-info
				.column.is-12
					.subtitle Botones secundarios
					.buttons
						.button.is-secondary Mi botón
					small Clases: .button, .is-secondary

</template>

<style lang="scss">

body, html{
	position: relative;
	width: 100%;
	min-height: 100vh;
	background: #eee;
}

</style>

<script>
// Propertys
export default {
	data () {
		return {
			lorem: 'Las flores de la pradera son más lindas en primavera',
			loremBig: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex.',
		}
	}
}
</script>