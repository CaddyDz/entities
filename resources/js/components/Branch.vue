<template>
	<li>
		<div :class="{bold: isParent}" @click="toggle(entity.id)">
			{{ entity.name }} - {{ entity.barcode }}
			<span v-if="isParent">[{{ isOpen ? '-' : '+' }}]</span>
			<br />
			<p>{{ entity.description }}</p>
		</div>
		<ul v-show="isOpen" v-if="isParent">
			<branch class="entity" v-for="(child, index) in children" :key="index" :entity="child"></branch>
		</ul>
	</li>
</template>

<script>
export default {
	props: {
		entity: Object
	},
	data() {
		return {
			isOpen: false,
			children: {}
		};
	},
	computed: {
		isParent() {
			return this.entity.children_count;
		}
	},
	methods: {
		toggle(id) {
			if (this.isParent) {
				// Avoid useless second call to api
				if (_.isEmpty(this.children)) {
					this.getChildren(id);
				}
				this.isOpen = !this.isOpen;
			}
		},
		getChildren(id) {
			axios
				.get(`/api/entities/${id}/children`)
				.then(response => {
					this.children = response.data;
				})
				.catch(error => {
					this.errors = error.response.data.errors;
				});
		}
	}
};
</script>

<style scoped>
li {
	display: block;
}
p {
	line-height: 30px;
	border: 3px solid violet;
	padding: 3px;
}
</style>
