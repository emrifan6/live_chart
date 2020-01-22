<?php 
include 'dbh.php';

 //$commentNewCount = $_POST['commentNewCount'];

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
