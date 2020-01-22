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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<title>Ajax Chart</title>
	<style type="text/css">
		.container {
			width: 60%;
			margin: 15px auto;
		}
	</style>

</head>
<body>

	<script type="text/javascript">
		var tmp = 13;
	</script>

<?php  
	$sqlpush = "SELECT * FROM data ORDER BY id DESC LIMIT 1";
	$pushdata = mysqli_query($conn, $sqlpush);
	$pushtime = mysqli_query($conn, $sqlpush);
	while($a = mysqli_fetch_array($pushtime)) { $llabel = $a['id'];}
	while($b = mysqli_fetch_array($pushdata)) { $ldata = $b['data'];}
	?>

	<script type="text/javascript">
		var data = <?php echo $llabel; ?>;
			window.alert(data);
			window.alert(tmp);
	</script>

	</body>
	</html>