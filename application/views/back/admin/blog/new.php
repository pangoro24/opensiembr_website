<v-container class="pa-5">
	<v-row>
		<v-col cols="12">
			<v-skeleton-loader type="text" :loading="skeletonLoading" width="20%" transition="scale-transition">
				<p class="font-weight-bold headline mb-0">Crear nuevo Post </p>
			</v-skeleton-loader>
		</v-col>
	</v-row>
	<v-row>
		<v-col cols="8">
			<v-text-field label="Titulo" outlined></v-text-field>
			<p>Editor</p>
			<v-btn color="primary">Crear nuevo post</v-btn>
		</v-col>
		<v-col cols="4">

		</v-col>
	</v-row>
</v-container>
