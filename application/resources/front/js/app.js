import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';
import axios from 'axios';
import AOS from "aos";
import "aos/dist/aos.css";
var VueScrollTo = require('vue-scrollto');

Vue.use(Vuetify);
Vue.use(VueScrollTo, {
     container: "body",
     duration: 500,
     easing: "ease",
     offset: 0,
     force: true,
     cancelable: true,
     onStart: false,
     onDone: false,
     onCancel: false,
     x: false,
     y: true
 })

var app = new Vue({
	el: '#app',
	vuetify: new Vuetify(),
	data: {
		base_url: 'http://dev.opensiembro.com/api/',
		typeError: '',
		message: '',
		showError: false,
		drawer: null,
		fab: false,
		overlay: false,
		// LOGIN
		emailPhone:'',
		password:'',
	},
	methods: {
		onScroll(e) {
			if (typeof window === 'undefined') return
			const top = window.pageYOffset || e.target.scrollTop || 0
			this.fab = top > 20
		},
		toTop() {
			this.$vuetify.goTo(0)
		},
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
	},
	created() {
		AOS.init({ disable: "phone" });
	},
});
