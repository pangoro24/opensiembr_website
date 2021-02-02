<v-main class="header-channel">
	<v-container>
		<?php $this->load->view('_components/front/header'); ?>
	</v-container>
</v-main>

<v-main>
	<v-container>
		<v-row>
			<v-col cols="8">
				<h3><?= $zone->fullname ?></h3>
				<h5><?= $zone->email ?></h5>
				<p><?= $zone->name ?></p>
				<p><?= $zone->description ?></p>
				<channel_chart></channel_chart>
			</v-col>
			<v-col cols="4">
				<v-carousel height="200">
					<v-carousel-item
						src="<?= base_url('assets/img/' .$zone->photo_url) ?>"
						reverse-transition="fade-transition"
						transition="fade-transition"
					></v-carousel-item>
				</v-carousel>
			</v-col>
		</v-row>
	</v-container>
</v-main>
