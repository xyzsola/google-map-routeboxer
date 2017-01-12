<?php

//buat koneksi mysqli
$con=new mysqli("localhost","root","","mapdb");

//cek koneksi
if ($con->connect_error){
	die("connection Failed : ".$con->connect_error);
}


?>
