<v-container class="pa-5">
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
		<v-col cols="12" class="col-md-8"></v-col>
		<v-col cols="12" class="col-md-4">
			<v-skeleton-loader type="list-item-avatar-three-line" :loading="skeletonLoading" transition="scale-transition">
				<v-card>
					<v-card-text>
						<div><h5>Mis Zonas Post</h5></div>
					</v-card-text>
				</v-card>
			</v-skeleton-loader>
		</v-col>
	</v-row>
</v-container>
