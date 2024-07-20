<script>
	$(function () {
		<?php
		$puroks = [];
		$residents = [];
		$qry = mysqli_query($con, "SELECT resident_purok, COUNT(*) AS cnt FROM tblresident r GROUP BY r.resident_purok ");
		while ($row = mysqli_fetch_array($qry)) {
			array_push($puroks, ucwords(strtolower($row['resident_purok'])));
			array_push($residents, $row['cnt']);
		} ?>

		var areaChartCanvas = $('#purok').get(0).getContext('2d');
		var areaGradient = areaChartCanvas.createLinearGradient(0, 0, 0, 360); // it depends on the viewport height
		areaGradient.addColorStop(0, 'rgba(0,247,247,1)');
		areaGradient.addColorStop(1, 'rgba(0,247,247,0)');

		var areaChartData = {
			labels: <?php echo json_encode($puroks) ?>,
			datasets: [
				{
					label: ' Total Residents Living in this Purok',
					backgroundColor: areaGradient,
					borderColor: 'rgba(0,247,247,0.75)',
					borderWidth: 3,
					pointRadius: 5,
					pointBackgroundColor: 'rgb(255,255,255)',
					pointBorderColor: 'rgb(255,255,255)',
					pointBorderWidth: 0,
					pointHoverRadius: 7,
					pointHoverBackgroundColor: 'rgb(220,220,220)',
					pointHoverBorderColor: 'rgb(220,220,220)',
					data: <?php echo json_encode($residents) ?>
				}
			]
		};

		var areaChartOptions = {
			maintainAspectRatio: false,
			responsive: true,
			animation: {
				duration: 1500
			},
			legend: {
				display: false
			},
			tooltips: {
				enabled: true,
				bodyFontSize: 14,
				backgroundColor: 'rgba(50, 50, 50, 0.7)',
				bodyFontColor: 'white',
				titleFontColor: 'white',
			},
			scales: {
				xAxes: [{
					gridLines: {
						display: true,
						color: '#4f4f4f'
					},
					ticks: {
						fontColor: '#d6d6d6'
					}
				}],
				yAxes: [{
					gridLines: {
						display: true,
						color: '#4f4f4f'
					},
					ticks: {
						fontColor: '#d6d6d6',
						beginAtZero: true, // start y-axis from zero
						stepSize: false, // specify the step size for y-axis labels
						padding: 20
					}
				}]
			}
		};

		new Chart(areaChartCanvas, {
			type: 'line',
			data: areaChartData,
			options: areaChartOptions
		});
	});
</script>