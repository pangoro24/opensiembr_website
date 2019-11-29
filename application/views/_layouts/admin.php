<!DOCTYPE html>
<html lang="es">
<head>
	<?php $this->load->view('_components/back/head'); ?>
</head>
	<body>
	<div id="app">
		<v-app class="body">
			<!-- ########## START: LEFT PANEL ########## -->
				<?php $this->load->view('_components/back/sideleft'); ?>
			<!-- ########## END: LEFT PANEL ########## -->

			<!-- ########## START: HEADER ########## -->
				<?php $this->load->view('_components/back/header'); ?>
			<!-- ########## END: HEADER ########## -->

			<!-- ########## START: CONTENT ########## -->
			<v-content>
				<?php
					$folder = $this->uri->segment(2);
				?>
				<?php $this->load->view('back/admin/' .$folder .'/' .$section); ?>
			</v-content>
			<!-- ########## END: CONTENT ########## -->
		</v-app>
	</div>
	<!-- ########## START: FOOTER ########## -->
	<?php $this->load->view('_components/back/footer'); ?>
	<!-- ########## END: FOOTER ########## -->
	</body>
</html>
