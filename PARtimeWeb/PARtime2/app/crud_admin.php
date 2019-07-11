<?php 
	include "conn.php";
	//===================== CRUD Master User ========================//



	if (isset($_POST['save_mu'])) {

		$nama =  $_POST['nama'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];
		$type = $_POST['type'];

		$query =  mysqli_query($connect,"SELECT * FROM master_user where username='$username'");
		$data  = mysqli_fetch_array($query);

		if ($username != $data['username'])
		{
			if ($type =='Hospital') {

				mysqli_query($connect, "CREATE TABLE $username (
			    id int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			    nama varchar(100),
			    spesialis varchar(100),
			    tanggal date,
			    buka varchar(100),
			    tutup varchar(100),
			    status varchar(10))");
	
				mysqli_query($connect, "CREATE TABLE pengantri_$username (
				id int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			    nomor varchar(100),
			    nama varchar(100),
			    spesialis varchar(100),
			    dokter varchar(100),
			    status varchar(10))");
	
				mysqli_query($connect, "INSERT INTO master_user (nama,type,username,password,email,alamat) 
											VALUES ('$nama','$type','$username','$password','$email','$alamat')");
				session_start(); 
				$_SESSION['message'] = "<div class='alert alert-success alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Success!</h4> Data berhasil disimpan</div>"; 
				header('location:../master_user.php');
			}
			elseif ($type =='Bank') {
				mysqli_query($connect, "CREATE TABLE $username (
			    id int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			    type_loket varchar(100),
			    tanggal date,
			    buka varchar(100),
			    tutup varchar(100),
			    status varchar(10))");
	
				mysqli_query($connect, "CREATE TABLE pengantri_$username (
				id int(100) NOT NULL PRIMARY KEY AUTO_INCREMENT,
			    nomor varchar(100),
			    nama varchar(100),
			    type_loket varchar(100),
			    status varchar(10))");
	
				mysqli_query($connect, "INSERT INTO master_user (nama,type,username,password,email,alamat) 
											VALUES ('$nama','$type','$username','$password','$email','$alamat')"); 
				session_start();
				$_SESSION['message'] = "<div class='alert alert-success alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Success!</h4> Data berhasil disimpan</div>"; 
				header('location:../master_user.php');
			}
			
		}
		else
		{	
			
			session_start();
			$_SESSION['message'] = "<div class='alert alert-error alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Error!</h4>Data gagal di simpan, username duplikat</div>";
			header('location:../master_user.php'); 
		}
		
	}

	if (isset($_POST['update_mu'])) {
		$id = $_POST['id'];
		$nama =  $_POST['nama'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$alamat = $_POST['alamat'];
		$type = $_POST['type'];
		
		
		mysqli_query($connect, "UPDATE master_user SET nama='$nama', type='$type', password='$password', email='$email', alamat='$alamat' WHERE id=$id");
		session_start();
		$_SESSION['message'] = "<div class='alert alert-success alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Success!</h4> Data berhasil diubah</div>"; 
		header('location:../master_user.php');
		
		
	}

	if (isset($_GET['delete_mu'])) {
		$username = $_GET['delete_mu'];
		mysqli_query($connect, " DROP TABLE $username ");
		mysqli_query($connect, " DROP TABLE pengantri_$username ");
		mysqli_query($connect, "DELETE FROM master_user WHERE username='$username'");
		session_start();
		$_SESSION['message'] = "<div class='alert alert-success alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Success!</h4> Data berhasil dihapus</div>"; 
		header('location:../master_user.php');
	}

	if (isset($_POST['batal_mu'])) { 
		$nama = "";
		$username ="";
		$password ="";
		$email ="";
		$alamat ="";
		$type ="";

		
		$id = 0;
		$update_mu = false;
		header('location:../master_user.php');
	}

		//===================== CRUD PENGANTRI ========================//

	

	if (isset($_POST['save_p'])) {
		$nama_p = $_POST['nama_p'];
		$password_p = $_POST['password_p'];
		$username_p = $_POST['username_p'];
		$status_p = $_POST['status_p'];

		
		mysqli_query($connect, "INSERT INTO master_pengantri (nama ,password,username,status) 
								VALUES ('$nama_p', '$password_p','$email_p','$status_p')");
		session_start(); 
		$_SESSION['message'] = "<h4 class='alert-heading'>Success!</h4> Data berhasil disimpan"; 
		header('location:../master_pengantri.php');
	}

	if (isset($_POST['update_p'])) {
		$id_p = $_POST['id_p'];
		$nama_p = $_POST['nama_p'];
		$password_p = $_POST['password_p'];
		$username_p = $_POST['username_p'];
		$status_p = $_POST['status_p'];

		
		mysqli_query($connect, "UPDATE master_pengantri SET nama='$nama_p', password='$password_p', username='$username_p', status='$status_p' WHERE id=$id_p");
		session_start();
		$_SESSION['message'] = "<h4 class='alert-heading'>Success!</h4> Data berhasil diubah"; 
		header('location:../master_pengantri.php');
	}

		if (isset($_GET['delete_p'])) {
		$id_p = $_GET['delete_p'];
		mysqli_query($connect, "DELETE FROM master_pengantri WHERE id=$id_p");
		session_start();
		$_SESSION['message'] = "<h4 class='alert-heading'>Success!</h4> Data berhasil dihapus"; 
		header('location:../master_pengantri.php');
	}

		if (isset($_POST['batal_p'])) { 
		$nama_p = "";
		$password_p = "";
		$username_p = "";
		$id_p = 0;
		$update_p = false;
		header('location:../master_pengantri.php');
	}

?>




