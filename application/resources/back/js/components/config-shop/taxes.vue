<template>
    <div>
		<v-skeleton-loader type="card" :loading="this.$root.skeletonLoading" transition="scale-transition">
			<v-card>
				<v-card-text>
					<div>
						<b>IMPUESTOS</b>
						<v-dialog v-model="dialog" persistent max-width="600px">
							<template v-slot:activator="{ on }">
								<v-btn v-if="taxes.length === 0" text icon color="green" v-on="on">
									<v-icon>mdi-plus-circle-outline</v-icon>
								</v-btn>
							</template>
							<v-card :loading="this.$root.loading">
								<v-card-title>
									<span class="headline">Agregar Impuesto</span>
								</v-card-title>
								<v-form v-on:submit.prevent="saveTax">
									<v-card-text>
										<v-container>
											<v-row>
												<v-col cols="12">
													<v-text-field v-model="name_tax" label="Nombre del Impuesto" required></v-text-field>
												</v-col>
												<v-col cols="12">
													<v-text-field v-model="qty_tax" label="Cantidad" hint="ejemplo: 0.07" required></v-text-field>
												</v-col>
											</v-row>
											<v-row>
												<v-col cols="12">
													<v-alert
														v-if="message !== ''"
														border="top"
														color="red lighten-2"
														dark
													>
														{{ message }}
													</v-alert>
												</v-col>
											</v-row>
										</v-container>
									</v-card-text>
									<v-card-actions>
										<v-spacer></v-spacer>
										<v-btn color="blue darken-1" text @click="dialog = false">Cerrar</v-btn>
										<v-btn type="submit" color="blue darken-1" text>Agregar</v-btn>
									</v-card-actions>
								</v-form>
							</v-card>
						</v-dialog>
					</div>

					<v-simple-table>
						<template v-slot:default>
							<thead>
							<tr>
								<th class="text-left">Nombre</th>
								<th class="text-left">Cantidad</th>
								<th class="text-left">Opciones</th>
							</tr>
							</thead>
							<tbody>
							<tr v-for="item in taxes" :key="item.name">
								<td>{{ item.name }}</td>
								<td>{{ item.value }}</td>
								<td>
									<v-btn text icon color="red" @click="deleteTax(item.id)">
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
				name_tax:'',
				message: '',
				qty_tax:'',
				taxes: [],
			}
		},
		mounted() {
            this.getTaxes();
        },
		methods: {
			getTaxes() {
				axios.get(this.$root.base_url + 'shop/get_taxes')
				.then(res => {
					const datos = res.data.data;
					this.taxes = datos;
				})
				.catch(err => {
					console.error(err);
				})
			},
			saveTax() {
				this.$root.loading = true;
				const $this = this;

				const data_form = new FormData();
					  data_form.append ('name', this.name_tax);
					  data_form.append ('qty', this.qty_tax);

				axios.post(this.$root.base_url + 'shop/post_taxes', data_form)
					.then(response => {
						$this.$root.loading = false;
						this.dialog = false;
						location.reload();
					})
					.catch( error => {
						$this.$root.loading = false;
						$this.message = error.response.data.message;
						$this.showError = true;
						$this.typeError = 'error';
						setTimeout(() => {
							$this.message = ''
						}, 1500)
					})
			},
			deleteTax: function (item)
			{
				const $this = this;

				axios.post(this.$root.base_url + 'shop/put_status_tax/' + item)
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
