import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';
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
		drawer: null,
		fab: false,
		overlay: false,
	},
	methods: {
		onScroll(e) {
			if (typeof window === 'undefined') return
			const top = window.pageYOffset || e.target.scrollTop || 0
			this.fab = top > 20
		},
		toTop() {
			this.$vuetify.goTo(0)
		}
	},
	created() {
		AOS.init({ disable: "phone" });
	},
});
