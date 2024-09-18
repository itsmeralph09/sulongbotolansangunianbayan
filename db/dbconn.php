<?php
	$servername="localhost";
	$uname="root";
	$pass="";
	$dbname="sb_db";

	$con = mysqli_connect($servername, $uname, $pass, $dbname);

	if (!$con) {

		$servername="localhost";
		$uname="u293681336_szp";
		$pass="Moondrop#123";
		$dbname="u293681336_szp";

		$con = mysqli_connect($servername, $uname, $pass, $dbname);
		
		if (!$con) {
			echo 'Error connecting to database'.mysqli_connect_error($con);
		}

	}
?>