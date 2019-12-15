<template>
	<div>
		<v-row>
			<v-col cols="12" md="4">
				<v-skeleton-loader type="card" :loading="this.$root.skeletonLoading" transition="scale-transition">

					<v-card outlined elevation="4" color="#1D2939" dark class="text-center">
						<v-container class="pb-12 pt-12">
							<v-btn fab dark large href="/admin/config/edit" title="">
								<v-avatar size="62" color="green">
									<v-icon dark>mdi-account-circle</v-icon>
								</v-avatar>
							</v-btn>
							<p class="mb-0 mt-3">{{ fullname }}</p>
							<p class="mb-0">{{ email }}</p>
						</v-container>
					</v-card>

				</v-skeleton-loader>
			</v-col>
			<v-col cols="12" md="8">

				<v-tabs fixed-tabs background-color="#1D2939" dark>
					<v-tab :href="'#tab-1'">
						INFORMACIÓN
					</v-tab>
					<v-tab :href="'#tab-2'">
						CONTRASEÑA
					</v-tab>

					<v-tab-item :value="'tab-1'">
						<v-skeleton-loader type="card" :loading="this.$root.skeletonLoading" transition="scale-transition">
							<v-card outlined elevation="4" :loading="this.$root.loading">
								<v-card-title class="card-header">
									<span class="body-1">Editar Información</span>
								</v-card-title>
								<v-card-text>
									<p>Esta sección proporciona información personal del usuario.</p>
								</v-card-text>
								<v-container class="pb-3 pt-0">
									<v-card-text>
										<v-form v-on:submit.prevent="edit_user">
											<v-row>
												<v-col cols="12" md="6">
													<v-text-field v-model="fullname" label="Primer Nombre" filled dense rounded hint="ejm: Jaime Alberto" :rules="[() => !!fullname || 'Este campo es requerido']"></v-text-field>
													<v-text-field v-model="email" label="Correo electrónico" filled dense rounded hint="ejm: jaime@email.com" :rules="[() => !!email || 'Este campo es requerido']"></v-text-field>
													<v-dialog ref="dialog" v-model="modal" :return-value.sync="birth_date" persistent width="290px">
														<template v-slot:activator="{ on }">
															<v-text-field class="mt-5" v-model="birth_date" label="Fecha de Nacimiento" prepend-inner-icon="mdi-calendar-month-outline" readonly filled dense rounded v-on="on" :rules="[() => !!birth_date || 'Este campo es requerido']"></v-text-field>
														</template>
														<v-date-picker v-model="birth_date" scrollable>
															<v-spacer></v-spacer>
															<v-btn text color="primary" @click="modal = false">Cancelar</v-btn>
															<v-btn text color="primary" @click="$refs.dialog.save(birth_date)">OK</v-btn>
														</v-date-picker>
													</v-dialog>
													<v-text-field v-model="phone" label="Celular" filled dense rounded hint="ejm: 6943-3344" :rules="[() => !!phone || 'Este campo es requerido']"></v-text-field>
												</v-col>
												<v-col cols="12" md="6">
													<v-text-field v-model="address" label="Dirección" filled dense rounded hint="ejm: Calle cuarta, Cuarta casa a mano derecha." :rules="[() => !!email || 'Este campo es requerido']"></v-text-field>
													<v-text-field readonly v-model="district_id" label="Distrito" filled dense rounded :rules="[() => !!phone || 'Este campo es requerido']"></v-text-field>
												</v-col>
											</v-row>
											<v-divider></v-divider>
											<v-row>
												<v-col cols="12" class="text-center">
													<v-btn type="submit" :loading="this.$root.loading" :disabled="(!!fullname)? false:true" rounded color="primary">
														<v-icon left>mdi-content-save-move-outline</v-icon> Editar Usuario
													</v-btn>
													<br><br>
													<v-alert type="info" class="transition-swing" transition="scale-transition" :value="showError"  dense outlined>
														{{ message }}
													</v-alert>
												</v-col>
											</v-row>
										</v-form>
									</v-card-text>
								</v-container>
							</v-card>
						</v-skeleton-loader>
					</v-tab-item>
					<v-tab-item :value="'tab-2'">
						<v-skeleton-loader type="card" :loading="this.$root.skeletonLoading" transition="scale-transition">
							<v-card outlined elevation="4" :loading="this.$root.loading">
								<v-card-title class="card-header">
									<span class="body-1">Nueva contraseña</span>
								</v-card-title>
								<v-card-text>
									<p>Usted podra cambiar su contraseña de inicio de sesión.</p>
								</v-card-text>
								<v-container class="pb-3 pt-3">
									<v-card-text>
										<v-form v-on:submit.prevent="edit_pw">
											<v-row>
												<v-col cols="12">
													<v-text-field type="password" v-model="password" label="Nueva contraseña" filled dense rounded :rules="rules"></v-text-field>
													<v-text-field type="password" v-model="repeatPassword" label="Repetir contraseña" filled dense rounded :rules="rules"></v-text-field>
												</v-col>
											</v-row>
											<v-divider></v-divider>
											<v-row>
												<v-col cols="12" class="text-center">
													<v-btn type="submit" :loading="this.$root.loading" :disabled="(!!password && !!repeatPassword)? false:true" rounded color="primary">
														<v-icon left>mdi-content-save-move-outline</v-icon> Cambiar Contraseña
													</v-btn>
													<br><br>
													<v-alert type="info" class="transition-swing" transition="scale-transition" :value="showError"  dense outlined>
														{{ message }}
													</v-alert>
												</v-col>
											</v-row>
										</v-form>
									</v-card-text>
								</v-container>
							</v-card>
						</v-skeleton-loader>
					</v-tab-item>
				</v-tabs>
			</v-col>
		</v-row>
	</div>
