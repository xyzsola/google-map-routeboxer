
<?php
	include "config.php";
	header("Content-type: text/javascript");

	$query = "SELECT * FROM info_lokasi";
	$data = $con->query($query);

	$results = array();
	while ($r = mysqli_fetch_assoc($data)) {
		# code...
		$results[] = $r;
	}
	echo json_encode($results);
	mysqli_close($con);
?>