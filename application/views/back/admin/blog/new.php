<v-container class="pa-5">
	<v-row>
		<v-col cols="12">
			<v-skeleton-loader type="text" :loading="skeletonLoading" width="20%" transition="scale-transition">
				<p class="font-weight-bold headline mb-0">Crear nuevo Post </p>
			</v-skeleton-loader>
		</v-col>
	</v-row>

	<v-form v-on:submit.prevent="saveBlog">
		<v-row>
			<v-col cols="8">
				<v-card class="text-center pa-5" :loading="loading">
					<v-skeleton-loader type="text" :loading="skeletonLoading" transition="scale-transition">
						<v-text-field v-model="title" label="Titulo" outlined></v-text-field>
					</v-skeleton-loader>
					<v-skeleton-loader type="paragraph" :loading="skeletonLoading" transition="scale-transition">
						<ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
					</v-skeleton-loader>
				</v-card>
			</v-col>
			<v-col cols="4">
				<v-skeleton-loader type="card" :loading="skeletonLoading" transition="scale-transition">
					<v-card class="elevation-6 pa-5" :loading="loading">
						<div class="image-preview" v-if="imageData.length > 0">
							<img class="preview" :src="imageData">
						</div>
						<v-file-input id="image" @change="previewImage" enctype="multipart/form-data" :rules="rulesUpload" accept="image/png, image/jpeg, image/jpg" placeholder="click para subir imagen principal" prepend-icon="mdi-camera" label="Imagen Principal"></v-file-input>
						<v-combobox multiple v-model="tag" label="Tags" append-icon chips deletable-chips class="tag-input" :search-input.sync="search" @keyup.tab="updateTags" @paste="updateTags">
						</v-combobox>
						<br>
						<v-btn type="submit" color="primary">Crear nuevo post</v-btn>
						<br><br>
						<v-alert type="error" class="transition-swing" transition="scale-transition" :value="showError"  dense outlined>
							{{ message }}
						</v-alert>
					</v-card>
				</v-skeleton-loader>
			</v-col>
		</v-row>
	</v-form>
</v-container>
