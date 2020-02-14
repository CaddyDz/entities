<template>
	<div>
		<p v-for="(entity, index) in entities" :key="index">
			<branch class="entity" :entity="entity"></branch>
		</p>
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
