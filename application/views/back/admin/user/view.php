<v-container class="pa-5">
	<v-row>
		<v-col cols="12">
			<v-skeleton-loader type="text" :loading="skeletonLoading" width="20%" transition="scale-transition">
				<p class="font-weight-bold headline mb-0">Ver usuario <?= $user->fullname ?></p>
			</v-skeleton-loader>
		</v-col>
	</v-row>

	<v-row>
		<v-col cols="12" md="8">
			<v-tabs fixed-tabs background-color="#1D2939" dark>
				<v-tab :href="'#tab-1'">
					INFORMACIÓN PERSONAL
				</v-tab>
				<v-tab :href="'#tab-2'">
					ZONAS DE RIEGOS
				</v-tab>

				<v-tab-item :value="'tab-1'">
					<v-skeleton-loader type="card" :loading="this.$root.skeletonLoading" transition="scale-transition">
						<v-card outlined elevation="4" :loading="this.$root.loading">
							<v-card-text class="card-header pb-0">
								<p>Esta sección proporciona información personal del usuario.</p>
							</v-card-text>
							<v-container class="pb-3 pt-0">
								<v-card-text>
									<p><b>Nombre Completo: </b> <?= $user->fullname ?> <br></p>
									<p><b>Correo Electrónico: </b> <?= $user->email ?> <br></p>
									<p><b>Fecha de Nacimiento: </b> <?= $user->birth_date ?> <br></p>
									<p><b>Teléfono: </b> <?= $user->phone ?> <br></p>
									<p><b>Distrito: </b> <?= $user->district_id ?> <br></p>
									<p><b>Dirección: </b> <?= $user->address ?> <br></p>
								</v-card-text>
							</v-container>
						</v-card>
					</v-skeleton-loader>
				</v-tab-item>

				<v-tab-item :value="'tab-2'">
					<p>hola</p>
				</v-tab-item>
			</v-tabs>
		</v-col>

		<v-col cols="12" md="4">
			<v-skeleton-loader type="card" :loading="this.$root.skeletonLoading" transition="scale-transition">

				<v-card outlined elevation="4" color="#1D2939" dark class="text-center">
					<v-container class="pb-12 pt-12">
						<v-btn fab dark large href="/admin/config/edit" title="">
							<v-avatar size="62" color="green">
								<v-icon dark>mdi-account-circle</v-icon>
							</v-avatar>
						</v-btn>
						<p class="mb-0 mt-3"><?= $user->fullname ?></p>
						<p class="mb-0"><?= $user->email ?></p>
					</v-container>
				</v-card>

			</v-skeleton-loader>
		</v-col>
	</v-row>

</v-container>



