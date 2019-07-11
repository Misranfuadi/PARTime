<?php
include('app/login.php');
?>
<!DOCTYPE html>
    
<head>
        <title>PARtime Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
		<link rel="icon" type="image/gif" href="icon/logoP.png" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
    <div id="content">
   <?php if (isset($_SESSION['message'])): ?>
      
      <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']);
      ?>
    </div>
    <?php endif ?>
        <div id="loginbox">            
            <form role="form" class="form-vertical" action="" method="post">
				<div class="control-label span2">
              <img src="icon/logoP.png" alt="icon" >
          </div>
          <div class="control-group">
              <h3><b  style="color:white;">Selamat Datang pada PARtime Admin</b></h3>
          </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" name="username" placeholder="Username" required />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="password" placeholder="Password"  required />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button class="pull-right btn btn-success" type="submit" name="submit">LOGIN</button>
                    <span  data-toggle="modal" data-target="#myModal" class="btn btn-warning">DAFTAR DISINI</span>
                    <h6 style="color:white;"><?php echo $error; ?></h6>
                </div>
            </form>
        </div>
            <!-- Modal -->
        <div class="modal hide" id="myModal" role="dialog">
            <div class="modal-dialog">
              
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Daftar PARTime</h4>
                  </div>
                  <div class="modal-body">
                     <form action="app/login.php" method="POST" class="form-horizontal">
                      <div class="control-group">
                        <label class="control-label">Nama :</label>
                        <div class="controls">
                          <input type="text" name="nama" value="" required class="span3"/>
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label">Type :</label>
                        <div class="controls">
                          <select name="type" class="span3" required>
                            <option value="">Pilih tipe pelayanan</option>
                            <option value="Bank">Bank</option>
                            <option value="Hospital">Hospital</option>  
                          </select>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Username :</label>
                        <div class="controls">
                          <input type="text" name="username2" value="" required class="span3"/>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">Password :</label>
                        <div class="controls">
                          <input type="password" name="password2" value="" required class="span3"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Email :</label>
                        <div class="controls">
                          <input type="text" name="email" value="" required class="span3"/>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Alamat :</label>
                        <div class="controls">
                          <input type="text" name="alamat" value="" required class="span3"/>
                        </div>
                      </div>
                      <div class="modal-footer">
                          <button class="btn btn-primary" type="submit" name="save_reg" >Register</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>

        
        <script src="js/jquery.min.js"></script>  
        <script src="js/matrix.login.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>

</html>
