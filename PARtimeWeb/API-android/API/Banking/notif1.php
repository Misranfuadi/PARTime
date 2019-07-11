<?php 
  include '../db_connect.php';
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  //---------------------------------------------------------------
  if ($_SERVER["REQUEST_METHOD"] === 'POST')
  {
    $namauser= $_REQUEST["namauser"];
 	$username = $_REQUEST["username"];
    $type_loket = $_REQUEST["type_loket"];
   
    
     // QUERY Here [get data app] !!
    $query =  mysqli_query($conn,"SELECT * FROM  pengantri_$username WHERE type_loket= '$type_loket' AND nama='$namauser' ");
    $data = mysqli_fetch_array($query);
	$nomor = $data["nomor"];
	  
	
	  
	 $noantrian = mysqli_query($conn,"SELECT * FROM  pengantri_$username where  type_loket='$type_loket' AND status='2' ORDER BY id DESC LIMIT 1");
                  $antrian = mysqli_fetch_array($noantrian);
                  $panggil = $antrian['nomor'];
	  
	 $sqlcall =  mysqli_query($conn,"SELECT * FROM  pengantri_$username WHERE type_loket='$type_loket' AND status='2' ");
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
	        		"isimsg":"Belum terpanggil antrian pada '.$type_loket.'",
					"pushnomor":"'.$nomor.'"}';
 
                  }else if ($nomor==$terpanggil) { 
					$panggil = '0';  
    				echo '{ "notmsg":"Nomor = '.$nomor.'",
	        		"isimsg":"Nomor anda sedang terpanggil pada '.$type_loket.'",
					"pushnomor":"'.$nomor.'"}';
 
                  }else{ 
					  echo '{ "notmsg":"Nomor = '.$nomor.' '.$peringatan.'",
	        		"isimsg":"Sekarang Antrian nomor '.$panggil.' pada '.$type_loket.'",
					"pushnomor":"'.$nomor.'"}';
 
				  }
	  
  }
    
?>