function chart(){
    var ctx = document.getElementById("linechart").getContext("2d");
		var data = {
			labels: [<?php while($b = mysqli_fetch_array($times)) { echo '"' . $b['id'] . '",'; } ?>],
			datasets: [
			{
				label: "DATA",
				fill: false,
				lineTension: 0.1,
				backgroundColor: "#29B0D0",
				borderColor: "#29B0D0",
				pointHoverBackgroundColor: "#29B0D0",
				pointHoverBorderColor: "#29B0D0",
				data: [<?php while($a = mysqli_fetch_array($datas)) { echo $a['data'] . ', '; } ?>]
			}
			]};

			var myBarChart = new Chart(ctx, {
				type: 'line',
				data: data,
				options: {
					legend: {
						display: true
					},
					barValueSpacing: 20,
					scales: {
						yAxes: [{
							ticks: {
								min: 0,
							}
						}],
						xAxes: [{
							gridLines: {
								color: "rgba(0, 0, 0, 0)",
							}
						}]
					}
				}
			});

			linechart.update({
				duration: 800,
				easing: 'easeOutBounce'
			});
}