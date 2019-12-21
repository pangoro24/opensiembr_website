<template>
    <div>
		<v-form v-on:submit.prevent="saveBlog">
			<v-row>
				<v-col cols="8">
					<v-card class="text-center pa-5" :loading="this.$root.loading">
						<v-skeleton-loader type="text" :loading="this.$root.skeletonLoading" transition="scale-transition">
							<v-text-field v-model="title" label="Titulo" outlined></v-text-field>
						</v-skeleton-loader>
						<v-skeleton-loader type="paragraph" :loading="this.$root.skeletonLoading" transition="scale-transition">
							<ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
						</v-skeleton-loader>
					</v-card>
				</v-col>
				<v-col cols="4">
					<v-skeleton-loader type="card" :loading="this.$root.skeletonLoading" transition="scale-transition">
						<v-card class="elevation-6 pa-5" :loading="this.$root.loading">
							<div class="image-preview" v-if="imageData.length > 0">
								<img class="preview" :src="imageData">
							</div>
							<v-file-input id="image" @change="previewImage" enctype="multipart/form-data" :rules="rulesUpload" accept="image/png, image/jpeg, image/jpg" placeholder="click para cambiar imagen principal" prepend-icon="mdi-camera" label="Imagen Principal"></v-file-input>
							<v-combobox multiple v-model="tag" label="Tags" append-icon chips deletable-chips class="tag-input" :search-input.sync="search" @keyup.tab="updateTags" @paste="updateTags">
							</v-combobox>
							<br>
							<h4>Opciones</h4>
							<hr>
							<br>
							<v-btn fab dark small type="submit" color="primary">
								<v-icon>mdi-pencil-outline</v-icon>
							</v-btn>
							<v-btn fab dark small type="button" v-if="status" text  color="error" v-on:click="disableBlog">
								<v-icon>mdi-delete</v-icon>
							</v-btn>
							<v-btn fab dark small type="button" v-if="!status" color="primary" v-on:click="enableBlog">
								<v-icon>mdi-check-circle-outline</v-icon>
							</v-btn>
							<br><br>
							<v-alert type="info" class="transition-swing" transition="scale-transition" :value="showError"  dense outlined>
								{{ message }}
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
				title: '',
				rulesUpload: [
					value => !value || value.size < 2000000 || 'Avatar size should be less than 2 MB!',
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
				// TAG
				tag: [],
				items: [],
				search: "", //sync search
				id: '',
				status: false,
			}
		},
		mounted() {
			this.dataBlog();
		},
		methods: {
        	dataBlog() {
				const $this = this;
				axios.get(this.$root.base_url + 'blog/getBy/' + id[6],)
				.then(response => {
					const blog = response.data.data;
					$this.title = blog.title;
					$this.editorData = blog.body;
					$this.tag = blog.tag.split(',');
					$this.imageData = '../../../assets/blog/' + blog.images;
					$this.id = blog.id;
					$this.status = (blog.status === '1')? true:false;
					console.log(blog);
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
			saveBlog() {
				this.loading = true;
				const $this = this;

				this.file_data = $('#image').prop('files')[0];

				const data_form = new FormData();
					  data_form.append ('title', this.title);
					  data_form.append ('body', this.editorData);
					  data_form.append ('tag', this.tag);
					  data_form.append ('file', this.file_data);

				axios.post(this.$root.base_url + 'blog/put/' + $this.id, data_form)
					.then( response => {
						this.loading = false;
						location.href = '../all';
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
			updateTags() {
				this.$nextTick(() => {
					this.select.push(...this.search.split(","));
					this.$nextTick(() => {
						this.search = "";
					});
				});
			},
			disableBlog: function() {
				const $this = this;

				const data_form = new FormData();
					data_form.append ('status', 0);

				axios.post(this.$root.base_url + 'blog/put_status/' + $this.id, data_form)
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
			enableBlog: function(){
				const $this = this;

				const data_form = new FormData();
				data_form.append ('status', 1);

				axios.post(this.$root.base_url + 'blog/put_status/' + $this.id, data_form)
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
