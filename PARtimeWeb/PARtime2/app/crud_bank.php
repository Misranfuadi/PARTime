<?php 
	session_start();
	include "conn.php";
	$tabel = $_SESSION["tabel"];

	//===================== CRUD BANK ========================//
	

	if (isset($_POST['save'])) {
		$type = $_POST['type'];
		$tanggal = $_POST['tanggal'];
		$buka = $_POST['buka'];
		$tutup = $_POST['tutup'];
		$status = $_POST['status'];

		$query =  mysqli_query($connect,"SELECT * FROM  $tabel WHERE type_loket='$type'");
		$data  = mysqli_fetch_array($query);

		if ($type !== $data['type_loket'] ){
			mysqli_query($connect, "INSERT INTO $tabel (type_loket,  tanggal, buka, tutup, status) 
								VALUES ('$type','$tanggal','$buka','$tutup','$status')"); 

			$_SESSION['message'] = "<div class='alert alert-success alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Success!</h4>Data berhasil di simpan</div>"; 
			header('location:../tables_bank.php');	
		}
		else{
			
			$_SESSION['message'] =  "<div class='alert alert-error alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Error!</h4>Data gagal di simpan pelayanan sudah pernah di simpan</div>"; 
			header('location:../tables_bank.php');
		}
		
	}

	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$type = $_POST['type'];
		$tanggal = $_POST['tanggal'];
		$buka = $_POST['buka'];
		$tutup = $_POST['tutup'];
		$status = $_POST['status'];

		$query =  mysqli_query($connect,"SELECT * FROM  $tabel");
		$data  = mysqli_fetch_array($query);


		mysqli_query($connect, "UPDATE $tabel SET type_loket='$type', tanggal='$tanggal', buka='$buka', tutup='$tutup', status='$status' WHERE id=$id");
		$_SESSION['message'] = "<div class='alert alert-success alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Success!</h4>Data berhasil di ubah</div>"; 
		header('location:../tables_bank.php');

	}

		if (isset($_GET['delete'])) {
		$id = $_GET['delete'];
		mysqli_query($connect, "DELETE FROM $tabel WHERE id='$id'");
		$_SESSION['message'] = "<div class='alert alert-success alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Success!</h4>Data berhasil di hapus</div>"; 
		header('location:../tables_bank.php');
	}

		if (isset($_POST['batal'])) { 
		$update = false;
		header('location:../tables_bank.php');
	}

	//===================== CRUD Index_Master Bank ========================//

	if (isset($_GET['reset'])) {
		$type  = $_GET['reset'];
		
		mysqli_query($connect, "DELETE FROM pengantri_$tabel WHERE type_loket='$type'");
		mysqli_query($connect, "ALTER TABLE pengantri_$tabel AUTO_INCREMENT=0");
		$_SESSION['message'] = "<div class='alert alert-success alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Success!</h4> Antrian pada $type  berhasil direset</div>"; 
		header('location:../index_master_bank.php');
	}

	if (isset($_GET['panggil'])) {
		$type = $_GET['panggil'];
		

		$query =  mysqli_query($connect,"SELECT * FROM  pengantri_$tabel where  type_loket='$type' AND status='1' ORDER BY id ASC LIMIT 1");
		$data  = mysqli_fetch_array($query);
		$status = $data['status'];
		$id = $data['id'];
		
		if ($status == null) {
			$_SESSION['message'] = "<div class='alert alert-warning alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Warning!</h4>Maaf Antrian pada $type belum terdapat antrian</div>";
			header('location:../index_master_bank.php');
		}
		else
		{
		mysqli_query($connect, "UPDATE pengantri_$tabel SET status='2' WHERE id=$id");
		header('location:../index_master_bank.php');
		}
	}

?>