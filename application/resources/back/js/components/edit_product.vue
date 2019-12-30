<template>
    <div>

		<v-form v-on:submit.prevent="saveProduct">
			<v-row>
				<v-col cols="8">
					<v-card class="text-center pa-5" :loading="this.$root.loading">
						<v-skeleton-loader type="text" :loading="this.$root.skeletonLoading" transition="scale-transition">
							<v-text-field v-model="nameProduct" label="Nombre del producto" outlined></v-text-field>
						</v-skeleton-loader>
						<v-skeleton-loader type="text" :loading="this.$root.skeletonLoading" transition="scale-transition">
							<v-textarea v-model="sortDescription" label="Descripcion corta del producto" outlined></v-textarea>
						</v-skeleton-loader>
						<v-skeleton-loader type="paragraph" :loading="this.$root.skeletonLoading" transition="scale-transition">
							<ckeditor :editor="editor" v-model="description" :config="editorConfig"></ckeditor>
						</v-skeleton-loader>
					</v-card>
				</v-col>
				<v-col cols="4">
					<v-skeleton-loader type="card" :loading="this.$root.skeletonLoading" transition="scale-transition">
						<v-card class="elevation-6 pa-5" :loading="this.$root.loading">
							<v-text-field v-model="priceProduct" label="Precio" outlined></v-text-field>
							<v-select :items="tax" label="Impuesto (tax)" outlined></v-select>
							<div class="image-preview" v-if="imageData.length > 0">
								<img class="preview" :src="imageData">
							</div>
							<v-file-input id="image" @change="previewImage" enctype="multipart/form-data" :rules="rulesUpload" accept="image/png, image/jpeg, image/jpg" placeholder="click para subir imagen principal" prepend-icon="mdi-camera" label="Imagen Principal"></v-file-input>
							<br>
							<br>
							<h4>Opciones</h4>
							<hr>
							<br>
							<v-btn fab dark small type="submit" color="primary">
								<v-icon>mdi-pencil-outline</v-icon>
							</v-btn>
							<v-btn fab dark small type="button" v-if="status" text  color="error" v-on:click="disable">
								<v-icon>mdi-delete</v-icon>
							</v-btn>
							<v-btn fab dark small type="button" v-if="!status" color="primary" v-on:click="enable">
								<v-icon>mdi-check-circle-outline</v-icon>
							</v-btn>
							<br><br>
							<v-alert type="error" class="transition-swing" transition="scale-transition" :value="showError"  dense outlined v-html="message">
							</v-alert>
						</v-card>
					</v-skeleton-loader>
				</v-col>
			</v-row>
		</v-form>
	</div>
</template>

<script>
	import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
	import $ from 'jquery';
	import axios from 'axios';

	const id = window.location.href.split('/');

    export default {
        data() {
			return {
				showError: false,
				message: '',
				// DATA
				nameProduct: '',
				sortDescription:'',
				description:'',
				priceProduct:'',
				tax:['7% Panamá'],
				status:false,
				rulesUpload: [
					value => !value || value.size < 2000000 || 'Images size should be less than 2 MB!',
				],
				imageData: "",
				imageFirst: '',
				file_data: '',
				// EDITOR BLOG
				editor: ClassicEditor,
				editorData: '',
				editorConfig: {
					// The configuration of the editor.
					ckfinder: {
						uploadUrl: 'http://dev.opensiembro.com/api/blog/upload_images_editor'
					}
				},
			}
		},
		mounted() {
			this.dataProduct();
		},
		methods: {
        	dataProduct() {
				const $this = this;

				axios.get(this.$root.base_url + 'shop/getBy/' + id[6],)
				.then(response => {
					const shop = response.data.data;
					$this.nameProduct = shop.name;
					$this.sortDescription = shop.sort_description;
					$this.description = shop.description;
					$this.priceProduct = shop.price;
					$this.status = shop.status;
					$this.imageData = '../../../assets/shop/' + shop.images;
				})
				.catch(error => {
					console.log(error);
				})
			},
			previewImage: function(event) {
				// Reference to the DOM input element
				const input = event;
				// Ensure that you have a file before attempting to read it
				if (input) {
					// create a new FileReader to read this image and convert to base64 format
					const reader = new FileReader();
					// Define a callback function to run, when FileReader finishes its job
					reader.onload = (e) => {
						// Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
						// Read image as base64 and set to imageData
						this.imageData = e.target.result;
					};
					// Start the reader job - read file as a data url (base64 format)
					reader.readAsDataURL(input);
				}
			},
			saveProduct() {
				this.$root.loading = true;
				const $this = this;

				this.file_data = $('#image').prop('files')[0];

				const data_form = new FormData();
					  data_form.append ('name', this.nameProduct);
					  data_form.append ('sort_description', this.sortDescription);
					  data_form.append ('description', this.description);
					  data_form.append ('price', this.priceProduct);
					  data_form.append ('method_pay', 0);
					  data_form.append ('tax', this.tax);
					  data_form.append ('file', this.file_data);

				axios.post(this.$root.base_url + 'shop/put/' + id[6], data_form)
					.then( response => {
						this.loading = false;
						console.log(response);
						location.href = '../products';
					})
					.catch( error => {
						this.loading = false;
						$this.message = error.response.data.message;
						$this.showError = true;
						$this.typeError = 'error';
						console.log(error.response);
					})
			},
			disable: function() {
				const $this = this;

				const data_form = new FormData();
					data_form.append ('status', 0);

				axios.post(this.$root.base_url + 'shop/put_status/' + id[6], data_form)
					.then( response => {
						this.loading = true;
						this.status = false;
						this.showError = true;
						this.message = 'El blog se ha deshabilitado correctamente.';
						console.log(response);
					})
					.catch( error => {
						this.loading = false;
						$this.message = error.response.data.message;
						$this.showError = true;
						$this.typeError = 'error';
						console.log(error.response);
					})
			},
			enable: function(){
				const $this = this;

				const data_form = new FormData();
				data_form.append ('status', 1);

				axios.post(this.$root.base_url + 'shop/put_status/' + id[6], data_form)
						.then( response => {
							this.loading = true;
							this.status = true;
							this.showError = true;
							this.message = 'El blog se ha habilitado correctamente.';
						})
						.catch( error => {
							this.loading = false;
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
