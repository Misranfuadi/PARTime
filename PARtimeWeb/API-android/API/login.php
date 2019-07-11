<?php 
include 'db_connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
 
if ($_SERVER["REQUEST_METHOD"] === 'POST')
{
   $username= $_REQUEST["username"];
   $password= $_REQUEST["password"];
  
  
  // QUERY Here [get data app] !!
  $query = "SELECT * FROM  master_pengantri WHERE username ='$username' AND password='$password'";
  $result = mysqli_query($conn, $query);
  $ambil = mysqli_fetch_array($result);
  
  
  $nama = $ambil['nama'];
 

  if($ambil != null){
  	
  	echo	'{';
  	echo 	' "error":false,';
  	echo 	' "user": {';
  	
  	echo 	'
  			"nama":"'.$nama.'"
		
  		';
  	echo 	'}}';
  	

  }else{
    	echo 	'{
		  "error": true,
		  "error_msg": "Username atau Password salah"
		 }';
  }
}
  
?>