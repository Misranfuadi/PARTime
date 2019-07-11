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

  $nama = "";
  $username ="";
  $password ="";
  $email ="";
  $alamat ="";
  $type ="";
  $id = 0;
  $update = false;
  $tambah = hide;
  $tomboladd = show;
	
	if (isset($_GET['tambah'])) {
		$id = $_GET['tambah'];
		$tambah = show;
		$tomboladd = hide;
	}
 

  if (isset($_GET['edit_mu'])) {
    $id = $_GET['edit_mu'];
    $update = true;
	$tambah = show;
	$tomboladd = hide;
    $record = mysqli_query($connect, "SELECT * FROM master_user WHERE id=$id");

    if (count($record) == 1 ) {
      $n = mysqli_fetch_array($record);
      $nama =  $n['nama'];
      $username = $n['username'];
      $password = $n['password'];
      $email = $n['email'];
      $alamat = $n['alamat'];
      $type = $n['type'];
    }
  }
?>

<!--sidebar-menu-->
<div id="header">
  <h3 class="span12"><a>PARtime Admin</a></h3>
</div>
<div id="sidebar"> <a href="index_admin.php" class="visible-phone"><i class="icon icon-th"></i> Master User</a>
    <ul>
      <li ><a href="index_admin.php"><i class="icon icon-home"></i> <span>Home</span></a> </li>
      <li class="active"> <a href="master_user.php"><i class="icon icon-th"></i> <span>Master User</span></a></li>
      <li><a href="master_pengantri.php"><i class="icon icon-th"></i> <span>Master Pengantri</span></a></li>   
      <li> <a onclick="return confirm('Apakah yakin keluar?')"  href="app/logout.php"><i class="icon icon-share-alt"></i> <span>Keluar</span></a></li>
    </ul>
</div>


<div id="content">
      <?php if (isset($_SESSION['message'])): ?>
      <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']);
      ?>
    <?php endif ?>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Personal User Admin</h5>
          </div>
            <div class="widget-content nopadding">
				<a href="master_user.php?tambah" class="btn btn-primary btn-mini <?php echo $tomboladd;?>" >Tambah User Admin</a>
              <form action="app/crud_admin.php" method="post" class="form-horizontal <?php echo $tambah;?>">
                <div class="control-group">
                  <label class="control-label">Nama :</label>
                  <div class="controls">
                    <input type="text" name="nama" value="<?php echo $nama; ?>" required class="span5"/>
                  </div>
                </div>
                 <div class="control-group">
                  <label class="control-label">Type :</label>
                  <div class="controls">
                    <select name="type" required>
                      <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                      <option value="Bank">Bank</option>
                      <option value="Hospital">Hospital</option>  
                    </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Username :</label>
                  <div class="controls">
                    <?php if ($update == true): ?>
                    <input type="text" name="username" value="<?php echo $username; ?>" disabled class="span5"/>
                  <?php else: ?>
                    <input type="text" name="username" value="" required class="span5"/>
                  <?php endif ?>
                  </div>
                </div>
                

                <div class="control-group">
                  <label class="control-label">Password :</label>
                  <div class="controls">
                    <input type="password" name="password" value="<?php echo $password; ?>" required class="span5"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Email :</label>
                  <div class="controls">
                    <input type="text" name="email" value="<?php echo $email; ?>" required class="span5"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Alamat :</label>
                  <div class="controls">
                    <input type="text" name="alamat" value="<?php echo $alamat; ?>" required class="span5"/>
                  </div>
                </div>
               
                <div class="form-actions">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <?php if ($update == true): ?>
                    <button class="btn btn-warning" type="submit" name="update_mu">Edit</button>
                    <button class="btn btn-danger" type="submit" name="batal_mu" href="master_level.php">Batal</button>
                  <?php else: ?>
                    <button class="btn btn-primary" type="submit" name="save_mu" >Simpan</button>
                  <?php endif ?>
                  
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Personal User Admin</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th><h5>Nama</h5></th>
                  <th><h5>Type</h5></th>
                  <th><h5>Username</h5></th>
                  <th><h5>Email</h5></th>
                  <th><h5>Alamat</h5></th>
                  <th><h5>Aksi</h5></th>
                </tr>
              </thead>

                  <tbody>
                <?php 
                  //perintah menampilkan data
                $query = mysqli_query($connect,"SELECT * FROM master_user");

                if($query==FALSE)
                {
                  die(mysql_error());
                }
                //perintah untuk membaca dan menampilkan data
                while ($data=mysqli_fetch_array($query))
               
                { $id=$data['id'];?>


                    <tr class="grade">
                      <td><?php echo $data['nama']; ?></td>
                      <td><?php echo $data['type']; ?></td>
                      <td><?php echo $data['username']; ?></td>
                      <td><?php echo $data['email']; ?></td>
                      <td><?php echo $data['alamat']; ?></td>
                      <td ><a href="master_user.php?edit_mu=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini" >Edit</a>
                          <a onclick="return confirm('Apakah yakin menghapus data ?')"  href="app/crud_admin.php?delete_mu=<?php echo $data['username'];?>" class="btn btn-danger btn-mini  ">hapus</a>
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