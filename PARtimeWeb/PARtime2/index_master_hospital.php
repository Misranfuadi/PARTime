<?php
  session_start();

  if ( isset( $_SESSION["titel"] ) ) {

    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: app/logout.php");
}
  include "header.html";
  include ('app/conn.php');  
  $tabel = $_SESSION["tabel"];

?>
<div id="header">
  <h3 class="span12"><a>PARtime Admin <?php echo  $_SESSION["titel"] ;  ?></a></h3>
</div>

<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="active"><a href="index_master_hospital.php"><i class="icon icon-home"></i> <span>Home</span></a> </li>
    <li><a href="tables_hospital.php"><i class="icon icon-th"></i> <span>Tables Personal Poli</span></a></li>
    <li><a href="pengantri_hospital.php"><i class="icon icon-th"></i> <span>Tables Personal Pengantri</span></a></li>
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
        <div id="show">
        </div>
      </div>
      <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-inbox"></i></span>
            <h5>Penggunaan Ruang</h5>
          </div>
          <div class="widget-content">
              <?php 
                $querydata = mysqli_query($connect,"SELECT * FROM  pengantri_$tabel ");
                $pengantri = mysqli_num_rows($querydata);
                $kapasitas = $pengantri/500*100

              ?>
              <div class="progress progress-mini active progress-striped">
                <div style="width: <?php echo $kapasitas?>%;" class="bar"></div>
              </div>
              <span class="percent"> <?php echo $kapasitas?>%</span>
              <div class="stat"><?php echo $pengantri?> / 500 Pengantri</div>
          </div>
        </div>
    </div>
  </div>
</div>
</div>
<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date("Y");?> &copy; PARTime Admin</div>
</div>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      setInterval(function () {
        $('#show').load('show_indexmaster_hospital.php')
      }, 1000);
    });
  </script>
</script>