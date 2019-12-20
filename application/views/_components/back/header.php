<v-app-bar app clipped-left color="#025f02" dense>
	<v-app-bar-nav-icon color="#fff" @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
	<a class="mt-1" href="<?= base_url('admin/dashboard'); ?>" title="Open Sembro">
		<v-img width="150" src="<?= base_url('assets/img/logo-white.png') ?>"></v-img>
	</a>
	<v-spacer></v-spacer>

	<v-menu bottom :offset-y="true">
		<template v-slot:activator="{ on }">
			<v-btn dark icon v-on="on">
				<v-skeleton-loader type="avatar" :loading="loading" transition="scale-transition">
					<v-avatar size="35">
						<v-icon dark>mdi-account-circle</v-icon>
					</v-avatar>
				</v-skeleton-loader>
			</v-btn>
		</template>

		<v-list width="300">
			<v-list-item>
				<v-list-item-avatar>
					<v-avatar size="35">
						<v-icon>mdi-account-circle</v-icon>
					</v-avatar>
				</v-list-item-avatar>

				<v-list-item-content>
					<v-list-item-title> <?= $data['info']->fullname ?> </v-list-item-title>
					<v-list-item-subtitle><?= $data['rol']->name ?></v-list-item-subtitle>
				</v-list-item-content>
			</v-list-item>
		</v-list>
		<v-divider></v-divider>


		<v-list nav dense>
			<v-list-item href="<?= base_url($this->uri->segment(1) .'/config/edit') ?>">
				<v-list-item-icon>
					<v-icon color="#17A2B8">mdi-settings-transfer-outline</v-icon>
				</v-list-item-icon>

				<v-list-item-content>
					<v-list-item-title>Configuración</v-list-item-title>
				</v-list-item-content>
			</v-list-item>

			<v-list-item href="<?= base_url('logout'); ?>">
				<v-list-item-icon>
					<v-icon color="#17A2B8">mdi-location-exit</v-icon>
				</v-list-item-icon>

				<v-list-item-content>
					<v-list-item-title>Cerrar Sesión</v-list-item-title>
				</v-list-item-content>
			</v-list-item>
		</v-list>

	</v-menu>

</v-app-bar>
