<template>
	<li>
		<div :class="{bold: isParent}" @click="toggle(entity.id)">
			<div class="header" >
				<span>
					{{ entity.name }} - {{ entity.barcode }}
					<span v-if="isParent">[{{ isOpen ? '-' : '+' }}]</span>
				</span>
				<button class="btn btn-danger" @click="deleteEntity(entity.id)" >Delete</button>
			</div>
			<div class="content" >	
				<p>{{ entity.description }}</p>
			</div>
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
			return this.entity.children_count != 0;
		}
	},
	watch: {
		isOpen(value) {
			if (value) {
				this.$store.commit("addOpenBranch", this.entity.id);
			} else {
				this.$store.commit("removeOpenBranch", this.entity.id);
			}
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
		},
		deleteEntity(id){
			axios.delete(`/api/entities/${id}`)
			.then(res => {
				this.$store.commit("deleteEntity", id);
			})
			.catch(err => {
				this.errors = err.response.data.errors;
			});
		}
	},
	mounted() {
		this.$root.$on("addedChild", id => {
			this.getChildren(id);
		});
	}
};
</script>

<style scoped>
.header{
	display: flex;
	justify-content: space-between;
}
li {
	display: block;
}
p {
	line-height: 30px;
	border: 3px solid violet;
	padding: 3px;
}
</style>
