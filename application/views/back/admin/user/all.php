<v-container class="pa-5">
	<v-row>
		<v-col cols="12">
			<v-skeleton-loader type="text" :loading="skeletonLoading" width="20%" transition="scale-transition">
				<p class="font-weight-bold headline mb-0">Todos los usuarios del sistema</p>
			</v-skeleton-loader>
		</v-col>
	</v-row>

	<all_user/>

</v-container>
