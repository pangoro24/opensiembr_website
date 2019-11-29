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
		<v-app id="inspire" class="body">
			<v-content>
				<v-container fluid fill-height>
					<v-layout align-center justify-center>
						<v-flex xs12 sm8 md4>
							<v-card class="elevation-6 text-center" :loading="loading">
								<v-toolbar color="green" dark flat>
									<v-toolbar-title>Iniciar Sesión</v-toolbar-title>
								</v-toolbar>
								<v-form v-on:submit.prevent="login">
									<v-card-text>
										<v-alert type="error" class="transition-swing" transition="scale-transition" :value="showError"  dense outlined>
											{{ message }}
										</v-alert>
										<v-text-field label="Correo electrónico o teléfono" v-model="emailPhone" type="text" prepend-inner-icon="mdi-at" outlined></v-text-field>
										<v-text-field label="Contraseña" type="password" v-model="password" prepend-inner-icon="mdi-lock-outline"  outlined></v-text-field>
									</v-card-text>
									<v-card-actions>
										<v-spacer></v-spacer>
										<v-btn type="submit" dark color="green">Iniciar Sesión</v-btn>
										<v-btn type="button" href="<?= base_url('register') ?>" dark>Registrarse</v-btn>
									</v-card-actions>
								</v-form>
							</v-card>
						</v-flex>
					</v-layout>
				</v-container>
			</v-content>
	    </v-app>
	</div>

	<script src="<?= base_url('/assets/back/app.js') ?> " type="text/javascript"></script>
	<link rel=stylesheet href=" <?= base_url('/assets/back/app.css') ?>">
</body>
</html>
