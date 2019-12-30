<script>
	import axios from 'axios';
	import { Bar } from 'vue-chartjs';

    export default {
        extends: Bar,
		mounted () {
        	// Send axios new status theme
            axios.get(this.$root.base_url + 'user/get_by_month')
            .then(res => {
            	const datos = res.data.data;

            	// CHARTS js
				this.renderChart({
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
					  "Diciembre"
					],
					datasets: [
					  {
						label: "Usuarios por mes",
						backgroundColor: "#0e5d0a",
						data: [datos.enero, datos.febrero, datos.marzo, datos.abril, datos.marzo, datos.junio, datos.julio, datos.agosto, datos.septiembre, datos.octubre, datos.noviembre, datos.diciembre]
					  }
					]
				},
				{ responsive: true, maintainAspectRatio: false })

            })
            .catch(err => {
                console.error(err);
            });
		}
    }
</script>

<style scoped>

</style>
