import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';
import axios from 'axios';

// IMPORTS COMPONENTS
import menu_principal from "./components/Menu";
import all_blog from "./components/all_blog";

Vue.use(Vuetify);

var app = new Vue({
	el: '#app',
	vuetify: new Vuetify(),
	components: {
		menu_principal,
		all_blog
	},
	data: {
		base_url: 'http://dev.opensiembro.com/api/',
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
		email: ''
	},
	mounted() {
        setTimeout(() => {
            this.skeletonLoading = false;
        }, 1500);
    },
	methods: {
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
		}
	}
});
