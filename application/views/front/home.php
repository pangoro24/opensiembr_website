<v-content class="home-slider">
	<v-container>
		<?php $this->load->view('_components/front/header'); ?>
	</v-container>
</v-content>

<v-content class="home-device">
	<v-container>
		<v-row class="text-center">
			<v-col cols="12">
				<h2>DISPOSITIVO</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
			</v-col>
		</v-row>
		<v-row>
			<v-col cols="12">
				
			</v-col>
		</v-row>
	</v-container>
</v-content>

<v-content class="home-app">
	<v-container>
		<v-row class="text-center">
			<v-col cols="12">
				<h2>APLICACIÓN MÓVIL</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
			</v-col>
		</v-row>
		<v-row>
			<v-col cols="12" md="4">
				<v-hover v-slot:default="{ hover }">
				    <v-card :elevation="hover ? 6 : 2" class="mx-auto mb-3">
					    <v-card-text class="text-right">
					    	<v-icon size="34" :color="hover ? 'blue' : '' ">mdi-anchor</v-icon>
					    	<h3 :class="hover ? 'blue--text' : '' ">Title Card</h3>
					    	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					        	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					        	quis nostrud exercitation ullamco laboris nisi</p>
					    </v-card-text>
				    </v-card>
				</v-hover>
				<v-hover v-slot:default="{ hover }">
				    <v-card :elevation="hover ? 6 : 2" class="mx-auto mb-3">
					    <v-card-text class="text-right">
					    	<v-icon size="34" :color="hover ? 'blue' : '' ">mdi-anchor</v-icon>
					    	<h3 :class="hover ? 'blue--text' : '' ">Title Card</h3>
					    	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					        	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					        	quis nostrud exercitation ullamco laboris nisi</p>
					    </v-card-text>
				    </v-card>
				</v-hover>
				<v-hover v-slot:default="{ hover }">
				    <v-card :elevation="hover ? 6 : 2" class="mx-auto mb-3">
					    <v-card-text class="text-right">
					    	<v-icon size="34" :color="hover ? 'blue' : '' ">mdi-anchor</v-icon>
					    	<h3 :class="hover ? 'blue--text' : '' ">Title Card</h3>
					    	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					        	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					        	quis nostrud exercitation ullamco laboris nisi</p>
					    </v-card-text>
				    </v-card>
				</v-hover>
			</v-col>
			<v-col cols="12" md="4" class="text-center">
				2
			</v-col>
			<v-col cols="12" md="4">
				<v-hover v-slot:default="{ hover }">
				    <v-card :elevation="hover ? 6 : 2" class="mx-auto mb-3">
					    <v-card-text class="text-right">
					    	<v-icon size="34" :color="hover ? 'blue' : '' ">mdi-anchor</v-icon>
					    	<h3 :class="hover ? 'blue--text' : '' ">Title Card</h3>
					    	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					        	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					        	quis nostrud exercitation ullamco laboris nisi</p>
					    </v-card-text>
				    </v-card>
				</v-hover>
				<v-hover v-slot:default="{ hover }">
				    <v-card :elevation="hover ? 6 : 2" class="mx-auto mb-3">
					    <v-card-text class="text-right">
					    	<v-icon size="34" :color="hover ? 'blue' : '' ">mdi-anchor</v-icon>
					    	<h3 :class="hover ? 'blue--text' : '' ">Title Card</h3>
					    	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					        	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					        	quis nostrud exercitation ullamco laboris nisi</p>
					    </v-card-text>
				    </v-card>
				</v-hover>
				<v-hover v-slot:default="{ hover }">
				    <v-card :elevation="hover ? 6 : 2" class="mx-auto mb-3">
					    <v-card-text class="text-right">
					    	<v-icon size="34" :color="hover ? 'blue' : '' ">mdi-anchor</v-icon>
					    	<h3 :class="hover ? 'blue--text' : '' ">Title Card</h3>
					    	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					        	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					        	quis nostrud exercitation ullamco laboris nisi</p>
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
				<h2>BLOG</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
			</v-col>
		</v-row>
		<v-row>
			<v-col cols="12" md="4">
				<v-card class="mx-auto" max-width="400">
				    <v-img class="white--text align-end" height="200px" src="https://cdn.vuetifyjs.com/images/cards/docks.jpg">
				        <v-card-title>Top 10 Australian beaches</v-card-title>
				    </v-img>

				    <v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

				    <v-card-text class="text--primary">
				        <div>Whitehaven Beach</div>

				        <div>Whitsunday Island, Whitsunday Islands</div>
				    </v-card-text>

				    <v-card-actions>
				        <v-btn color="orange" text>
				            Share
				        </v-btn>

				        <v-btn color="orange" text>
				            Explore
				        </v-btn>
				    </v-card-actions>
				</v-card>
			</v-col>
			<v-col cols="12" md="4">
				<v-card class="mx-auto" max-width="400">
				    <v-img class="white--text align-end" height="200px" src="https://cdn.vuetifyjs.com/images/cards/docks.jpg">
				        <v-card-title>Top 10 Australian beaches</v-card-title>
				    </v-img>

				    <v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

				    <v-card-text class="text--primary">
				        <div>Whitehaven Beach</div>

				        <div>Whitsunday Island, Whitsunday Islands</div>
				    </v-card-text>

				    <v-card-actions>
				        <v-btn color="orange" text>
				            Share
				        </v-btn>

				        <v-btn color="orange" text>
				            Explore
				        </v-btn>
				    </v-card-actions>
				</v-card>
			</v-col>
			<v-col cols="12" md="4">
				<v-card class="mx-auto" max-width="400">
				    <v-img class="white--text align-end" height="200px" src="https://cdn.vuetifyjs.com/images/cards/docks.jpg">
				        <v-card-title>Top 10 Australian beaches</v-card-title>
				    </v-img>

				    <v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

				    <v-card-text class="text--primary">
				        <div>Whitehaven Beach</div>

				        <div>Whitsunday Island, Whitsunday Islands</div>
				    </v-card-text>

				    <v-card-actions>
				        <v-btn color="orange" text>
				            Share
				        </v-btn>

				        <v-btn color="orange" text>
				            Explore
				        </v-btn>
				    </v-card-actions>
				</v-card>
			</v-col>
		</v-row>
	</v-container>
