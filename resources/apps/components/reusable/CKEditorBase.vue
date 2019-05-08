<template lang="pug">

textarea(
	:id="id"
	:value="value"
)

</template>

<script>
export default {
	props: {
		id: {
			type: [String, Number],
			required: true,
		},
		value: {
			type: String,
			required: true,
		},
		height: {
			type: String,
			default: '400px',
		},
		width: {
			type: String,
			default: 'auto',
		},
		language: {
			type: String,
			default: 'es',
		},
	},

	beforeUpdate () {
		if (this.value !== CKEDITOR.instances[this.id].getData()){
			CKEDITOR.instances[this.id].setData(this.value)
		}
	},

	mounted () {
		let editor = document.getElementById(this.id)

		const config = {
			toolbarGroups: [
				{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
				{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
				{ name: 'links', groups: [ 'links' ] },
				{ name: 'insert', groups: [ 'insert' ] },
				{ name: 'forms', groups: [ 'forms' ] },
				{ name: 'tools', groups: [ 'tools' ] },
				{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
				{ name: 'others', groups: [ 'others' ] },
				'/',
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
				{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
				{ name: 'styles', groups: [ 'styles' ] },
				{ name: 'colors', groups: [ 'colors' ] },
				{ name: 'about', groups: [ 'about' ] }
			],
			removeButtons: 'Underline,Subscript,Superscript,Paste,PasteText,PasteFromWord,Source,Table,About',
			width: this.width,
			height: this.height,
			language: this.language,
		}

		CKEDITOR.replace(editor, config)

		const self = this

		CKEDITOR.instances[this.id].setData(this.value)
		CKEDITOR.instances[this.id].on('change', () => {
			let data = CKEDITOR.instances[self.id].getData()
			if (data !== this.value) {
				this.$emit('update:value', data)
			}
		})
	},
}
</script>