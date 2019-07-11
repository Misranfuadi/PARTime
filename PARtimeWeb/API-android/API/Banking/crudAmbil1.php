<?php 
  include '../db_connect.php';
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  //---------------------------------------------------------------
  if ($_SERVER["REQUEST_METHOD"] === 'POST')
  {
    $namauser = $_REQUEST["namauser"];
	$username = $_REQUEST["username"];
    $type_loket = $_REQUEST["type_loket"];
   


     // QUERY Here [get data app] !!
    $query = "SELECT * FROM pengantri_$username WHERE type_loket='$type_loket' ORDER BY id DESC LIMIT 1;";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);
    $nomor = $data['nomor'];
	
	$query4 = "SELECT * FROM pengantri_$username WHERE type_loket='$type_loket'AND nama = '$namauser';";
	$result4 = mysqli_query($conn, $query4);
    $data4 = mysqli_fetch_array($result4);
	$namaada = $data4['nama'];
	$nomor1 = $data4['nomor'];  
 
	  
    if($namaada !==  $namauser){
		if($nomor == null){
      	$query = "INSERT INTO pengantri_$username (nomor,nama,type_loket,status) VALUES ('1','$namauser','$type_loket','1');";
      	$result = mysqli_query($conn, $query);
			
		 	
      	echo '{ "msg":"NOMOR ANTRIAN ANDA 1"}';
    	}
		else
		{
      	$nomor++; 
      	$query = "INSERT INTO pengantri_$username (nomor,nama,type_loket,status) VALUES ('$nomor','$namauser','$type_loket','1');";
      	$result = mysqli_query($conn, $query);
			
		$query1 = "SELECT nomor FROM pengantri_$username WHERE type_loket='$type_loket' ORDER BY id DESC LIMIT 1;";
    	$result1 = mysqli_query($conn, $query1);
		$data1 = mysqli_fetch_array($result1);
        $nomor = $data1['nomor'];
      	echo '{ "msg":"NOMOR ANTRIAN ANDA '.$nomor.'"}';
    	}
	}else{
		echo '{ "msg":"ANDA SUDAH MENGANTRI DI NOMOR '.$nomor1.'"}';
	}

  }
    
?>