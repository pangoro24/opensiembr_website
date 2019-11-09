<v-row>
	<v-col cols="12" class="d-none d-sm-none d-md-flex">

		<v-toolbar :flat="true" dark class="header-menu">
		    <v-toolbar-title>
		    	<a href="<?= base_url('/') ?>" title="">
		    		<v-img width="190" src="/assets/img/logo.png" lazy-src="/assets/img/logo.png"></v-img>
		    	</a>
		    </v-toolbar-title>

		    <v-spacer></v-spacer>

		    <v-toolbar-items>
		        <v-btn text class="font-weight-bold" href="<?= base_url('/') ?>">Inicio</v-btn>
		        <v-btn text class="font-weight-bold" v-scroll-to="'#device'" href="<?= base_url('#') ?>">Dispositivo</v-btn>
		        <v-btn text class="font-weight-bold" v-scroll-to="'#apps'" href="<?= base_url('#') ?>">App</v-btn>
		        <v-btn text class="font-weight-bold" href="<?= base_url('how-to-work') ?>">Como Funciona</v-btn>
		        <v-btn text class="font-weight-bold" href="<?= base_url('blog') ?>">Blog</v-btn>
		        <v-btn text class="font-weight-bold" v-scroll-to="'#help'" href="<?= base_url('#') ?>">Ayuda</v-btn>
		    </v-toolbar-items>

		    <template v-if="$vuetify.breakpoint.smAndUp">

		    	<v-menu :close-on-content-click="false" :nudge-width="200" offset-y open-on-hover transition="slide-x-transition">
				    <template v-slot:activator="{ on }">
				        <v-btn icon v-on="on">
				            <v-icon>mdi-shopping</v-icon>
				        </v-btn>
				    </template>

				    <v-card>
				        <v-card-text>
				        	<p>El carrito esta vacio</p>
				        </v-card-text>
				    </v-card>
				</v-menu>
		        
		        <v-menu :close-on-content-click="false" :nudge-width="200" offset-y transition="slide-x-transition">
				    <template v-slot:activator="{ on }">
				    	<v-btn icon v-on="on">
				            <v-icon>mdi-account-circle-outline</v-icon>
				        </v-btn>
				    </template>

				    <v-card>
				        <v-card-text>
				        	<p>INICIAR SESIÓN</p>
				        	<v-text-field class="mb-2" solo prepend-inner-icon="mdi-account-circle-outline" label="Correo Electrónico" hide-details="true"></v-text-field>
				        	<v-text-field class="mb-2" solo prepend-inner-icon="mdi-lock-open-outline" label="Contraseña" hide-details="true"></v-text-field>
				        	<v-btn small color="primary">Iniciar Sesión</v-btn>
				        	<v-btn small color="primary">Registrarse</v-btn>
				        </v-card-text>
				    </v-card>
				</v-menu>

				<v-menu :close-on-content-click="false" :nudge-width="200" offset-y transition="slide-x-transition">
				    <template v-slot:activator="{ on }">
				    	<v-btn icon v-on="on">
				            <v-icon>mdi-web</v-icon>
				        </v-btn>
				    </template>

				    <v-card>
				        <v-card-text>
				        	<p class="mb-0">Idioma</p>
				        	<v-select prepend-inner-icon="mdi-translate" solo hide-details="true"></v-select>
				        	<p class="mb-0">Moneda</p>
				        	<v-select prepend-inner-icon="mdi-coin-outline" solo hide-details="true"></v-select>
				        </v-card-text>
				    </v-card>
				</v-menu>

		    </template>
		</v-toolbar>

	</v-col>

	<v-col class="d-flex d-sm-flex d-md-none" >
		<v-app-bar :flat="true" dark class="header-menu">
		    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

		    <v-toolbar-title>Open Siembro</v-toolbar-title>

		    <v-spacer></v-spacer>

		    <v-menu left bottom>
		        <template v-slot:activator="{ on }">
		            <v-btn icon v-on="on">
		                <v-icon>mdi-dots-vertical</v-icon>
		            </v-btn>
		        </template>

		        <v-list>
		            <v-list-item v-for="n in 5" :key="n" @click="() => {}">
		                <v-list-item-title>Option {{ n }}</v-list-item-title>
		            </v-list-item>
		        </v-list>
		    </v-menu>
		</v-app-bar>
	</v-col>
</v-row>
