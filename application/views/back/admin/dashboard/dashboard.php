<v-container>
	<v-row>
		<v-col cols="12">
			<v-skeleton-loader type="text" :loading="skeletonLoading" width="20%" transition="scale-transition">
				<p class="font-weight-bold headline mb-0">Dashboard </p>
			</v-skeleton-loader>
			<v-skeleton-loader type="text" :loading="skeletonLoading" width="45%" transition="scale-transition">
				<p class="caption">Bienvenido a la plataforma de Open Siembro.</p>
			</v-skeleton-loader>
		</v-col>
	</v-row>
	<v-row>
		<v-col cols="12" class="col-md-8">
			<h5>Reportes</h5>
		</v-col>
		<v-col cols="12" class="col-md-4">
			<h5>Ventas</h5>
		</v-col>
	</v-row>
</v-container>
