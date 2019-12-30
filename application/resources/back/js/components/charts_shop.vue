<script>
	import axios from 'axios';
	import {Line} from "vue-chartjs";

	export default {
		extends: Line,
		mounted() {
			// Send axios new status theme
            axios.get(this.$root.base_url + 'shop/orders_by_month')
            .then(res => {
            	const datos = res.data.data;
            	this.renderChart(
					{
						labels: [
								"Enero",
								"Febrero",
								"Marzo",
								"Abril",
								"Mayo",
								"Junio",
								"Julio",
								"Agosto",
								"Septiembre",
								"Octubre",
								"Noviembre",
								"Diciembre",

						],
						datasets: [
							{
								label: "Pedidos",
								data: [datos.enero, datos.febrero, datos.marzo, datos.abril, datos.marzo, datos.junio, datos.julio,datos.agosto,datos.septiembre,datos.octubre,datos.noviembre,datos.diciembre],
								backgroundColor: "transparent",
								borderColor: "rgba(1, 116, 188, 0.50)",
								pointBackgroundColor: "rgba(171, 71, 188, 1)"
							}
						]
					},
					{
						responsive: true,
						maintainAspectRatio: false,
						title: {
							display: true,
							text: "Tienda Online - Pedidos Mensuales"
						}
					}
				);
            })
            .catch(err => {
                console.error(err);
            });
		}
	}
</script>

<style scoped>

</style>
