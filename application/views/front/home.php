<v-content class="home-slider">
	<v-container>
		<?php $this->load->view('_components/front/header'); ?>
		<section class="text-center home-slider-content">
			<h1 data-aos="flip-up">Bienvenido a Open Siembro</h1>
			<p data-aos="flip-up">Sistema inteligente para control de riego y monitoreo de siembro</p>
			<v-btn data-aos="fade" class="mx-2" fab dark large color="red" @click="overlay = !overlay">
			  	<v-icon dark>mdi-play</v-icon>
			</v-btn>
			<section class="mt-8">
				<v-btn data-aos="flip-up" href="https://www.facebook.com/opensiembro-112360060188162/" target="blank" tile large color="#fff" icon>
					<v-icon>mdi-facebook</v-icon>
				</v-btn>
				<v-btn data-aos="flip-up" href="https://www.instagram.com/opensiembro/" target="blank" tile large color="#fff" icon>
					<v-icon>mdi-instagram</v-icon>
				</v-btn>
				<v-btn data-aos="flip-up" href="https://wa.me/50766865816" target="_blank" rel="noopener" tile large color="#fff" icon>
					<v-icon>mdi-whatsapp</v-icon>
				</v-btn>
			</section>
			<v-overlay :value="overlay">
				<v-btn icon @click="overlay = false">
					<v-icon>mdi-close</v-icon>
				</v-btn>
				<br> <br>
				<iframe width="560" height="315" src="https://www.youtube.com/watch?v=DgdaRYbsvUc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</v-overlay>
		</section>
	</v-container>
</v-content>

<v-content class="home-device" id="device">
	<v-container>
		<v-row class="text-center">
			<v-col cols="12">
				<h2 data-aos="fade-up" data-aos-once="true">NUESTRO DISPOSITIVO</h2>
			</v-col>
		</v-row>
		<v-row>
			<v-col cols="12">
				<v-img data-aos="fade-up" data-aos-once="true" class="app" width="100%" src="<?= base_url('assets/img/device-home.png') ?>">
			</v-col>
		</v-row>
	</v-container>
</v-content>

<v-content class="home-app" id="apps">
	<v-container>
		<v-row class="text-center">
			<v-col cols="12">
				<h2 data-aos="fade-up" data-aos-delay="200" data-aos-once="true">BENEFICIOS DEL SISTEMA OPEN SIEMBRO</h2>
			</v-col>
		</v-row>
		<v-row>
			<v-col cols="12" md="4">
				<v-hover v-slot:default="{ hover }">
					<div @mouseover="hoverTest(1)" @mouseleave="leaveTest(1)">
						<v-card :elevation="hover ? 6 : 2" class="mx-auto mb-3">
							<v-card-text class="text-right">
								<v-icon size="34" :color="hover ? 'blue': '' ">mdi-bullseye-arrow</v-icon>
								<h3 :class="hover ? 'blue--text' : '' ">Todo bajo control desde cualquier parte y en cualquier todo momento</h3>
							</v-card-text>
						</v-card>
					</div>
				</v-hover>
				<v-hover v-slot:default="{ hover }">
				    <v-card :elevation="hover ? 6 : 2" class="mx-auto mb-3" @mouseover="hoverTest(2)" @mouseleave="leaveTest(2)">
					    <v-card-text class="text-right">
					    	<v-icon size="34" :color="hover ? 'blue' : '' ">mdi-coin-outline</v-icon>
					    	<h3 :class="hover ? 'blue--text' : '' ">Precio accesible</h3>
					    </v-card-text>
				    </v-card>
				</v-hover>
				<v-hover v-slot:default="{ hover }">
				    <v-card :elevation="hover ? 6 : 2" class="mx-auto mb-3" @mouseover="hoverTest(3)" @mouseleave="leaveTest(3)">
					    <v-card-text class="text-right">
					    	<v-icon size="34" :color="hover ? 'blue' : '' ">mdi-buffer</v-icon>
					    	<h3 :class="hover ? 'blue--text' : '' ">Fácil y rápida instalación</h3>
					    </v-card-text>
				    </v-card>
				</v-hover>
				<v-hover v-slot:default="{ hover }">
				    <v-card :elevation="hover ? 6 : 2" class="mx-auto mb-3" @mouseover="hoverTest(4)" @mouseleave="leaveTest(4)">
					    <v-card-text class="text-right">
					    	<v-icon size="34" :color="hover ? 'blue' : '' ">mdi-cellphone-link</v-icon>
					    	<h3 :class="hover ? 'blue--text' : '' ">
								Adaptable. Puede funcionar con internet wifi, 3g o Sigfox dependiendo de la ubicación de tu cultivo.
							</h3>
					    </v-card-text>
				    </v-card>
				</v-hover>
			</v-col>
			<v-col cols="12" md="4">
				<div class="text-center">
					<v-img data-aos="fade-up" data-aos-delay="200" data-aos-once="true" class="app" width="320" :src="imagesApp">
				</div>
			</v-col>
			<v-col cols="12" md="4">
				<v-hover v-slot:default="{ hover }">
				    <v-card :elevation="hover ? 6 : 2" class="mx-auto mb-3" @mouseover="hoverTest(5)" @mouseleave="leaveTest(5)">
					    <v-card-text class="text-left">
					    	<v-icon size="34" :color="hover ? 'blue' : '' ">mdi-file-document-box-check-outline</v-icon>
					    	<h3 :class="hover ? 'blue--text' : '' ">
								Amplia información de diferentes tipos de plantas
							</h3>
					    </v-card-text>
				    </v-card>
				</v-hover>
				<v-hover v-slot:default="{ hover }">
				    <v-card :elevation="hover ? 6 : 2" class="mx-auto mb-3" @mouseover="hoverTest(6)" @mouseleave="leaveTest(6)">
					    <v-card-text class="text-left">
					    	<v-icon size="34" :color="hover ? 'blue' : '' ">mdi-numeric-0-circle-outline</v-icon>
					    	<h3 :class="hover ? 'blue--text' : '' ">100% Gratuita</h3>
					    </v-card-text>
				    </v-card>
				</v-hover>
				<v-hover v-slot:default="{ hover }">
				    <v-card :elevation="hover ? 6 : 2" class="mx-auto mb-3" @mouseover="hoverTest(7)" @mouseleave="leaveTest(7)">
					    <v-card-text class="text-left">
					    	<v-icon size="34" :color="hover ? 'blue' : '' ">mdi-gesture-spread</v-icon>
					    	<h3 :class="hover ? 'blue--text' : '' ">Intuitiva y amigable para el usuario</h3>
					    </v-card-text>
				    </v-card>
				</v-hover>
				<v-hover v-slot:default="{ hover }">
				    <v-card :elevation="hover ? 6 : 2" class="mx-auto mb-3" @mouseover="hoverTest(8)" @mouseleave="leaveTest(8)">
					    <v-card-text class="text-left">
					    	<v-icon size="34" :color="hover ? 'blue' : '' ">mdi-math-compass</v-icon>
					    	<h3 :class="hover ? 'blue--text' : '' ">
								Personalizable al tipo de cultivo que siembras y al sistema de riego que usas
							</h3>
					    </v-card-text>
				    </v-card>
				</v-hover>
			</v-col>
		</v-row>
	</v-container>
