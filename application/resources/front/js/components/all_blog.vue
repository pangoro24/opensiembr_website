<template>
    <div>
		<v-data-iterator :items="items" :items-per-page.sync="itemsPerPage" :footer-props="{ itemsPerPageOptions }">
			<template v-slot:default="props">
				<div v-for="item in props.items" :key="item.id">
					<v-card class="mb-5" color="#d6d6d6">
						<div class="d-flex flex-no-wrap">
							<v-avatar class="ma-3" size="125" tile>
								<v-img :src="'./assets/blog/' + item.images"></v-img>
							</v-avatar>
							<div>
								<v-card-title class="headline">{{item.title}}</v-card-title>

								<v-card-subtitle>
									{{ item.body.substring(0,190) }}...
								</v-card-subtitle>
								<v-card-actions>
									<v-btn small color="#4caf50" dark :href="'./blog/view/' + item.id">Ver Articulo</v-btn>
								</v-card-actions>
							</div>
						</div>
					</v-card>
				</div>
			</template>
		</v-data-iterator>
	</div>
</template>

<script>
	import axios from 'axios';

     export default {
        data() {
            return {
            	itemsPerPageOptions: [4, 8, 12],
      			itemsPerPage: 4,
                items: [],
            }
        },
		mounted() {
        	// Send axios new status theme
            axios.get(this.$root.base_url + 'blog/get')
            .then(res => {
            	console.log(res.data.data);
            	this.items = res.data.data;
            })
            .catch(err => {
                console.error(err);
            })
		},
		methods: {
            view: function (item)
            {
                location.href = '/blog/view/' + item;
            }
        },
    }
</script>

<style scoped>

</style>
