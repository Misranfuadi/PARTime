<?php

include '../db_connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] === 'GET')
{
  
  $query = "SELECT * FROM master_user WHERE  type = 'Bank' AND nama NOT LIKE 'Admin'";
  $result = mysqli_query($conn, $query);
  	
  		 $dataArray = array();  
  		
  		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
      $row_array['nama'] = $row ['nama'];
      $row_array['username'] = $row ['username'];
      $row_array['alamat'] = $row ['alamat'];

  	   array_push($dataArray, $row_array);
  }

  echo '{"list_tempat":';
  echo json_encode($dataArray);
  echo "}";
  
}
  

?>