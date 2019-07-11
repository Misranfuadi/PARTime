<?php 
  include 'db_connect.php';
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  //---------------------------------------------------------------
  if ($_SERVER["REQUEST_METHOD"] === 'POST')
  {
    $nama = $_REQUEST["nama"];
	$username = $_REQUEST["username"];
    $password = $_REQUEST["password"];
   
    
    
     // QUERY Here [get data app] !!
    $query3 = "SELECT * FROM master_pengantri WHERE username='$username';";
    $result3 = mysqli_query($conn, $query3);
    $ambil3 = mysqli_fetch_array($result3);
    
    if($ambil3 !=null){
    echo '{ "msg":"Username sudah terdaftar"}';
    }else{
      // QUERY INSERT 
      $query = "INSERT INTO master_pengantri (nama,username,password,status) VALUES ('$nama','$username','$password','1');";
      $result = mysqli_query($conn, $query);
      
      if($result != null){
      echo '{ "msg":"Berhasil"}';
      }else{
      echo   '{
        "error": true,
        "error_msg": "Gagal memasukkan data!"
       }';
      }
    }
  }
    
?>