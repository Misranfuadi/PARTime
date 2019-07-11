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
?>

<div id="header">
  <h3 class="span12"><a>PARtime Admin <?php echo  $_SESSION["titel"] ;  ?></a></h3>
</div>
<!--sidebar-menu-->
<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-th"></i>Tables</a>
    <ul>
      <li><a href="index_master_hospital.php"><i class="icon icon-home"></i> <span>Home</span></a> </li>
      <li ><a href="tables_hospital.php"><i class="icon icon-th"></i> <span>Tables Personal Poli</span></a></li>
      <li class="active"><a href="pengantri_hospital.php"><i class="icon icon-th"></i> <span>Tables Personal Pengantri</span></a></li>
      <li> <a onclick="return confirm('Apakah yakin keluar?')"  href="app/logout.php"><i class="icon icon-share-alt"></i> <span>Keluar</span></a></li>
    </ul>
</div>

<div id="content">
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Personal Pengantri</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th><h5>Spesialis</h5></th>
                  <th><h5>Dokter</h5></th>
                  <th><h5>Nama</h5></th>
                  <th><h5>Nomor Antrian</h5></th>
                  <th><h5>Status</h5></th>
    
                </tr>
              </thead>

                  <tbody>
                <?php 
                  //perintah menampilkan data
                $query = mysqli_query($connect,"SELECT * FROM pengantri_$tabel");

                if($query==FALSE)
                {
                  die(mysql_error());
                }
                //perintah untuk membaca dan menampilkan data
                while ($data=mysqli_fetch_array($query))
               
                { $id=$data['id'];                  
                  if($data['status']=='1')
                  {
                    $status ="Menunggu";
                  }else
                  {
                    $status ="Terpanggil";
                  }?>
                    <tr class="grade">
                      <td><?php echo $data['spesialis']; ?></td> 
                      <td><?php echo $data['dokter']; ?></td>   
                      <td><?php echo $data['nama']; ?></td>
                      <td><?php echo $data['nomor']; ?></td>
                      <td><?php echo $status; ?></td>                                        
                    </tr>
                <?php } ?>    
                  </tbody>

            </table>
          </div>
        </div>
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