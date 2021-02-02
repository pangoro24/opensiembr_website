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
		<v-app class="body">
		    <v-main class="bg-soon text-center">
		        <v-container class="fill-height">
		        	<v-row>
		        		<v-col cols="12">
		        			<p class="display-2 font-weight-black">Open Siembro</p>
		        			<p class="title">Sistema inteligente de bajo costo para control de riego y monitoreo de siembro</p>
		        			<p>Estamos trabajando en nuestro sitio web y estará listo pronto. Suscríbete aquí para recibir notificaciones, boletines y <br> noticias acerca del proyecto.</p>
		        		</v-col>
		        		<v-col cols="12" md="4"></v-col>
		        		<v-col cols="12" md="4">
		        			<v-text-field :loading="loading" color="#fff" v-model="email" dark label="Ingrese su correo electrónico" outlined :append-outer-icon="'mdi-send'" @click:append-outer="sendMessage"></v-text-field>
		        			<v-alert :value="alert" dark transition="scale-transition" border="top" icon="mdi-menu-right" :color="type">{{ message }}</v-alert>
		        		</v-col>
		        		<v-col cols="12" md="4"></v-col>
		        		<v-col cols="12">
		        			<v-btn icon href="https://www.facebook.com/opensiembro-112360060188162/" target="_blank">
		        				<v-icon color="#fff">mdi-facebook</v-icon>
		        			</v-btn>
		        			<v-btn icon href="https://www.instagram.com/opensiembro/" target="_blank">
		        				<v-icon color="#fff">mdi-instagram</v-icon>
		        			</v-btn>
		        			<v-btn icon href="https://wa.me/50766865816" target="_blank">
		        				<v-icon color="#fff">mdi-whatsapp</v-icon>
		        			</v-btn>
		        		</v-col>
		        		<v-col cols="12">
		        			<p>© Open Siembro | Todos los Derechos Reservados 2019</p>
		        		</v-col>
		        	</v-row>
		        </v-container>
		    </v-main>
	    </v-app>
	</div>

	<script src="/assets/comming-soon/app.js" type="text/javascript"></script>
	<link rel=stylesheet href="/assets/comming-soon/app.css">
</body>
</html>
