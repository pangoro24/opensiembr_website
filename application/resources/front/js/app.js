import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';

import axios from 'axios';

Vue.use(Vuetify);

var app = new Vue({
	el: '#app',
	vuetify: new Vuetify(),
	data:{
		drawer: null,
	}
});
