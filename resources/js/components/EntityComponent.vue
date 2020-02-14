<template>
	<div>
		<create-entity></create-entity>
		<tree></tree>
	</div>
</template>

<script>
export default {
	mounted() {
		axios.get("/api/entities").then(response => {
			this.$store.commit("initEntities", response.data);
		});
	}
};
</script>
