<v-main class="header-blog-view">
	<v-container>
		<?php $this->load->view('_components/front/header'); ?>
	</v-container>
</v-main>

<v-main class="mt-12 mb-12">
	<v-container>
		<v-row>
			<v-col cols="12" md="8">
				<v-card class="mx-auto">
					<v-list-item three-line>
						<v-list-item-content>
							<v-list-item-title><h3><?= $blog->title ?></h3></v-list-item-title>
							<v-card-text>
								<p><?= $blog->body ?></p>
							</v-card-text>
						</v-list-item-content>
						<v-list-item-avatar tile size="250" color="grey">
							<v-img src="<?= base_url('assets/blog/' .$blog->images) ?>"></v-img>
						</v-list-item-avatar>
					</v-list-item>
					<v-card-actions>
						<v-spacer></v-spacer>
							<div class="sharethis-inline-share-buttons"></div>
					</v-card-actions>
				</v-card>
			</v-col>
			<v-col cols="12" md="4">

				<v-card class="mx-auto mt-5" max-width="344" outlined data-aos="fade-up" data-aos-delay="200">
					<v-list-item three-line>
						<v-list-item-content>
							<v-list-item-title class="headline mb-1">Post Recientes</v-list-item-title>
							<v-list-item>
								<v-list-item-content>
									<?php foreach ($last_blog as $last): ?>
										<v-list-item-title>
											<a href="<?= base_url('/blog/view/' .$last->id) ?>">
												- <?= $last->title; ?>
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
								<?php
									$tags = $blog->tag;
									$fruits_ar = explode(',', $tags);

									foreach ($fruits_ar as $tag):
								?>
									<v-chip class="ma-2" color="green" text-color="white"><?= $tag ?></v-chip>
								<?php endforeach ?>
							</div>
						</v-list-item-content>
					</v-list-item>
				</v-card>
			</v-col>
		</v-row>
	</v-container>
</v-main>
