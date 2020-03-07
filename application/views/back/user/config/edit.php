<v-container>

	<v-row>
		<v-col cols="12">
			<v-skeleton-loader type="text" :loading="skeletonLoading" width="20%" transition="scale-transition">
				<p class="font-weight-bold headline mb-0"><?= $data['info']->fullname ?></p>
			</v-skeleton-loader>
			<v-skeleton-loader type="text" :loading="skeletonLoading" width="45%" transition="scale-transition">
				<p class="caption">Open Siembro</p>
			</v-skeleton-loader>
		</v-col>
	</v-row>


	<edit_user
		id_user="<?= $data['info']->id ?>"
		p-Fullname="<?= $data['info']->fullname ?>"
		p-Phone="<?= $data['info']->phone ?>"
		p-Email="<?= $data['info']->email ?>"
		p-Birth="<?= $data['info']->birth_date ?>"
		p-District="<?= $data['info']->district_id ?>"
		p-Address="<?= $data['info']->address ?>"
	/>

</v-container>
