<script>
	import axios from 'axios';
	import { Line } from 'vue-chartjs';

    export default {
        extends: Line,
		mounted () {
        	// Send axios new status theme
            axios.get(this.$root.base_url + 'user/get_by_month')
            .then(res => {
            	const datos = res.data.data;

            	// CHARTS js
				this.renderChart({
					labels: [
					  "Dato1",
					  "Dato2",
					  "Dato3",
					  "Dato4",
					  "Dato5"
					],
					datasets: [
						{
							label: "Estadistica de la zona",
							data: [25, 12, 45, 2, 25],
							backgroundColor: "transparent",
							borderColor: "rgba(1, 116, 188, 0.50)",
							pointBackgroundColor: "rgba(171, 71, 188, 1)"
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