</template>

<script>
	import axios from 'axios';

	export default {

		props:[
			'id_user',
			'pFullname',
			'pPhone',
			'pEmail',
			'pBirth',
			'pDistrict',
			'pAddress',
		],
		data() {
			return {
				menu: false,
				modal: false,
				menu2: false,
				showError: false,
				message: '',
				// DATA INFO
				fullname: this.pFullname,
				phone:this.pPhone,
				email:this.pEmail,
				birth_date:this.pBirth,
				district_id:this.pDistrict,
				address: this.pAddress,
				password: '',
				repeatPassword: '',
				// RULES
				rules: [
					value => !!value || 'Este campo es requerido.',
					value => (value || '').length >= 8 || 'Min 8 caracteres',
				],
			}
		},
		methods: {
			edit_user: function()
			{
				this.$root.loading = true;
				const $this = this;

				const data_form = new FormData();
					data_form.append ('fullname', this.fullname);
					data_form.append ('email', this.email);
					data_form.append ('birth', this.birth_date);
					data_form.append ('phone', this.phone);
					data_form.append ('address', this.address);

				axios.post(this.$root.base_url + 'user/put_info/' + $this.id_user, data_form)
						.then( response => {
							this.$root.loading = false;
							$this.message = response.data.message;
							$this.showError = true;
							console.log(response);
						})
						.catch( error => {
							this.$root.loading = false;
							$this.message = error.response.data.message;
							$this.showError = true;
							console.log(error.response);
						})
			},
			edit_pw: function()
			{
				this.$root.loading = true;
				const $this = this;

				const data_form = new FormData();
					data_form.append ('password', this.password);
					data_form.append ('repeatPassword', this.repeatPassword);

				axios.post(this.$root.base_url + 'user/put_pw/' + $this.id_user, data_form)
						.then( response => {
							this.$root.loading = false;
							$this.message = response.data.message;
							$this.showError = true;
							console.log(response);
						})
						.catch( error => {
							this.$root.loading = false;
							$this.message = error.response.data.message;
							$this.showError = true;
							console.log(error.response);
						})
			}
		},

	}
</script>

<style scoped>

</style>
