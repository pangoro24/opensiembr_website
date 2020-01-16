<v-content class="header-blog-view">
	<v-container>
		<?php $this->load->view('_components/front/header'); ?>
	</v-container>
</v-content>

<v-content class="mt-12 mb-12">
	<v-container>
		<v-row>
			<v-col cols="12" md="8">
				<h3><?= $product->name ?></h3>
				<p><?= $product->description ?></p>
			</v-col>
			<v-col cols="12" md="4">
				<v-img @click="overlay = !overlay" width="100%" src="<?= base_url('assets/shop/' .$product->images) ?>" lazy-src="<?= base_url('assets/shop/' .$product->images) ?>">
					<template v-slot:placeholder>
						<v-row class="fill-height ma-0" align="center" justify="center">
							<v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
						</v-row>
					</template>
				</v-img>
				<v-overlay :value="overlay">
					<v-btn icon @click="overlay = false">
						<v-icon>mdi-close</v-icon>
					</v-btn>
					<v-img width="100%" src="<?= base_url('assets/shop/' .$product->images) ?>" lazy-src="<?= base_url('assets/shop/' .$product->images) ?>">
						<template v-slot:placeholder>
							<v-row class="fill-height ma-0" align="center" justify="center">
								<v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
							</v-row>
						</template>
					</v-img>
				</v-overlay>
				<br>
				<h3>Precio: $ <?= $product->price ?></h3>
				<br>
				<p><?= $product->sort_description ?></p>
				<product price="<?= $product->price ?>" name_product="<?= $product->name ?>" description_product="<?= $product->sort_description ?>"></product>
				<br><br>
				<div class="sharethis-inline-share-buttons"></div>
			</v-col>
		</v-row>
	</v-container>
</v-content>
