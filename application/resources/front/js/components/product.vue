<template>
	<div>
		<v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
			<template v-slot:activator="{ on }">
				<v-btn class="mx-2" fab dark small color="primary">
					<v-icon dark v-on="on">mdi-cart-plus</v-icon>
				</v-btn>
			</template>
				<v-snackbar v-model="snackbar">
					Por favor complete los siguientes campos
					<v-btn color="primary" text @click="snackbar = false">
						Cerrar
					</v-btn>
				</v-snackbar>
				<v-card class="mt-5">
					<v-form ref="form" v-on:submit.prevent="send_order">
						<v-toolbar dark color="green">
							<v-btn icon dark @click="dialog = false">
								<v-icon>mdi-close</v-icon>
							</v-btn>
							<v-toolbar-title>Realizar Pedido</v-toolbar-title>
							<v-spacer></v-spacer>
							<v-toolbar-items>
								<v-btn type="submit" :loading="loading" dark text>
									Hacer Pedido
									<v-icon dark>mdi-send-outline</v-icon>
								</v-btn>
							</v-toolbar-items>
						</v-toolbar>
						<v-container>
							<v-row>
								<v-col cols="6">
									<v-text-field type="text" v-model="name_order" :rules="[() => !!name_order || 'Este campo es requerido']" label="Nombre completo" outlined required></v-text-field>
									<v-text-field type="text" v-model="address_order" :rules="[() => !!address_order || 'Este campo es requerido']" label="Dirección completa de envio" outlined required></v-text-field>
									<v-text-field type="email" v-model="email_order" :rules="emailRules" label="Correo Electrónico" outlined required></v-text-field>
									<v-text-field type="number" v-model="phone_order" :rules="[() => !!phone_order || 'Este campo es requerido']" label="Celular" outlined required></v-text-field>
								</v-col>
								<v-col cols="6">
									<h4>Seleccione un método de envio</h4>
									<v-radio-group v-model="radioGroup">
										<v-radio @change="shipping_select(n.id, n.price)" v-for="n in sender" :key="n.id" :label="`${n.name} ${n.price}`" :value="n.id"></v-radio>
									</v-radio-group>
									<h4>Seleccione un método de pago</h4>
									<v-radio-group v-model="radioGroup2">
										<v-radio v-for="n in methods" :key="n.id" :label="`${n.name} || ${n.description}`" :value="n.id"></v-radio>
									</v-radio-group>
								</v-col>
								<v-col cols="12">
									<v-divider></v-divider>
									<br>
									<v-simple-table>
										<template v-slot:default>
											<thead>
											<tr>
												<th class="text-left">Qty</th>
												<th class="text-left">Descripción</th>
												<th class="text-left">Precio/U</th>
												<th class="text-left">Total</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td>
													<v-text-field type="number" v-model="qty_order" style="width: 100px"></v-text-field>
												</td>
												<td>{{ name_product }} : {{ description_product }}</td>
												<td>$ {{ price }}</td>
												<td>$ {{ total_price(price,qty_order) }}</td>
											<tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td class="text-right"><b>Sub-Total:</b></td>
												<td>$ {{ total_price(price,qty_order) }}</td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td class="text-right"><b>Cargos Adicionales:</b></td>
												<td>$ {{ shipping }}</td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td class="text-right"><b>ITBMS:</b></td>
												<td>$ {{ total_itbms() }}</td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td class="text-right"><b>Total a Pagar:</b></td>
												<td> <b>$ {{ total_pay() }}</b></td>
											</tr>
											</tbody>
										</template>
									</v-simple-table>
								</v-col>
							</v-row>
						</v-container>
					</v-form>
				</v-card>
		</v-dialog>
		<v-dialog v-model="dialog2" persistent width="500">
			<v-card>
				<v-card-title class="headline grey lighten-2" primary-title>
					PEDIDO # {{ id_order }}
				</v-card-title>

				<v-card-text class="mt-5">
					Hola {{ name_order }}. Su pedido ha sido realizado con éxito. Hemos enviado un correo electrónico con los datos de su orden. Su número de orden es: {{ id_order }}
				</v-card-text>

				<v-divider></v-divider>

				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="primary" text @click="success_order">
						OK
					</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</div>
</template>

<script>
	import axios from 'axios';

    export default {
    	props:['price','name_product','description_product'],
		data() {
            return {
				dialog:false,
				dialog2:false,
				snackbar: false,
				loading:false,
				order_send: false,
				qty_order:1,
				id_order: 0,
				name_order:'',
				email_order:'',
				address_order:'',
				phone_order:'',
				radioGroup:'',
				radioGroup2: '',
				sender:[],
				methods: [],
				shipping:0,
				priceTotal: 0,
				itbms:0,
				itbms_DB: 0,
				total_to_pay:0,
				// RULES
				emailRules: [
					v => !!v || 'E-mail es requerido',
					v => /.+@.+\..+/.test(v) || 'E-mail no es válido',
			  	],
            }
        },
		mounted() {
        	this.get_shipping();
        	this.get_taxes();
        	this.getMethod();
		},
		watch: {
    		dialog() {
    			this.qty_order = 1
			}
		},
		methods: {
    		send_order() {
				if (this.name_order && this.address_order && this.phone_order && this.radioGroup && this.radioGroup2)
				{
					this.loading = true
					const data_form = new FormData();
						data_form.append ('name', this.name_order);
						data_form.append ('address', this.address_order);
						data_form.append ('phone', this.phone_order);
						data_form.append ('email', this.email_order);
						data_form.append ('shipping', this.radioGroup);
						data_form.append ('method', this.radioGroup2);
						data_form.append ('qty', this.qty_order);
						data_form.append ('product', 1);
						data_form.append ('total', this.total_to_pay);

					axios.post(this.$root.base_url + 'shop/post_orders',data_form )
						.then(res => {
							this.order_send = true;
							this.loading = true;
							this.dialog = false;
							this.dialog2 = true;
							this.id_order = res.data.order;
							this.loading = false
						})
						.catch(err => {
							console.error(err);
							this.loading = false
						});
				} else {
					this.snackbar = true;
					console.log('favor complete los campos');
				}
			},
			success_order() {
				this.dialog2 = false;
				this.$refs.form.reset();
			},
            get_shipping() {
            	axios.get(this.$root.base_url + 'shop/get_method_shipping')
					.then(res => {
						const datos = res.data.data;
						this.sender = datos;
					})
					.catch(err => {
						console.error(err);
					})
			},
			shipping_select(id,price) {
				this.shipping = price;
			},
			total_price: function(total, qty) {
				const total_price = total * qty;
				this.priceTotal = total_price;
    			return total_price.toFixed(2);
			},
			get_taxes() {
    			axios.get(this.$root.base_url + 'shop/get_taxes')
				.then(res => {
					const datos = res.data.data;
					this.itbms_DB =  datos[0].value;
				})
				.catch(err => {
					console.error(err);
				})
			},
			total_itbms: function()
			{
				const itbms = this.priceTotal * this.itbms_DB;
				this.itbms = itbms;
				return itbms.toFixed(2);
			},
			total_pay: function() {
				const shipping = Number(this.shipping);
				const total_pay = shipping + this.itbms + this.priceTotal;
				this.total_to_pay = total_pay;
				return total_pay.toFixed(2);
			},
			getMethod() {
				axios.get(this.$root.base_url + 'shop/get_payment_method')
				.then(res => {
					const datos = res.data.data;
					this.methods = datos;
				})
				.catch(err => {
					console.error(err);
				})
			}

        }
    }
</script>

<style scoped>

</style>
