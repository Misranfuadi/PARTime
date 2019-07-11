<?php

include '../db_connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] === 'POST')
{
  $username = $_REQUEST["username"];
  $spesialis = $_REQUEST["spesialis"];
  $dokter = $_REQUEST["nama"];
  $namauser= $_REQUEST["namauser"];
	
	
	
  	$query =  mysqli_query($conn,"SELECT * FROM  pengantri_$username WHERE dokter= '$dokter' AND spesialis='$spesialis' AND nama='$namauser' ");
    $data = mysqli_fetch_array($query);
	$nomor = $data["nomor"];
	$status = $data["status"];
	
	if($status == 1){
		$status = "Menunggu";
		
	}else if($status == 2){
		$status = "Terpanggil";
	}else if ($status == null){
		$status = "Belum Mengantri";
	}
	
	
	
	
	$querytmpt =  mysqli_query($conn,"SELECT * FROM  master_user  WHERE type = 'Hospital' AND username = '$username' ");
    $datatmpt = mysqli_fetch_array($querytmpt);
	$tempat = $datatmpt["nama"];
	$alamat = $datatmpt["alamat"];
	

	
    $sqltotal =  mysqli_query($conn,"SELECT * FROM  pengantri_$username WHERE spesialis='$spesialis' AND dokter='$dokter' ");
    $total = mysqli_num_rows($sqltotal);

    $sqlcall =  mysqli_query($conn,"SELECT * FROM  pengantri_$username WHERE dokter= '$dokter' AND spesialis='$spesialis' AND status='2' ");
    $terpanggil = mysqli_num_rows($sqlcall);

    $sqlwait =  mysqli_query($conn,"SELECT * FROM  pengantri_$username WHERE dokter= '$dokter' AND spesialis='$spesialis' AND status='1' ");
    $menunggu = mysqli_num_rows($sqlwait);

    $dataArray = array(); 

	if($nomor== null){
		$nomor = 0;
	}

	
	echo	'{';
  	echo 	' "'.$dokter.'": {';
  	
  	echo 	'
			"tempat":"'.$tempat.'",
			"alamat":"'.$alamat.'",
  			"total":"'.$total.'",
			"terpanggil":"'.$terpanggil.'",
			"menuggu":"'.$menunggu.'",
			"nomor":"'.$nomor.'",
			"status":"'.$status.'"
		
  		';
  	echo 	'}}';
     
  
  }
  
?>