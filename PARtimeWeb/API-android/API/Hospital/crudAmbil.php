<?php 
  include '../db_connect.php';
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  //---------------------------------------------------------------
  if ($_SERVER["REQUEST_METHOD"] === 'POST')
  {
    $namauser = $_REQUEST["namauser"];
    $nama = $_REQUEST["nama"];
	$username = $_REQUEST["username"];
    $spesialis = $_REQUEST["spesialis"];
   
    
     // QUERY Here [get data app] !!
	$query2 = "SELECT * FROM pengantri_$username where nama = '$namauser'  ORDER BY id ASC LIMIT 1;";
    $result2 = mysqli_query($conn, $query2);
    $data2 = mysqli_fetch_array($result2);
    $status = $data2['status'];
	  if ($status == null){
	  $status = 2;
	  }
	  
	  
    $query = "SELECT * FROM pengantri_$username WHERE dokter='$nama'  ORDER BY id DESC LIMIT 1;";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);
    $nomor = $data['nomor'];
	
	   
	$query4 = "SELECT * FROM pengantri_$username WHERE dokter='$nama' AND nama = '$namauser' ORDER BY id DESC LIMIT 1;";
    $result4 = mysqli_query($conn, $query4);
    $data4 = mysqli_fetch_array($result4);
	$namaada = $data4['nama'];
	$nomor1 = $data4['nomor'];
	  
 
	  
	  
    if($namaada !== $namauser ){
		if ($status == 1){
		echo '{ "msg":"ANDA SEDANG MENGANTRI DI TEMPAT LAIN"}';
		}
		else if($nomor == null){
			
      	$query = "INSERT INTO pengantri_$username (nomor,nama,spesialis,dokter,status) VALUES ('1','$namauser','$spesialis','$nama','1');";
      	$result = mysqli_query($conn, $query);
		
		
    	
		$query1 = "SELECT nomor FROM pengantri_$username WHERE dokter='$nama' ORDER BY id DESC LIMIT 1;";
    	$result1 = mysqli_query($conn, $query1);
		$data1 = mysqli_fetch_array($result1);
        $nomor = $data1['nomor'];	
      	echo '{ "msg":"SUKSES NOMOR ANTRIAN ANDA '.$nomor.'"}';
    	}
		else
		{
      	$nomor++; 
      	$query = "INSERT INTO pengantri_$username (nomor,nama,spesialis,dokter,status) VALUES ('$nomor','$namauser','$spesialis','$nama','1');";
      	$result = mysqli_query($conn, $query);
			
		
			
		$query1 = "SELECT nomor FROM pengantri_$username WHERE dokter='$nama' ORDER BY id DESC LIMIT 1;";
    	$result1 = mysqli_query($conn, $query1);
		$data1 = mysqli_fetch_array($result1);
        $nomor = $data1['nomor'];
      	echo '{ "msg":"SUKSES NOMOR ANTRIAN ANDA '.$nomor.'"}';
	
    	}
	} else{
		echo '{ "msg":"ANDA SUDAH MENGANTRI DI NOMOR '.$nomor1.'"}';
	}
	 

  }
    
?>