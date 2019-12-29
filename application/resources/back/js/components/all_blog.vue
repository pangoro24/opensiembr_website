<template>
    <div>
		<v-row>
            <v-col cols="12">
                <v-skeleton-loader type="table" :loading="this.$root.skeletonLoading" transition="scale-transition">
                    <v-card outlined elevation="4">
                        <v-card-title class="card-header">
                            <span class="body-1">Todos los Blogs Creadoss</span>
                        </v-card-title>
                            <v-data-table
                                :headers="headers"
                                :items="desserts"
                                :page.sync="page"
                                :items-per-page="itemsPerPage"
                                hide-default-footer
                                class="elevation-1"
                                @page-count="pageCount = $event">

								<template v-slot:item.body="{ item }">
									<span v-html="item.body.substring(0,190)"></span>
								</template>

                                <template v-slot:item.options="{ item }">

                                    <v-tooltip bottom>
                                        <template v-slot:activator="{ on }">
                                            <v-btn v-on="on" text icon color="warning">
                                                <v-icon small @click="edit(item.id)">
                                                    mdi-circle-edit-outline
                                                </v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Editar</span>
                                    </v-tooltip>

                                </template>
                            </v-data-table>
                    </v-card>
                </v-skeleton-loader>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-skeleton-loader type="chip" :loading="this.$root.skeletonLoading" transition="scale-transition">
                    <v-pagination v-model="page" :length="pageCount" ></v-pagination>
                </v-skeleton-loader>
            </v-col>
        </v-row>
	</div>
</template>

<script>
	import axios from 'axios';

    export default {
		data() {
            return {
                page: 1,
                headers: [
                    {
                        text: 'Nombre del post',
                        align: 'left',
                        sortable: false,
                        value: 'title',
                    },
                    { text: 'Descripcion', value: 'body' },
                    { text: 'Fecha', value: 'created_at' },
                    { text: 'Opciones', value: 'options', sortable: false },
                ],
                // BD
                pageCount: 0,
                itemsPerPage: 10,
                desserts: []
            }
        },
        mounted() {
            // Send axios new status theme
            axios.get(this.$root.base_url + 'blog/get')
            .then(res => {
            	const datos = res.data.data;
            	this.desserts = datos;
            })
            .catch(err => {
                console.error(err);
            })
        },
        methods: {
            edit: function (item)
            {
                location.href = '/admin/blog/edit/' + item;
            }
        },
    }
</script>

<style scoped>

</style>
