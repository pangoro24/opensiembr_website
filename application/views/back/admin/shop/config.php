<v-container class="pa-5">
	<v-row>
		<v-col cols="12">
			<v-skeleton-loader type="text" :loading="skeletonLoading" width="20%" transition="scale-transition">
				<p class="font-weight-bold headline mb-0">Configuración de la Tienda </p>
			</v-skeleton-loader>
		</v-col>
	</v-row>

	<v-row>
		<v-col cols="6">
			<taxes></taxes>
		</v-col>

		<v-col cols="6">
			<delivery></delivery>
		</v-col>
	</v-row>

</v-container>
