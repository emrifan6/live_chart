<?php 
include 'dbh.php';
$sql = "SELECT * FROM data";
$times = $conn->query($sql);
$datas = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script src="js/Chart.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<title>Ajax Chart</title>
</head>
<body>

	<div class="container">
		<div class="chart-container" style="position: relative; height:40vh; width:80vw">
			<canvas id="linechart"></canvas>
		</div>
	</div>
	<!-- <button type="button" onclick="adddata()">Add Data</button> -->

	<script type="text/javascript">
		var ctx = document.getElementById("linechart").getContext("2d");
		var data = {
			labels: [<?php while($b = mysqli_fetch_array($times)) { echo '"' . $b['time'] . '",'; } ?>],
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
							ticks: {
								/*Precisa autoSkip pra nao aparecer muitas informacoes*/
								autoSkip: true,
								maxRotation: 45,
								minRotation: 45,
								maxTicksLimit: 15,
							},
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
		</script>


		<script type="text/javascript"> 
			<?php  
			$sqlpush = "SELECT * FROM data ORDER BY id DESC LIMIT 1";
			$pushdata = mysqli_query($conn, $sqlpush);
			$pushtime = mysqli_query($conn, $sqlpush);
			while($a = mysqli_fetch_array($pushtime)) { $llabel = $a['id'];}
			while($b = mysqli_fetch_array($pushdata)) { $ldata = $b['data'];}
			?>
			var tmp = <?php echo $llabel; ?>;;
		</script>

		<div id="comments">
			<?php  
			$sqlpush = "SELECT * FROM data ORDER BY id DESC LIMIT 1";
			$pushdata = mysqli_query($conn, $sqlpush);
			$pushtime = mysqli_query($conn, $sqlpush);
			while($a = mysqli_fetch_array($pushtime)) { $llabel = $a['id'];}
			while($b = mysqli_fetch_array($pushdata)) { $ldata = $b['data'];}
			?>

			<script type="text/javascript">
				function adddata(){
					var data = <?php echo $llabel; ?>;
					if (data > tmp) {
						myBarChart.data.labels.push(<?php echo '"'. $llabel.'",';?>);
						myBarChart.data.datasets.forEach((dataset) => {
							dataset.data.push(<?php echo '"'.$ldata.'",'; ?>);
						});
						myBarChart.update();
						tmp = data;
					}
				}
			</script> 
		</div>

		<script type="text/javascript">
			function loadlink(){
				$("#comments").load("load-comments.php", {
				//	 commentNewCount : commentCount
			});
			}
		loadlink(); // This will run on page load
		setInterval(function(){
    		loadlink() // this will run after every 2 seconds
    	}, 2000);
		setInterval(function(){
    		adddata() // this will run after every 2 seconds
    	}, 2500);
    </script>

</body>
</html>