</v-content>

<v-content class="home-ask">
	<v-container>
		<v-row class="text-center">
			<v-col cols="12">
				<h2>PREGUNTAS FRECUENTES</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
			</v-col>
		</v-row>
		<v-row>
			<v-col cols="12">
				<v-expansion-panels>
				    <v-expansion-panel>
				        <v-expansion-panel-header>Item</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
				    <v-expansion-panel>
				        <v-expansion-panel-header>Item</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
				    <v-expansion-panel>
				        <v-expansion-panel-header>Item</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
				    <v-expansion-panel>
				        <v-expansion-panel-header>Item</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
				    <v-expansion-panel>
				        <v-expansion-panel-header>Item</v-expansion-panel-header>
				        <v-expansion-panel-content>
				            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				        </v-expansion-panel-content>
				    </v-expansion-panel>
				</v-expansion-panels>
			</v-col>
		</v-row>
	</v-container>	
</v-content>

<v-content class="home-newsletter">
	<v-container class="pa-0">
		<v-row class="text-center">
			<v-col cols="12" md="6">
				<h3 class="mb-3">Suscribete a nuestro boletín</h3>
				<v-text-field :hide-details="true" label="Ingrese su correo electrónico" outlined :append-outer-icon="'mdi-send'"></v-text-field>
			</v-col>
			<v-col cols="12" md="6">
				<h3 class="mb-3">Nuestras redes sociales</h3>
				<v-btn href="https://www.facebook.com/opensiembro-112360060188162/" target="blank" tile large color="#000" icon>
			      	<v-icon>mdi-facebook</v-icon>
			    </v-btn>
			    <v-btn href="https://www.instagram.com/opensiembro/" target="blank" tile large color="#000" icon>
			      	<v-icon>mdi-instagram</v-icon>
			    </v-btn>
			    <v-btn href="" tile large color="#000" icon>
			      	<v-icon>mdi-whatsapp</v-icon>
			    </v-btn>
			</v-col>
		</v-row>
	</v-container>
</v-content>

<v-content class="home-contact">
	<v-container>
		<v-row class="text-center">
			<v-col cols="12">
				<h2>CONTÁCTENOS</h2>
			</v-col>
		</v-row>
		<v-row class="text-center">
			<v-col cols="12" md="4">
				<v-avatar color="indigo">
			      	<v-icon dark>mdi-home-variant</v-icon>
			    </v-avatar>
			    <p class="mt-3">Panamá, Herrera, Chitré, Calle </p>
			</v-col>
			<v-col cols="12" md="4">
				<v-avatar color="indigo">
			      	<v-icon dark>mdi-phone</v-icon>
			    </v-avatar>
			    <p class="mt-3">+507 6XXX-XXXX</p>
			</v-col>
			<v-col cols="12" md="4">
				<v-avatar color="indigo">
			      	<v-icon dark>mdi-at</v-icon>
			    </v-avatar>
			    <p class="mt-3">info@opensiembro.com</p>
			</v-col>
		</v-row>
		<v-row>
			<v-col cols="12" md="6">
				<h3>Open Siembro</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua.</p>
				<v-btn color="#fff" outlined fab x-small dark>
	              	<v-icon size="12" dark>mdi-facebook</v-icon>
	            </v-btn>
	            <v-btn color="#fff" outlined fab x-small dark>
	              	<v-icon size="12" dark>mdi-twitter</v-icon>
	            </v-btn>
	            <v-btn color="#fff" outlined fab x-small dark>
	              	<v-icon size="12" dark>mdi-instagram</v-icon>
	            </v-btn>
	            <v-btn color="#fff" outlined fab x-small dark>
	              	<v-icon size="12" dark>mdi-whatsapp</v-icon>
	            </v-btn>
			</v-col>
			<v-col cols="12" md="6">
				<v-text-field dark color="#fff" label="Nombre Completo"></v-text-field>
				<v-text-field dark color="#fff" label="Correo electrónico"></v-text-field>
				<v-text-field dark color="#fff" label="Asunto"></v-text-field>
				<v-textarea dark color="#fff" label="Mensaje"></v-textarea>
				<v-btn>Enviar</v-btn>
			</v-col>
		</v-row>
	</v-container>
</v-content>