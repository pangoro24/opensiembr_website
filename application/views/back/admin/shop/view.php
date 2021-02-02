<v-container class="pa-5">
	<v-row>
		<v-col cols="12">
			<v-skeleton-loader type="text" :loading="skeletonLoading" width="20%" transition="scale-transition">
				<p class="font-weight-bold headline mb-0">Orden # <?= $order->id ?></p>
			</v-skeleton-loader>
		</v-col>
	</v-row>

	<v-row>
		<v-col cols="12" md="6">
			<h4>Información del cliente</h4>
			<hr>
			<br>
			<p>
				Nombre completo: <?= $order->name ?> <br>
				Correo electrónico: <?= $order->email ?> <br>
				Teléfono: <?= $order->phone ?> <br>
				Dirección: <?= $order->address ?>
			</p>
			<h4>Información del pedido</h4>
			<hr>
			<p>
				Estado del Pedido: <b><?= status_order($order->status) ?></b><br>
				Produto: <b><?= $product->name ?></b><br>
				Cantidad: <?= $order->qty ?><br>
				Método de envio: <b><?= $order->shipping_name ?></b><br>
				Método de pago: <b><?= $order->method_name ?></b><br>
				Total: $<b><?= $order->total ?></b>
			</p>
			<v-row>
				<v-col cols="6">
					<v-form v-if="<?= $order->status ?> === 1" method="post" action="<?= base_url('api/shop/change_status_order/2') ?>">
						<input hidden type="text" value="<?= $order->id ?>" name="id_order">
						<v-btn type="submit" color="blue-grey" class="white--text">
							Procesar pedido <v-icon right dark>mdi-reload</v-icon>
						</v-btn>
					</v-form>
					<v-form v-if="<?= $order->status ?> === 2" method="post" action="<?= base_url('api/shop/change_status_order/3') ?>">
						<input hidden type="text" value="<?= $order->id ?>" name="id_order">
						<v-btn type="submit" color="teal" class="white--text">
							Completar pedido <v-icon right dark>mdi-reload</v-icon>
						</v-btn>
					</v-form>
					<v-btn v-if="<?= $order->status ?> === 3" type="button" color="primary" class="white--text">
						Pedido Completado <v-icon right dark>mdi-check</v-icon>
					</v-btn>
				</v-col>
				<v-col cols="6">
					<v-form v-if="<?= $order->status ?> === 1 || <?= $order->status ?> === 2 || <?= $order->status ?> === 3" method="post" action="<?= base_url('api/shop/change_status_order/4') ?>">
						<input hidden type="text" value="<?= $order->id ?>" name="id_order">
						<v-btn type="submit" color="red" class="white--text">
							Cancelar <v-icon right dark>mdi-close-circle</v-icon>
						</v-btn>
					</v-form>
				</v-col>
			</v-row>
		</v-col>

		<v-col cols="12" md="6">
			<h4>Detalle del producto</h4>
			<hr>
			<br>
			<v-row>
				<v-col cols="6">
					<v-img
					  src="<?= base_url('assets/shop/' .$product->images) ?>"
					  lazy-src="<?= base_url('assets/shop/' .$product->images) ?>"
					>
				</v-col>
				<v-col cols="6">
					<p>
						<?= $product->name ?> <br>
						<?= $product->sort_description ?> <br>
						$ <?= $product->price ?>
					</p>
				</v-col>
			</v-row>
		</v-col>
	</v-row>

</v-container>
