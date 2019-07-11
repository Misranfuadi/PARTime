<?php

include '../db_connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] === 'POST')
{
  $namauser= $_REQUEST["namauser"];
  $username = $_REQUEST["username"];
  $type_loket = $_REQUEST["type_loket"];
 
	
	$query =  mysqli_query($conn,"SELECT * FROM  pengantri_$username WHERE type_loket= '$type_loket' AND nama='$namauser' ");
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
  
	
	$querytmpt =  mysqli_query($conn,"SELECT * FROM  master_user  WHERE type = 'Bank' AND username = '$username' ");
    $datatmpt = mysqli_fetch_array($querytmpt);
	$tempat = $datatmpt["nama"];
	$alamat = $datatmpt["alamat"];
  
   

    $result = mysqli_query($conn, "SELECT * FROM  $username  where  type_loket='$type_loket' AND status ='buka';");
  	$data = mysqli_fetch_array($result);

    $sqltotal =  mysqli_query($conn,"SELECT * FROM  pengantri_$username WHERE  type_loket='$type_loket' ");
    $total = mysqli_num_rows($sqltotal);

    $sqlcall =  mysqli_query($conn,"SELECT * FROM  pengantri_$username WHERE type_loket='$type_loket' AND status='2' ");
    $terpanggil = mysqli_num_rows($sqlcall);

    $sqlwait =  mysqli_query($conn,"SELECT * FROM  pengantri_$username WHERE type_loket='$type_loket' AND status='1' ");
    $menunggu = mysqli_num_rows($sqlwait);

    if($nomor == null){
		$nomor = 0;
	}
	
	 
	
	echo	'{';
  	echo 	' "'.$type_loket.'": {';
  	
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