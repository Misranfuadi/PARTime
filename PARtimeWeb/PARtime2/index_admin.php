<?php
  include "header.html";
  include ('app/conn.php');
  session_start();
  if ( isset( $_SESSION["titel"] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: app/logout.php");
}
?>
<div id="header">
  <h3 class="span12"><a>PARtime Admin</a></h3>
</div>
<div id="sidebar"> <a href="index_admin.php" class="visible-phone"><i class="icon icon-home"></i> Home</a>
    <ul>
      <li  class="active"><a href="index_admin.php"><i class="icon icon-home"></i> <span>Home</span></a> </li>
      <li><a href="master_user.php"><i class="icon icon-th"></i> <span>Master User</span></a></li>
      <li><a href="master_pengantri.php"><i class="icon icon-th"></i> <span>Master Pengantri</span></a></li>   
      <li> <a onclick="return confirm('Apakah yakin keluar?')"  href="app/logout.php"><i class="icon icon-share-alt"></i> <span>Keluar</span></a></li>
    </ul>
</div>


<div id="content">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
        
    </div>
  </div>
</div>
</div>
<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date("Y");?> &copy; PARTime Admin</div>
</div>