</v-content>

<v-content class="home-blog">
	<v-container>
		<v-row class="text-center">
			<v-col cols="12">
				<h2 data-aos="fade-up" data-aos-delay="200" data-aos-once="true">BLOG</h2>
			</v-col>
		</v-row>
		<v-row>

			<?php foreach ($blog as $last): ?>
				<v-col cols="12" md="4">
					<v-card data-aos="fade-up" data-aos-delay="200" data-aos-once="true" class="mx-auto" max-width="400">
						<v-img class="align-end" height="200px" src="<?= base_url('/assets/blog/' .$last->images) ?>">
						</v-img>

						<v-card-title><?= $last->title ?></v-card-title>

						<v-card-text class="text--primary">
							<p><?= strip_tags(character_limiter($last->body,120)); ?></p>
						</v-card-text>
						<v-divider></v-divider>
						<v-card-actions>
							<v-btn href="<?= base_url('/blog/view/' .$last->id) ?>" color="green" text>
								Ver
							</v-btn>
						</v-card-actions>
					</v-card>
				</v-col>
			<?php endforeach ?>

		</v-row>
	</v-container>
</v-content>

<v-content class="home-ask">
	<v-container>
		<v-row class="text-center">
			<v-col cols="12" class="mt-12 mb-8">
				<h1 data-aos="fade-up" data-aos-delay="200" data-aos-once="true">PREGUNTAS FRECUENTES</h1>
			</v-col>
		</v-row>
		<v-row>
			<v-col cols="8" offset-md="2">
				<v-expansion-panels data-aos="fade-up" data-aos-delay="200" data-aos-once="true">
				    <v-expansion-panel>
				        <v-expansion-panel-header>¿Qué realmente ofrecemos?</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            Ofrecemos un Sistema inteligente de bajo costo apoyado por una app como guía de agricultura, siembro, riego y  monitoreo.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
				    <v-expansion-panel>
				        <v-expansion-panel-header>¿Para quién es?</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            Nuestros clientes son agricultores de pequeña, mediana y grande escala y personas que desean incursionar en el sector agrícola sin previa experiencia.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
				    <v-expansion-panel>
				        <v-expansion-panel-header>¿Es la app totalmente gratuita?</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            Ofreceremos la app sin costo alguno con el fin de apoyar al agricultor para obtener un cultivo eficiente.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
				    <v-expansion-panel>
				        <v-expansion-panel-header>¿El dispositivo necesita internet para funcionar?</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            No propiamente. El dispositivo puede ejecutar sus tareas independiente de si está o no conectado al internet. El internet es uno de los medios para transmitir los datos a la app pero contamos con medios alternativos de transferencia de datos.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
				    <v-expansion-panel>
				        <v-expansion-panel-header>¿Tienen un local físico?</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            open Siembro es una tienda 100% online. Realizamos envíos a nivel nacional por medio de agencias de envíos.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
					<v-expansion-panel>
				        <v-expansion-panel-header>¿Dónde puedo comprar el dispositivo?</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            Puede obtener el dispositivo  por medio de nuestra página web y nos puede contactar a través de nuestro email, ventas@opensiembro.com y redes sociales.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
					<v-expansion-panel>
				        <v-expansion-panel-header>¿Cuáles son las formas de pago?</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            Trabajamos al contado por medio de depósito o transferencia bancaria.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
					<v-expansion-panel>
				        <v-expansion-panel-header>¿Cuáles son los medios de envíos?</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            Los medios de envíos son agencias de envío que laboran en Panamá, como Ferguson, Uno Express, Donaldo Guerra, etc. Pueden contactarnos para definir el mejor medio a su lugar de residencia.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
					<v-expansion-panel>
				        <v-expansion-panel-header>¿Cuál es el tiempo de entrega?</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            Una vez se confirma el pago, lo contactaremos para definir el tiempo de envío dependiendo de la cantidad de dispositivos solicitados.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
					<v-expansion-panel>
				        <v-expansion-panel-header>¿Aceptan devolución?</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            Se aceptan cambios por daños de fábrica y se envía un nuevo dispositivo.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
				</v-expansion-panels>
			</v-col>
		</v-row>
	</v-container>
