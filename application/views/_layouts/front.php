<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset=utf-8>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name=description content="<?= $description ?>">
	<meta name="theme-color" content="#008706">
	<!--FACEBOOK-->
	<meta property="og:title" content="<?= $title ?>" />
	<meta property="og:description" content="<?= $description ?>" />
	<meta property="og:image" content="favicon.ico" />
	<meta property="og:type" content="website" />
	<title><?= $title ?></title>
	<style type="text/css" media="screen">
		.body {
			display: none;
		}
	</style>
</head>
<body>

	<div id="app">
		<v-app class="body">
			<v-content>
				<?php $this->load->view('_components/front/slide-left'); ?>
		      	<?php $this->load->view('front/'.$section); ?>
		      	<?php $this->load->view('_components/front/footer'); ?>
		      	<v-btn v-scroll="onScroll" v-show="fab" fab dark fixed bottom right color="primary" @click="toTop">
				    <v-icon>mdi-arrow-up-thick</v-icon>
				</v-btn>
				<v-btn href="https://wa.me/50766865816" target="_blank" rel="noopener" class="btn-whatsapp" fab dark fixed bottom right color="green">
				    <v-icon>mdi-whatsapp</v-icon>
				</v-btn>
			</v-content>
	    </v-app>
	</div>

	<script src="/assets/front/app.js" type="text/javascript"></script>
	<link rel=stylesheet href="/assets/front/app.css">
</body>
</html>
