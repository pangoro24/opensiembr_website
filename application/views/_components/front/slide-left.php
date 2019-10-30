<v-navigation-drawer v-model="drawer" absolute temporary>
    <v-list-item>
        <v-list-item-avatar>
            <v-img src="https://randomuser.me/api/portraits/men/78.jpg"></v-img>
        </v-list-item-avatar>

        <v-list-item-content>
            <v-list-item-title>John Leider</v-list-item-title>
        </v-list-item-content>
    </v-list-item>

    <v-divider></v-divider>

    <v-list dense>

        <v-list-item href="<?= base_url('/') ?>" link>
            <v-list-item-icon>
                <v-icon>mdi-home</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
                <v-list-item-title>Inicio</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-list-item href="<?= base_url('device') ?>" link>
            <v-list-item-icon>
                <v-icon>mdi-cellphone-wireless</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
                <v-list-item-title>Dispositivo</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-list-item href="<?= base_url('app') ?>" link>
            <v-list-item-icon>
                <v-icon>mdi-airplay</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
                <v-list-item-title>App</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-list-item href="<?= base_url('how-to-work') ?>" link>
            <v-list-item-icon>
                <v-icon>mdi-console-network-outline</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
                <v-list-item-title>Como Funciona</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-list-item href="<?= base_url('blog') ?>" link>
            <v-list-item-icon>
                <v-icon>mdi-post</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
                <v-list-item-title>Blog</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-list-item href="<?= base_url('help') ?>" link>
            <v-list-item-icon>
                <v-icon>mdi-lifebuoy</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
                <v-list-item-title>Ayuda</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

        <v-list-item href="<?= base_url('login') ?>" link>
            <v-list-item-icon>
                <v-icon>mdi-login-variant</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
                <v-list-item-title>Iniciar Sesión</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-list-item href="<?= base_url('register') ?>" link>
            <v-list-item-icon>
                <v-icon>mdi-account-plus-outline</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
                <v-list-item-title>Registrarse</v-list-item-title>
            </v-list-item-content>
        </v-list-item>


    </v-list>
</v-navigation-drawer>