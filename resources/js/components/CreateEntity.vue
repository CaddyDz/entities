<template>
	<div>
		<button
			@click="toggleForm"
			type="button"
			class="btn"
			:class="{'btn-primary': !isFormShown, 'btn-danger': isFormShown}"
		>{{ toggleText }}</button>
		<hr />
		<div class="alert alert-danger" v-show="!hideErrors">
			<ul>
				<li v-for="(error, index) in errors" :key="index">{{ error[0] }}</li>
			</ul>
		</div>
		<form v-if="isFormShown" ref="form">
			<div class="form-group">
				<label for="name">* Name:</label>
				<input type="text" class="form-control" id="name" name="name" required />
			</div>
			<div class="form-group">
				<label for="parent">Parent Entity:</label>
				<select class="custom-select" id="parent" name="parent_id">
					<option selected value>Choose an optional parent</option>
					<option :value="entity.id" v-for="(entity, index) in entities" :key="index">{{ entity.name }}</option>
				</select>
			</div>
			<div class="form-group">
				<label for="barcode">Barcode:</label>
				<input
					type="number"
					class="form-control"
					id="barcode"
					aria-describedby="barcodeHelp"
					name="barcode"
					value
				/>
				<small id="barcodeHelp" class="form-text text-muted">You can manually type in barcode</small>
			</div>
			<div class="form-group">
				<label for="description">* Description:</label>
				<textarea class="form-control" id="description" rows="3" name="description" required></textarea>
			</div>
			<button type="button" class="btn btn-primary" @click="createEntity">Create</button>
			<hr />
		</form>
	</div>
</template>

<script>
export default {
	data() {
		return {
			isFormShown: false,
			errors: []
		};
	},
	computed: {
		toggleText() {
			return this.isFormShown ? "Hide Form" : "Create New Entity";
		},
		hideErrors() {
			return _.isEmpty(this.errors);
		},
		entities() {
			return this.$store.state.entities;
		}
	},
	methods: {
		toggleForm() {
			this.isFormShown = !this.isFormShown;
		},
		createEntity() {
			const formEntries = new FormData(this.$refs.form).entries();
			const data = Object.assign(
				...Array.from(formEntries, ([x, y]) => ({ [x]: y }))
			);
			axios
				.post("/api/entities", data)
				.then(response => {
					this.$store.commit("addEntity", response.data.entity);
					this.$refs.form.reset(); // Clear form
				})
				.catch(error => {
					this.errors = error.response.data.errors;
				});
		}
	}
};
</script>
