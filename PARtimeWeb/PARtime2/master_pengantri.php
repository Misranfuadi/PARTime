<?php
  session_start();

  if ( isset( $_SESSION["titel"] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: app/logout.php");
}
  include ('header.html');
  include ('app/conn.php');
  include ('app/crud_admin.php');

  $nama_p = "";
  $password_p = "";
  $username_p = "";
  $status_p = "";

  $id_p= 0;
  $update_p = false;
  $tambah = hide;
  $tomboladd = show;
	
	if (isset($_GET['tambah'])) {
		$id = $_GET['tambah'];
		$tambah = show;
		$tomboladd = hide;
	}

  if (isset($_GET['edit_p'])) {
    $id_p = $_GET['edit_p'];
    $update_p = true;
	$tambah = show;
	  $tomboladd = hide;
    $record = mysqli_query($connect, "SELECT * FROM master_pengantri WHERE id=$id_p");

    if (count($record) == 1 ) {
      $n = mysqli_fetch_array($record);
      $nama_p = $n['nama'];
      $password_p = $n['password'];
      $username_p = $n['username'];
      $status_p = $n['status'];
    }
	$tampungStatus = $status_p;
		if($tampungStatus == 1){
			$tampungStatus = "Aktif";
		}else{
			$tampungStatus = "Blocked";
		}
  }
?>

<div id="header">
  <h3 class="span12"><a>PARtime Admin</a></h3>
</div>
<!--sidebar-menu-->
<div id="sidebar"> <a href="index_admin.php" class="visible-phone"><i class="icon icon-th"></i> Master Pengantri</a>
    <ul>
     <li><a href="index_admin.php"><i class="icon icon-home"></i> <span>Home</span></a> </li>
      <li><a href="master_user.php"><i class="icon icon-th"></i> <span>Master User</span></a></li>
      <li  class="active" ><a href="master_pengantri.php"><i class="icon icon-th"></i> <span>Master Pengantri</span></a></li>   
      <li> <a onclick="return confirm('Apakah yakin keluar?')"  href="app/logout.php"><i class="icon icon-share-alt"></i> <span>Keluar</span></a></li>
    </ul>
</div>

<div id="content">
  <?php if (isset($_SESSION['message'])): ?>
      <div class="alert alert-success alert-block text-center"> <a class="close" data-dismiss="alert">×</a>
      <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']);
    ?>
  </div>
<?php endif ?>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Personal Pengantri</h5>
          </div>
            <div class="widget-content nopadding">
			   <a href="master_pengantri.php?tambah" class="btn btn-primary btn-mini <?php echo $tomboladd;?>" >Tambah User Pengantri</a>
              <form action="app/crud_admin.php" method="post" class="form-horizontal <?php echo $tambah;?>">
                <div class="control-group">
                  <label class="control-label">Nama :</label>
                  <div class="controls">
                    <input type="text" name="nama_p" value="<?php echo $nama_p; ?>" required class="span5"/>
                  </div>
                </div>
				<div class="control-group">
                  <label class="control-label">Username :</label>
                  <div class="controls">
                    <input type="text" name="username_p" value="<?php echo $username_p; ?>" required class="span5"/>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label">Password :</label>
                  <div class="controls">
                    <input type="password" name="password_p" value="<?php echo $password_p; ?>" required class="span5"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Status :</label>
                  <div class="controls">
                    <select name="status_p" required class="span5">
						<option value="<?php echo $status_p; ?>"><?php echo $tampungStatus; ?></option>
                        <option value="1">Aktif</option>
                        <option value="0">Bloked</option>  
                    </select>
                  </div>
                </div>
                <div class="form-actions">
                  <input type="hidden" name="id_p" value="<?php echo $id_p; ?>">
                  <?php if ($update_p == true): ?>
                    <button class="btn btn-warning" type="submit" name="update_p">Edit</button>
                    <button class="btn btn-danger" type="submit" name="batal_p" href="master_pengantri.php">Batal</button>
                  <?php else: ?>
                    <button class="btn btn-primary" type="submit" name="save_p" >Simpan</button>
                  <?php endif ?>
                  
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Personal Pengantri</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th><h5>Nama</h5></th>
                  <th><h5>Username</h5></th>
                  <th><h5>Status</h5></th>
                  <th><h5>Aksi</h5></th>
                </tr>
              </thead>

                  <tbody>
                <?php 
                  //perintah menampilkan data
                $query = mysqli_query($connect,"SELECT * FROM master_pengantri");

                if($query==FALSE)
                {
                  die(mysql_error());
                }
                //perintah untuk membaca dan menampilkan data
                while ($data=mysqli_fetch_array($query))
               
                { $id_p=$data['id'];?>


                    <tr class="grade">
                      <td><?php echo $data['nama']; ?></td>
                      <td><?php echo $data['username']; ?></td>
                      <td>
					  <?php 
						$tampungdataStatus = $data['status'];
						
						if($tampungdataStatus == 1){
							echo "Aktif";
						}else{
							echo "Blocked";
						}
						?>
					  
					  </td>
                      <td><a href="master_pengantri.php?edit_p=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini" >Edit</a>
                          <a onclick="return confirm('Apakah yakin menghapus data?')" <?php echo "href='app/crud_admin.php?delete_p=$data[id]'"?> class='btn btn-danger btn-mini'>hapus</a>
                      </td>
                    </tr>
                <?php } ?>    
                  </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>




<!--Footer-part-->
<div class="row-fluid">`
  <div id="footer" class="span12"> <?php echo date("Y");?> &copy; PARTime Admin</div>
</div>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.tables.js"></script>