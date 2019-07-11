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
    $query = "SELECT * FROM pengantri_$username WHERE dokter='$nama' AND nama ='$namauser' ORDER BY id DESC LIMIT 1;";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);
    $nomor = $data['nomor'];
	  
	
	  
	$noantrian = mysqli_query($conn,"SELECT * FROM  pengantri_$username where dokter='$nama' AND spesialis='$spesialis' AND status='2' ORDER BY id DESC LIMIT 1");
                  $antrian = mysqli_fetch_array($noantrian);
                  $panggil = $antrian['nomor'];
	  
	  $sqlcall =  mysqli_query($conn,"SELECT * FROM  pengantri_$username WHERE dokter= '$nama' AND spesialis='$spesialis' AND status='2' ");
    $terpanggil = mysqli_num_rows($sqlcall);
	  
	  $jumlah = $nomor - $terpanggil;
	  $peringatan;
	  if($jumlah <= 5 && $jumlah !== 0 && $jumlah > 0){
		  $peringatan = "Pastikan Ditempat  $jumlah  antrian lagi";
	  }else if ($jumlah < 0){
		  $peringatan = "Terpanggil";
	  }
	  
                  if ($antrian['nomor']==null) { 
					$panggil = '0';  
    				echo '{ "notmsg":"Nomor = '.$nomor.'",
	        		"isimsg":"Belum terpanggil antrian  '.$nama.'",
					"pushnomor":"'.$nomor.'"}';
 
                  }else if ($nomor==$terpanggil) { 
					$panggil = '0';  
    				echo '{ "notmsg":"Nomor = '.$nomor.'",
	        		"isimsg":"Nomor anda sedang terpanggil pada '.$nama.'",
					"pushnomor":"'.$nomor.'"}';
 
                  }else{ 
					  echo '{ "notmsg":"Nomor = '.$nomor.' '.$peringatan.'",
	        		"isimsg":"Sekarang Antrian nomor '.$panggil.' pada '.$nama.'",
					"pushnomor":"'.$nomor.'"}';
 
				  }
	  
  }
    
?>