<?php
session_start();
$error=''; 

include "conn.php";
if(isset($_POST['submit']))
	{				
		$username	= $_POST['username'];
		$password	= $_POST['password'];
						
		$query = mysqli_query($connect, "SELECT * FROM master_user WHERE username='$username' AND password='$password'");
		if(mysqli_num_rows($query) == 0)
		{
			$error = "Username or Password is invalid";
		}
		else
		{
			$row = mysqli_fetch_assoc($query);
			if($row['username'] == "admin")
			{
				$_SESSION["titel"] = $row['nama'];
				header("Location:index_admin.php");
			}
			elseif($row['username'] !== "admin" && $row['type'] == "Hospital")
			{
				$_SESSION["tabel"] = $row['username'];
				$_SESSION["titel"] = $row['nama'];
				header("Location:index_master_hospital.php");
			}
			elseif($row['username'] !== "admin" && $row['type'] == "Bank")
			{
				$_SESSION["tabel"] = $row['username'];
				$_SESSION["titel"] = $row['nama'];
				header("Location:index_master_bank.php");
			}	
			else
			{
				$error = "Failed Login";
			}
		}
	}
if (isset($_POST['save_reg'])) {

		$nama =  $_POST['nama'];
		$username = $_POST['username2'];
		$password = $_POST['password2'];
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
				$_SESSION['message'] = "<div class='alert alert-success alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Success!</h4>Berhasil register</div>"; 
				header('location:../index.php');
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
				$_SESSION['message'] = "<div class='alert alert-success alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Success!</h4>Berhasil register</div>"; 
				header('location:../index.php');
			}
			
		}
		else
		{				
			session_start();
			$_SESSION['message'] = "<div class='alert alert-error alert-block text-center'> <a class='close' data-dismiss='alert'>×</a> <h4 class='alert-heading'>Error!</h4>Gagal register, username sudah terdaftar</div>";
			header('location:../index.php'); 
		}
		
	}