</v-content>

<v-content class="home-contact" id="help">
	<v-container>
		<v-row class="text-center">
			<v-col cols="12" class="mt-12 mb-8">
				<h2 data-aos="fade-up" data-aos-delay="200" data-aos-once="true">CONTÁCTENOS</h2>
			</v-col>
		</v-row>
		<v-row class="text-center">
			<v-col cols="12" md="4" data-aos="fade-up" data-aos-delay="200" data-aos-once="true">
				<v-avatar color="#4caf50">
			      	<v-icon dark>mdi-home-variant</v-icon>
			    </v-avatar>
			    <p class="mt-3">Chitré, Panamá </p>
			</v-col>
			<v-col cols="12" md="4" data-aos="fade-up" data-aos-delay="400" data-aos-once="true">
				<v-avatar color="#4caf50">
			      	<v-icon dark>mdi-phone</v-icon>
			    </v-avatar>
			    <p class="mt-3">+507 6686-5816</p>
			</v-col>
			<v-col cols="12" md="4" data-aos="fade-up" data-aos-delay="600" data-aos-once="true">
				<v-avatar color="#4caf50">
			      	<v-icon dark>mdi-at</v-icon>
			    </v-avatar>
			    <p class="mt-3">info@opensiembro.com</p>
			</v-col>
		</v-row>
		<v-row>
			<v-col class="text-center mt-10" cols="12" md="6" data-aos="fade-up" data-aos-delay="200" data-aos-once="true">
				<h3 class="mb-3">Suscribete a nuestro boletín</h3>
				<v-text-field :hide-details="true" dark color="#fff" label="Ingrese su correo electrónico" outlined :append-outer-icon="'mdi-send'"></v-text-field>
				<br>
				<h3 class="mb-3 mt-5">Nuestras redes sociales</h3>
				<v-btn href="https://www.facebook.com/opensiembro-112360060188162/" target="blank" tile large color="#fff" icon>
			      	<v-icon>mdi-facebook</v-icon>
			    </v-btn>
			    <v-btn href="https://www.instagram.com/opensiembro/" target="blank" tile large color="#fff" icon>
			      	<v-icon>mdi-instagram</v-icon>
			    </v-btn>
			    <v-btn href="https://wa.me/50766865816" target="_blank" rel="noopener" tile large color="#fff" icon>
			      	<v-icon>mdi-whatsapp</v-icon>
			    </v-btn>
			</v-col>
			<v-col cols="12" md="6" data-aos="fade-up" data-aos-delay="200" data-aos-once="true">
				<v-text-field dark color="#fff" label="Nombre Completo"></v-text-field>
				<v-text-field dark color="#fff" label="Correo electrónico"></v-text-field>
				<v-text-field dark color="#fff" label="Asunto"></v-text-field>
				<v-textarea dark color="#fff" label="Mensaje"></v-textarea>
				<v-btn>Enviar</v-btn>
			</v-col>
		</v-row>
	</v-container>
</v-content>
