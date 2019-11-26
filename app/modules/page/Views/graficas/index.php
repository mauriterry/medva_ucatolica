<div class="titulo-internas1" style="background-image:url(/skins/page/images/fondo1.jpg)">
    <div align="center"><h2>Graficas</h2></div>
</div>
<div id="charts">
		<div class="wrapper"><canvas id="chart-0"></canvas></div>
	</div>

	<script>
		var SAMPLE_INFO = {
			group: 'Charts',
			name: 'Line',
		};
	</script>

	<script id="script-construct">
		var chart = new Chart('chart-0', {
			type: 'line',
			data: {
				labels: labels,
				datasets: [{
					backgroundColor: Samples.color(0),
					borderColor: Samples.color(0),
					data: Samples.numbers({
						count: DATA_COUNT,
						min: 0,
						max: 100
					}),
					datalabels: {
						align: 'start',
						anchor: 'start'
					}
				}, {
					backgroundColor: Samples.color(1),
					borderColor: Samples.color(1),
					data: Samples.numbers({
						count: DATA_COUNT,
						min: 0,
						max: 100
					})
				}, {
					backgroundColor: Samples.color(2),
					borderColor: Samples.color(2),
					data: Samples.numbers({
						count: DATA_COUNT,
						min: 0,
						max: 100
					}),
					datalabels: {
						align: 'end',
						anchor: 'end'
					}
				}]
			},
			options: {
				plugins: {
					datalabels: {
						backgroundColor: function(context) {
							return context.dataset.backgroundColor;
						},
						borderRadius: 4,
						color: 'white',
						font: {
							weight: 'bold'
						},
						formatter: Math.round
					}
				},
				scales: {
					yAxes: [{
						stacked: true
					}]
				}
			}
		});
	</script>