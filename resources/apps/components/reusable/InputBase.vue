<template lang="pug">
	
b-input.cms-input(
	v-model="myModel"
	:type="type"
	:read-only="readOnly"
	@focus="onFocus"
	@blur="onBlur"
	:inputId="inputId"
	:class="[isFocus ? 'is-focused' : '', isFocused ? 'is-focused' : '']"
	:placeholder="placeholder"
	:maxlength="maxLength"
	:has-counter="hasCounter"
)

</template>

<script>
	
export default{
	props: {
		type: {
			type: String,
			default: 'text',
		},
		model: String,
		placeholder: String,
		inputId: String,
		isFocused: Boolean,
		blur: Function,
		focus: Function,
		readOnly: {
			type: Boolean,
			default: false,
		},
		maxLength: Number,
		hasCounter: Boolean,
	},

	data () {
		return {
			myModel: this.model,
			isFocus: false,
		}
	},

	watch: {
		model (value) {
			this.myModel = value
		},

		myModel (value) {
			this.$emit('update:model', value)
		}
	},

	methods: {
		onFocus () {
			this.isFocus = true

			this.focus ? this.focus() : null
		},
		onBlur () {
			this.isFocus = false

			this.blur ? this.blur() : null
		}
	}
}

</script>