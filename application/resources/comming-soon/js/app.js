import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';

import axios from 'axios';

Vue.use(Vuetify);

var app = new Vue({
	el: '#app',
	data:{
		// Alert
		type:'',
		message:'',
		alert:false,
		// INPUTS
		loading:false,
		email:''
	},
	vuetify: new Vuetify(),
	methods:{
		sendMessage(){

			this.loading = true;

			if (this.email === '') 
			{
				this.loading = false;
				this.alert = true;
				this.type = 'red';
				this.message = 'Favor indique su correo electrónico';
				setTimeout(() => 
				{
					this.alert = false;
				}, 1500);

			} else {
				
				let data_form = new FormData();
					data_form.append('EMAIL', this.email);
					data_form.append('b_ada2d78aac371d3bcd6effbf6_926a1ab012', '');
	
				axios.post("https://opensiembro.us20.list-manage.com/subscribe/post?u=ada2d78aac371d3bcd6effbf6&amp;id=926a1ab012", data_form)
				.then(res => {
					console.log(res);
					this.loading = false;
					this.alert = true;
					this.type = 'success';
					this.message = 'Pronto recibiras nuestros boletines';
					this.email = '';
				})
				.catch(err => {
					console.error(err);
					this.loading = false;
					this.alert = true;
					this.type = 'red';
					this.message = 'Ha ocurrido un error...';
					this.email = '';
				})
			}

		}
	}
});
