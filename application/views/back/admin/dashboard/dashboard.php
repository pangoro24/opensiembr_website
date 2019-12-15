<v-container class="pa-5">
	<v-row>
		<v-col cols="12">
			<v-skeleton-loader type="text" :loading="skeletonLoading" width="20%" transition="scale-transition">
				<p class="font-weight-bold headline mb-0">Dashboard </p>
			</v-skeleton-loader>
			<v-skeleton-loader type="text" :loading="skeletonLoading" width="45%" transition="scale-transition">
				<p class="caption">Bienvenido a la plataforma de Open Siembro.</p>
			</v-skeleton-loader>
		</v-col>
	</v-row>
	<v-row>
		<v-col cols="12" class="col-md-8">
			<h5>Reportes</h5>
		</v-col>
		<v-col cols="12" class="col-md-4">
			<v-skeleton-loader type="list-item-avatar-three-line" :loading="skeletonLoading" transition="scale-transition">
				<v-card>
					<v-card-text>
						<div><h5>Mis Ultimos Post</h5></div>
						<v-list three-line>
							<?php foreach ($all_blogs as $blog): ?>
								<template>
									<v-list-item @click="">
										<v-list-item-avatar>
											<v-icon>mdi-account-circle</v-icon>
										</v-list-item-avatar>

										<v-list-item-content>
											<v-list-item-title><?= $blog->title ?></v-list-item-title>
											<v-list-item-subtitle><?= strip_tags(character_limiter($blog->body,50)); ?></v-list-item-subtitle>
										</v-list-item-content>
									</v-list-item>
								</template>
							<?php endforeach ?>
						</v-list>
					</v-card-text>
				</v-card>
			</v-skeleton-loader>
		</v-col>
	</v-row>
</v-container>
