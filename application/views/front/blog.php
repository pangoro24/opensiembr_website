<v-content class="header-blog">
	<v-container>
		<?php $this->load->view('_components/front/header'); ?>
	</v-container>
</v-content>

<v-content class="mt-12 mb-12">
	<v-container>
		<v-row>
			<v-col cols="12" md="8">
				<v-card class="mx-auto">
				    <v-container>
						<all_blog></all_blog>
				    </v-container>
				</v-card>
			</v-col>
			<v-col cols="12" md="4">

				<v-card class="mx-auto" max-width="344" outlined data-aos="fade-up" data-aos-delay="200">
				    <v-list-item>
				        <v-list-item-content>
				            <v-text-field label="Buscar artículo" filled rounded dense></v-text-field>
				            <v-btn small>Buscar artículo</v-btn>
				        </v-list-item-content>
				    </v-list-item>
				</v-card>
				
				<v-card class="mx-auto mt-5" max-width="344" outlined data-aos="fade-up" data-aos-delay="200">
				    <v-list-item three-line>
				        <v-list-item-content>
				            <v-list-item-title class="headline mb-1">Post Recientes</v-list-item-title>
				            <v-list-item>
						      	<v-list-item-content>
									<?php foreach ($all_blog as $last): ?>
										<v-list-item-title>
											<a href="<?= base_url('/blog/view/' .$last->id) ?>">
												- <?= $last->title ?>
											</a>
										</v-list-item-title>
									<?php endforeach ?>
						      	</v-list-item-content>
						    </v-list-item>
				        </v-list-item-content>
				    </v-list-item>
				</v-card>

				<v-card class="mx-auto mt-5" max-width="344" outlined data-aos="fade-up" data-aos-delay="200">
				    <v-list-item three-line>
				        <v-list-item-content>
				            <v-list-item-title class="headline mb-1">Tag</v-list-item-title>
				            <div id="chip-usage-example" class="text-center">
								<?php foreach ($all_tag as $tag): ?>
				            		<v-chip class="ma-2" color="green" text-color="white"><?= $tag ?></v-chip>
								<?php endforeach ?>
				            </div>
				        </v-list-item-content>
				    </v-list-item>
				</v-card>
			</v-col>
		</v-row>
	</v-container>
</v-content>

