<template>
    <div>
		<v-row>
            <v-col cols="12">
                <v-skeleton-loader type="table" :loading="this.$root.skeletonLoading" transition="scale-transition">
                    <v-card outlined elevation="4">
                        <v-card-title class="card-header">
                            <span class="body-1">Todas las ordenes generadas</span>
                        </v-card-title>
                            <v-data-table
                                :headers="headers"
                                :items="desserts"
                                :page.sync="page"
                                :items-per-page="itemsPerPage"
                                hide-default-footer
                                class="elevation-1"
								item-key="id_order"
                                @page-count="pageCount = $event">

                                <template v-slot:item.options="{ item }">

                                    <v-tooltip bottom>
                                        <template v-slot:activator="{ on }">
                                            <v-btn v-on="on" text icon color="warning">
                                                <v-icon small @click="edit(item.id_order)">
                                                    mdi-eye-outline
                                                </v-icon>
                                            </v-btn>
                                        </template>
                                        <span>Ver</span>
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
                        text: 'Nombre del Cliente',
                        align: 'left',
                        sortable: false,
                        value: 'client_name',
                    },
                    { text: 'Email', value: 'email' },
                    { text: 'Teléfono', value: 'phone' },
					{ text: 'Producto', value: 'name' },
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
            axios.get(this.$root.base_url + 'shop/get_orders')
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
                location.href = '/admin/shop/view_orders/' + item;
            }
        },
    }
</script>

<style scoped>

</style>
