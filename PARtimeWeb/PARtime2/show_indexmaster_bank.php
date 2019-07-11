<?php
session_start();
  if ( isset( $_SESSION["titel"] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: app/logout.php");
}
$tabel = $_SESSION["tabel"];


include 'app/conn.php';

	
?>

<?php 
                $nomor_loket='';
                $type_loket='';
                  //perintah menampilkan data
                $query = mysqli_query($connect,"SELECT * FROM $tabel  where status='buka' ORDER BY type_loket  ASC ");

                if($query==FALSE)
                {
                  die(mysql_error());
                }
                //perintah untuk membaca dan menampilkan data
                while ($data=mysqli_fetch_array($query))
                { $id=$data['id']; 
                  $tanggal = $data['tanggal'];?>
          <div class="widget-title"> <span class="icon"> <i class="icon-refresh"></i> </span>
            <h5>Antrian  <?php echo $type_loket=$data['type_loket']; ?></h5>
          </div>
          <div class="widget-content nopadding updates">
            <div class="new-update clearfix"><i class="icon-ok-sign"></i>
              <div class="update-done"><a title=""></a> 
                <span><?php echo date("D ", strtotime($tanggal)); echo date("d-m-Y", strtotime($tanggal));?><br> 
                  <?php echo $data['buka']; ?> - <?php echo $data['tutup']; ?></span>
              </div>
              <div class="pull-right">
                  <a  onclick="return confirm('Apakah yakin mereset antrian pada <?php echo $type_loket ?> ?')" href="app/crud_bank.php?reset=<?php echo $data['type_loket']; ?>" class="btn btn-danger" >Reset Antrian  <span class="icon-trash"></a>
              </div>
              <div class="widget-plain">
                <ul class="stat-boxes2 pull-right">

                  <?php

                  $noantrian = mysqli_query($connect,"SELECT * FROM  pengantri_$tabel where  type_loket='$type_loket' AND status='2' ORDER BY id DESC LIMIT 1");
                  $antrian = mysqli_fetch_array($noantrian);
                  $nomor = $antrian['nomor'];
                  if ($antrian['nomor']==null) {
                    $nomor = '0';
                  }

                  $sqltotal =  mysqli_query($connect,"SELECT * FROM  pengantri_$tabel WHERE  type_loket='$type_loket' ");
                  $total = mysqli_num_rows($sqltotal);

                  $sqlcall =  mysqli_query($connect,"SELECT * FROM  pengantri_$tabel WHERE type_loket='$type_loket' AND status='2' ");
                  $terpanggil = mysqli_num_rows($sqlcall);

                  $sqlwait =  mysqli_query($connect,"SELECT * FROM  pengantri_$tabel WHERE type_loket='$type_loket' AND status='1' ");
                  $menunggu = mysqli_num_rows($sqlwait);
                  ?> 

                  <li>
                    <div class="right"> <strong><?php echo $nomor; ?></strong>Nomor</div>
                    <div class="right">
                      <a  onclick="return confirm('Panggil antrian pada <?php echo $type_loket ?> ?')" href="app/crud_bank.php?panggil=<?php echo $data['type_loket']; ?>" class="btn btn-info">Next <span class="icon-play"></a>
                    </div>
                  </li> 

                  <li>
                    <div class="right"> <strong><?php echo $terpanggil; ?></strong>Terpanggil</div>
                  </li>
                  <li>
                    <div class="right"> <strong><?php echo $menunggu; ?></strong>Menunggu</div>
                  </li>
                  <li>
                    <div class="right"> <strong><?php echo $total; ?></strong>Total</div>
                  </li>
                </ul>
              </div>
              
            </div>
          </div>          
<?php } ?>

