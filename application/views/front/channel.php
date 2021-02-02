<v-main class="header-channel">
	<v-container>
		<?php $this->load->view('_components/front/header'); ?>
	</v-container>
</v-main>

<v-main class="mt-12 mb-12">
	<v-container>
		<v-row>
			<?php foreach ($zones as $last): ?>
				<v-col cols="4">
					<v-lazy
						v-model="isActive"
						:options="{
						  threshold: .5
						}"
						min-height="200"
						transition="fade-transition"
					>
						<v-card max-width="344" class="mx-auto">
							<v-list-item>
								<v-list-item-avatar color="grey">
									<v-img class="elevation-6" src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"></v-img>
								</v-list-item-avatar>
								<v-list-item-content>
									<v-list-item-title class="headline"><?= $last->fullname ?></v-list-item-title>
									<v-list-item-subtitle><?= $last->email ?></v-list-item-subtitle>
								</v-list-item-content>
							</v-list-item>

							<v-img src="<?= base_url('assets/img/' .$last->photo_url) ?>" height="194"></v-img>

							<v-card-text>
								<?= $last->description ?>
							</v-card-text>

							<v-card-actions>
								<v-btn href="<?= base_url('channel/view/' .$last->id) ?>" text color="green accent-4">
									Visitar
								</v-btn>
							</v-card-actions>
						</v-card>
					</v-lazy>
				</v-col>
			<?php endforeach ?>
		</v-row>
	</v-container>
</v-main>

