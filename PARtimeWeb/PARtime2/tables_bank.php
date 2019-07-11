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
  $tabel = $_SESSION["tabel"];

    $type = "";
    $tanggal =date("Y-m-d");
    $buka = "";
    $tutup = "";
    $status = "";
    $id = 0;
    $update = false;
	$tambah = hide;
  	$tomboladd = show;
	
	if (isset($_GET['tambah'])) {
		$id = $_GET['tambah'];
		$tambah = show;
		$tomboladd = hide;
	}

  if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
	$tambah = show;
	$tomboladd = hide;
    
    $record = mysqli_query($connect, "SELECT * FROM $tabel WHERE id=$id");
    if (count($record) == 1 ) {
      $n = mysqli_fetch_array($record);
      $type = $n['type_loket'];
      $tanggal = $n['tanggal'];
      $buka = $n['buka'];
      $tutup = $n['tutup'];
      $status = $n['status'];
    }
  }
?>

<div id="header">
  <h3 class="span12"><a>PARtime Admin <?php echo  $_SESSION["titel"] ;  ?></a></h3>
</div>
<?php if (isset($_SESSION['message'])): ?>
      <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']);
    ?>
<?php endif ?>
<!--sidebar-menu-->
<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-th"></i>Tables</a>
    <ul>
      <li><a href="index_master_bank.php"><i class="icon icon-home"></i> <span>Home</span></a> </li>
      <li class="active"><a href="tables_bank.php"><i class="icon icon-th"></i> <span>Table Personal Pelayanan</span></a></li>
      <li><a href="pengantri_bank.php"><i class="icon icon-th"></i> <span>Table Personal Pengantri</span></a></li>
      <li> <a onclick="return confirm('Apakah yakin keluar?')" name="keluar" href="app/logout.php"><i class="icon icon-share-alt"></i> <span>Keluar</span></a></li>
    </ul>
</div>

<div id="content">
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Personal Pelayanan</h5>
          </div>
            <div class="widget-content nopadding">
				<a href="tables_bank.php?tambah" class="btn btn-primary btn-mini  <?php echo $tomboladd;?>" >Tambah Pelayanan</a>
              <form action="app/crud_bank.php" method="post" class="form-horizontal <?php echo $tambah;?>">
                <div class="control-group">
                  <label class="control-label">Tipe Pelayanan :</label>
                  <div class="controls">
                    <select name="type" class="span5" required>
                      <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                      <option value="Customer Service">Customer Service</option>
                      <option value="Teller">Teller</option>  
                    </select>
                  </div>
                </div>
                <input type="hidden" name="tanggal" value="<?php echo date("Y-m-d");?>" required class="span5"/>
                <div class="control-group">
                  <label class="control-label">Buka :</label>
                  <div class="controls">
                    <input type="time" name="buka" value="<?php echo $buka; ?>" required class="span5"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Tutup :</label>
                  <div class="controls">
                    <input type="time" name="tutup" value="<?php echo $tutup; ?>" required class="span5" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Status :</label>
                  <div class="controls">
                    <select name="status" class="span5" required>
                      <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                      <option value="Buka">Buka</option>
                      <option value="Tutup">Tutup</option>  
                    </select>
                  </div>
                </div>
                <div class="form-actions">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <?php if ($update == true): ?>
                    <button class="btn btn-primary" type="submit" name="update">Ubah</button>
                    <button class="btn btn-danger" type="reset">Batal</button>
                    <button class="btn btn-warning pull-right" type="submit" name="batal">Kembali</button>
                  <?php else: ?>
                    <button class="btn btn-primary" type="submit" name="save" >Simpan</button>
                    <button class="btn btn-danger" type="reset">Hapus</button>
                  <?php endif ?>
                  
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Personal Pelayanan</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th><h5>Tipe Pelayanan</h5></th>
                  <th><h5>Tanggal</h5></th>
                  <th><h5>Buka</h5></th>
                  <th><h5>Tutup</h5></th>
                  <th><h5>Status</h5></th>
                  <th><h5>Aksi</h5></th>
                </tr>
              </thead>

                  <tbody>
                <?php 
                  //perintah menampilkan data
                $query = mysqli_query($connect,"SELECT * FROM $tabel" );

                if($query==FALSE)
                {
                  die(mysql_error());
                }
                //perintah untuk membaca dan menampilkan data
                while ($data=mysqli_fetch_array($query))
               
                { 
                  $tanggal = $data['tanggal'];?>


                    <tr class="grade">
                      <td><?php echo $data['type_loket']; ?></td>
                      <td><?php echo date("d-m-Y", strtotime($tanggal));?></td>
                      <td><?php echo $data['buka']; ?></td>
                      <td><?php echo $data['tutup']; ?></td>
                      <td><?php echo $data['status'];?></td>
                      <td><a href="tables_bank.php?edit=<?php echo $data['id']; ?>" class="btn btn-primary btn-mini" >Edit</a>
                          <a onclick="return confirm('Apakah yakin menghapus data?')" <?php echo "href='app/crud_bank.php?delete=$data[id]'"?> class='btn btn-danger btn-mini'>hapus</a>
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