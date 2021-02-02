<v-main class="header-shop">
	<v-container>
		<?php $this->load->view('_components/front/header'); ?>
	</v-container>
</v-main>

<v-main class="mt-12 mb-12">
	<v-container>
		<v-row>
			<v-col cols="12" md="3">
				<v-card class="mx-auto">
				    <v-list-item>
				        <v-list-item-content>
				            <v-text-field label="Buscar artículos" filled rounded dense></v-text-field>
				            <v-btn small>Buscar producto</v-btn>
				        </v-list-item-content>
				    </v-list-item>
				</v-card>
			</v-col>

			<v-col cols="12" md="9">
				<h3>Todos los productos a la venta</h3>
				<v-row>
					<?php foreach ($products as $last): ?>
						<v-col cols="12" md="4">
							<v-card class="mx-auto" max-width="400">
								<v-img class="white--text align-end" height="150px" src="<?= base_url('assets/shop/' .$last->images) ?>">
								</v-img>
								<v-card-subtitle class="pb-0"><b><?= $last->name ?></b> | $ <?= $last->price ?></v-card-subtitle>
								<v-card-text class="text--primary">
									<div><?= $last->sort_description ?></div>
								</v-card-text>
								<v-card-actions>
									<v-btn color="primary" small href="<?= base_url('shop/product/' .$last->id) ?>">
										Ver Producto
									</v-btn>
								</v-card-actions>
							</v-card>
						</v-col>
					<?php endforeach ?>
				</v-row>
			</v-col>
		</v-row>
	</v-container>
</v-main>
