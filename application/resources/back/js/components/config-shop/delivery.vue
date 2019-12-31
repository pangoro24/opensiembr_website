<template>
    <div>
		<v-skeleton-loader type="card" :loading="this.$root.skeletonLoading" transition="scale-transition">
			<v-card>
				<v-card-text>
					<div>
						<b>MÉTODOS DE ENVIOS</b>
						<v-dialog v-model="dialog" persistent max-width="600px">
							<template v-slot:activator="{ on }">
								<v-btn text icon color="green" v-on="on">
									<v-icon>mdi-plus-circle-outline</v-icon>
								</v-btn>
							</template>
							<v-card :loading="this.$root.loading">
								<v-card-title>
									<span class="headline">Agregar método de envio</span>
								</v-card-title>
								<v-card-text>
									<v-container>
										<v-row>
											<v-col cols="12">
												<v-text-field v-model="name" label="Nombre del método de envio" required></v-text-field>
											</v-col>
											<v-col cols="12">
												<v-text-field v-model="price" label="Precio" required></v-text-field>
											</v-col>
										</v-row>
									</v-container>
								</v-card-text>
								<v-card-actions>
									<v-spacer></v-spacer>
									<v-btn color="blue darken-1" text @click="dialog = false">Cerrar</v-btn>
									<v-btn color="blue darken-1" text @click="saveShipping">Agregar</v-btn>
								</v-card-actions>
							</v-card>
						</v-dialog>
					</div>

					<v-simple-table>
						<template v-slot:default>
							<thead>
							<tr>
								<th class="text-left">Nombre</th>
								<th class="text-left">Precio</th>
								<th class="text-left">Opciones</th>
							</tr>
							</thead>
							<tbody>
							<tr v-for="item in sender" :key="item.name">
								<td>{{ item.name }}</td>
								<td>{{ item.price }}</td>
								<td>
									<v-btn text icon color="red" @click="deleteShipping(item.id)">
										<v-icon>mdi-delete</v-icon>
									</v-btn>
								</td>
							</tr>
							</tbody>
						</template>
					</v-simple-table>
				</v-card-text>
			</v-card>
		</v-skeleton-loader>
	</div>
</template>

<script>
	import axios from 'axios';

    export default {
		data() {
			return {
				dialog: false,
				name:'',
				price:'',
				sender: [],
			}
		},
		mounted() {
            this.getShipping();
        },
		methods: {
			getShipping() {
				axios.get(this.$root.base_url + 'shop/get_method_shipping')
				.then(res => {
					const datos = res.data.data;
					this.sender = datos;
				})
				.catch(err => {
					console.error(err);
				})
			},
			saveShipping() {
				this.$root.loading = true;
				const $this = this;
				this.dialog = false;

				const data_form = new FormData();
					  data_form.append ('name', this.name);
					  data_form.append ('price', this.price);

				axios.post(this.$root.base_url + 'shop/post_method_shipping', data_form)
					.then( response => {
						$this.$root.loading = false;
						console.log(response);
						location.reload();
					})
					.catch( error => {
						$this.$root.loading = false;
						$this.message = error.response.data.message;
						$this.showError = true;
						$this.typeError = 'error';
						console.log(error.response);
					})
			},
			deleteShipping: function (item) {
				const $this = this;

				axios.post(this.$root.base_url + 'shop/put_status_shipping/' + item)
					.then( response => {
						$this.$root.loading = false;
						console.log(response);
						location.reload();
					})
					.catch( error => {
						$this.$root.loading = false;
						$this.message = error.response.data.message;
						$this.showError = true;
						$this.typeError = 'error';
						console.log(error.response);
					})
			}
		}
    }
</script>

<style scoped>

</style>
