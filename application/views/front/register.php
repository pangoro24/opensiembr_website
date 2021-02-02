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
			<v-main>
				<v-container fluid fill-height>
					<v-layout align-center justify-center>
						<v-flex xs12 sm8 md4>
							<v-card class="elevation-6" :loading="loading">
								<v-toolbar color="green" dark flat>
									<v-toolbar-title>
										<v-btn href="<?= base_url('login') ?>" text icon dark>
										  <v-icon>mdi-arrow-left-circle</v-icon>
										</v-btn>
										Registro de Usuario
									</v-toolbar-title>
								</v-toolbar>
								<v-form v-on:submit.prevent="register">
									<v-card-text>
										<v-alert v-if="typeError === 'error'" type="error" class="transition-swing" transition="scale-transition" :value="showError"  dense outlined>
											{{ message }}
										</v-alert>
										<v-alert v-if="typeError === 'success'" type="success" class="transition-swing" transition="scale-transition" :value="showError"  dense outlined>
											{{ message }}
										</v-alert>
										<v-text-field class="mb-2" v-model="name" label="Nombre completo" type="text" outlined :hide-details="true"></v-text-field>
										<v-text-field class="mb-2" v-model="phone" label="Teléfono" type="number" outlined :hide-details="true"></v-text-field>
										<v-text-field class="mb-2" v-model="email" label="Correo electrónico" type="email" outlined :hide-details="true"></v-text-field>
										<v-text-field class="mb-2" v-model="password" label="Contraseña" type="password" outlined :hide-details="true"></v-text-field>
									</v-card-text>
									<v-card-actions>
										<v-spacer></v-spacer>
										<v-btn type="submit" dark>Registrarse</v-btn>
									</v-card-actions>
								</v-form>
							</v-card>
						</v-flex>
					</v-layout>
				</v-container>
			</v-main>
	    </v-app>
	</div>

	<script src="<?= base_url('/assets/back/app.js') ?> " type="text/javascript"></script>
	<link rel=stylesheet href=" <?= base_url('/assets/back/app.css') ?>">
</body>
</html>
