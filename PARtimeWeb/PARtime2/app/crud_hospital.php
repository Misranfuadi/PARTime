<?php 
	session_start();
	include "conn.php";
	$tabel = $_SESSION["tabel"];

	//===================== CRUD DOKTER ========================//
	

	if (isset($_POST['save'])) {
		$nama = $_POST['nama'];
		$spesialis = $_POST['spesialis'];
		$tanggal = $_POST['tanggal'];
		$buka = $_POST['buka'];
		$tutup = $_POST['tutup'];
		$status = $_POST['status'];

		mysqli_query($connect, "INSERT INTO $tabel (nama,spesialis,tanggal,buka,tutup,status) 
								VALUES ('$nama','$spesialis','$tanggal','$buka','$tutup','$status')"); 
		$_SESSION['message'] = "<h4 class='alert-heading'>Success!</h4> Data berhasil disimpan"; 
		header('location:../tables_hospital.php');
	}

	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$spesialis = $_POST['spesialis'];
		$tanggal = $_POST['tanggal'];
		$buka = $_POST['buka'];
		$tutup = $_POST['tutup'];
		$status = $_POST['status'];
		
		mysqli_query($connect, "UPDATE $tabel SET nama='$nama', spesialis='$spesialis', tanggal='$tanggal', buka='$buka', tutup='$tutup', status='$status' WHERE id=$id");
		$_SESSION['message'] = "<h4 class='alert-heading'>Success!</h4> Data berhasil diubah"; 
		header('location:../tables_hospital.php');
	}

		if (isset($_GET['delete'])) {
		$id = $_GET['delete'];
		mysqli_query($connect, "DELETE FROM $tabel WHERE id='$id'");
		$_SESSION['message'] = "<h4 class='alert-heading'>Success!</h4> Data berhasil dihapus"; 
		header('location:../tables_hospital.php');
	}

		if (isset($_POST['batal'])) { 
		$update = false;
		header('location:../tables_hospital.php');
	}

	//===================== CRUD Index_Master ========================//

	if (isset($_GET['reset'])) {
		$nama = $_GET['reset'];
		mysqli_query($connect, "DELETE FROM pengantri_$tabel WHERE dokter= '$nama'");
		mysqli_query($connect, "ALTER TABLE pengantri_$tabel AUTO_INCREMENT=0");
		$_SESSION['message'] = "<div class='alert alert-success alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Success!</h4> Antrian pada $nama berhasil direset</div>"; 
		header('location:../index_master_hospital.php');
	}

	if (isset($_GET['panggil'])) {
		$nama = $_GET['panggil'];

		$query =  mysqli_query($connect,"SELECT * FROM  pengantri_$tabel where dokter='$nama' AND status='1' ORDER BY id ASC LIMIT 1");
		$data  = mysqli_fetch_array($query);
		$status = $data['status'];
		$id = $data['id'];
		
		if ($status == null) {
			$_SESSION['message'] = "<div class='alert alert-warning alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Warning!</h4>Maaf Antrian pada $nama belum terdapat antrian</div>";
			header('location:../index_master_hospital.php');
		}
		else
		{
		mysqli_query($connect, "UPDATE pengantri_$tabel SET status='2' WHERE id=$id");
		header('location:../index_master_hospital.php');
		}
	}

?>