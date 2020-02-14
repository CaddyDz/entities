<template>
	<div>
		<p v-for="(entity, index) in entities" :key="index">{{ entity.name }}</p>
	</div>
</template>

<script>
export default {
	computed: {
		entities() {
			return this.$store.state.entities;
		}
	}
};
</script>
