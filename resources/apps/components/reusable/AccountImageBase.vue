<template lang="pug">

//- Image if sources exist
figure.image.is-32x32(v-if="imageSrc")
	img.is-rounded(:src="imageSrc")

//- Icon if sources not exists
figure.cms-accountimage(v-else)
	b-icon(icon="account")

</template>

<script>

export default {
	props: ['imageSrc']
}

</script>
