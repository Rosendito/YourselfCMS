<template lang="pug">

.cms-section.columns.is-multiline

	.column.is-12.cms-section-heading
		.level
			.level-left
				h1.title {{ title }}

			.level-right
				slot(name="actions")
		
	.column.is-12.is-padddingless
		slot



</template>

<script>

export default {
	props: {
		title: {
			required: true,
			type: String,
		}
	}

}

</script>
