<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8>
	<meta name=description content="<?= $description ?>">
	<meta name="theme-color" content="#008706">
	<!--FACEBOOK-->
	<meta property="og:title" content="<?= $title ?>" />
	<meta property="og:description" content="<?= $description ?>" />
	<meta property="og:image" content="favicon.ico" />
	<meta property="og:type" content="website" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
	<title><?= $title ?></title>
	<style type="text/css" media="screen">
		.body {
			display: none;
		}
	</style>
</head>
<body>

	<div id="app">
		<v-app>
			<v-content>
				<?php $this->load->view('_components/front/slide-left'); ?>
		      	<?php $this->load->view('front/'.$section); ?>
		      	<?php $this->load->view('_components/front/footer'); ?>
			</v-content>
	    </v-app>
	</div>

	<script src="/assets/front/app.js" type="text/javascript"></script>
	<link rel=stylesheet href="/assets/front/app.css">
</body>
</html>