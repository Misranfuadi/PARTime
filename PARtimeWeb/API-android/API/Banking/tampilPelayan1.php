<?php

include '../db_connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] === 'POST')
{
  $username = $_REQUEST["username"];
  

  $query = "SELECT * FROM  $username where status='buka'; ";
  $result = mysqli_query($conn, $query);
    
       $dataArray = array();  
  		
  	  while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
		$tanggal =$row['tanggal'];
      $row_array['type_loket'] = $row ['type_loket'];
	  $row_array['tanggal'] = date("d-m-Y", strtotime($tanggal));
      $row_array['buka'] = $row ['buka'];
      $row_array['tutup'] = $row ['tutup'];
	  $row_array['status'] = $row ['status'];	

  	   array_push($dataArray, $row_array);
  }

  echo '{"'.$username.'":';
  echo json_encode($dataArray);
  echo "}";
}
?>