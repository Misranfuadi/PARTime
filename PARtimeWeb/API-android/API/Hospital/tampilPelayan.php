<?php

include '../db_connect.php';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] === 'POST')
{
  
  $username = $_REQUEST["username"];
  

  $query = "SELECT * FROM  $username  WHERE  status='Buka' GROUP BY spesialis; ";
  $result = mysqli_query($conn, $query);
    
      	 $dataArray = array();  
  		
  		while($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
     
      $row_array['spesialis'] = $row ['spesialis'];
     

  	   array_push($dataArray, $row_array);
  }

  echo '{"'.$username.'":';
  echo json_encode($dataArray);
  echo "}";
  
}
  

?>