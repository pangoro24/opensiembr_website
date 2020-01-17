import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';

// Editor
import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

import axios from 'axios';
import $ from 'jquery';

// IMPORTS COMPONENTS
import charts_users from "./components/charts_users.vue";
import charts_shop from "./components/charts_shop";
import menu_principal from "./components/Menu";
import all_blog from "./components/all_blog";
import all_user from "./components/all_user";
import edit_blog from "./components/edit_blog";
import edit_user from "./components/edit_user";
import all_products from "./components/all_products";
import edit_product from "./components/edit_product";
import all_orders from "./components/all_orders";

// CONFIG SHOP
import delivery from "./components/config-shop/delivery";
import taxes from "./components/config-shop/taxes";

Vue.use(Vuetify);
Vue.use( CKEditor );

var app = new Vue({
	el: '#app',
	vuetify: new Vuetify(),
	components: {
		charts_users,
		charts_shop,
		menu_principal,
		all_blog,
		edit_blog,
		edit_user,
		all_user,
		all_products,
		edit_product,
		all_orders,
		delivery,
		taxes,
	},
	data: {
		base_url: 'http://www.opensiembro.com/api/',
		drawer: null,
		loading: false,
		skeletonLoading: true,
		typeError: '',
		message: '',
		showError: false,
		emailPhone:'',
		password:'',
		// REGISTER USER
		name: '',
		phone: '',
		email: '',
		// BLOG
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
		// SHOP
		nameProduct:'',
		sortDescription:'',
		description: '',
		priceProduct: '',
		imageProduct: '',
		tax: ['No'],
	},
	mounted() {
        setTimeout(() => {
            this.skeletonLoading = false;
        }, 1500);
    },
	methods: {
		// LOGIN & REGISTER
		login() {
			this.loading = true;
			const $this = this;
			axios.post(this.base_url + 'login', {
				emailPhone :this.emailPhone,
				password: this.password
			})
				.then(response => {
					this.loading = false;
					const data = response.data.data_user;
					location.href = '/' + data.slug + '/dashboard';
				})
				.catch(error => {
					console.log(error);
					this.loading = false;
					const data = error.response;
					switch (data.status) {
						case 401: {
							$this.message = data.data.message;
							$this.showError = true;
							$this.typeError = 'error';
							break;
						}
						case 500: {
							console.log('Error 500');
							$this.showError = true;
							$this.message = 'Ha ocurrido un error interno. Intente de nuevo';
							$this.typeError = 'error';
							break;
						}
						default: {
							console.log(data);
						}
					}
				})
		},
		register() {
			this.loading = true;
			const $this = this;
			axios.post(this.base_url + 'register', {
				name :this.name,
				phone: this.phone,
				email: this.email,
				password: this.password
			})
				.then(response => {
					$this.loading = false;
					$this.showError = true;
					$this.typeError = 'success';
					$this.message = response.data.data;
					$this.name = '';
					$this.phone = '';
					$this.email = '';
					$this.password = '';
					// console.log(response);
				})
				.catch(error => {
					this.loading = false;
					const data = error.response;
					switch (data.status) {
						case 401: {
							$this.message = data.data.message;
							$this.showError = true;
							$this.typeError = 'error';
							break;
						}
						case 500: {
							console.log('Error 500');
							$this.showError = true;
							$this.message = 'Ha ocurrido un error interno. Intente de nuevo';
							$this.typeError = 'error';
							break;
						}
						default: {
							console.log(data);
						}
					}
				})
		},
		// BLOG
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

			axios.post(this.base_url + 'blog/post', data_form)
				.then( response => {
					this.loading = false;
					location.href = './all';
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
		// SHOP
		saveProduct() {
			this.loading = true;
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

			axios.post(this.base_url + 'shop/post', data_form)
				.then( response => {
					console.log(response);
					$this.loading = false;
					location.href = './products';
				})
				.catch( error => {
					console.log(error.response);
					$this.loading = false;
					$this.message = error.response.data.message;
					$this.showError = true;
					$this.typeError = 'error';
				})
		}
	}
});
