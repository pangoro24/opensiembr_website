<v-row>
	<v-col cols="12" class="d-none d-sm-none d-md-flex">

		<v-toolbar :flat="true" class="header-menu">
		    <v-toolbar-title>
		    	<a href="<?= base_url('/') ?>" title="">
		    		<v-img width="190" src="/assets/img/logo.png" lazy-src="/assets/img/logo.png"></v-img>
		    	</a>
		    </v-toolbar-title>

		    <v-spacer></v-spacer>

		    <v-toolbar-items>
		        <v-btn text href="<?= base_url('/') ?>">Inicio</v-btn>
		        <v-btn text href="<?= base_url('device') ?>">Dispositivo</v-btn>
		        <v-btn text href="<?= base_url('app') ?>">App</v-btn>
		        <v-btn text href="<?= base_url('how-to-work') ?>">Como Funciona</v-btn>
		        <v-btn text href="<?= base_url('blog') ?>">Blog</v-btn>
		        <v-btn text href="<?= base_url('help') ?>">Ayuda</v-btn>
		    </v-toolbar-items>

		    <template v-if="$vuetify.breakpoint.smAndUp">

		    	<v-menu :close-on-content-click="false" :nudge-width="200" offset-y>
				    <template v-slot:activator="{ on }">
				        <v-btn icon v-on="on">
				            <v-icon>mdi-shopping</v-icon>
				        </v-btn>
				    </template>

				    <v-card>
				        <v-card-text>
				        	<p>Carrito de Compra</p>
				        </v-card-text>
				    </v-card>
				</v-menu>
		        
		        <v-menu :close-on-content-click="false" :nudge-width="200" offset-y>
				    <template v-slot:activator="{ on }">
				    	<v-btn icon v-on="on">
				            <v-icon>mdi-account-circle-outline</v-icon>
				        </v-btn>
				    </template>

				    <v-card>
				        <v-card-text>
				        	<p>INICIAR SESIÓN</p>
				        	<v-text-field label="Regular"></v-text-field>
				        	<v-text-field label="Regular"></v-text-field>
				        </v-card-text>
				    </v-card>
				</v-menu>

				<v-btn icon>
		            <v-icon>mdi-web</v-icon>
		        </v-btn>
		    </template>
		</v-toolbar>

	</v-col>

	<v-col class="d-flex d-sm-flex d-md-none" >
		<v-app-bar :flat="true" class="header-menu">
		    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

		    <v-toolbar-title>OpenSiembro</v-toolbar-title>

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