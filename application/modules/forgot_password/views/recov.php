<!-- 
@author    Maulana Rahman <maulana.code@gmail.com>
-->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Alus | Recovery Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/dist/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/dist/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/dist/css/AdminLTE.min.css">
  <title>Your New Password</title>
</head>

<body class="hold-transition lockscreen">

<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="#"><b><?php echo $message;?></b></a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name">Your New Password :</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?php echo base_url('assets/avatar/avatar_default.png');?>" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <div class="lockscreen-credentials">
        <div class="text-center">
          <b><?php echo $new['new_password'];?></b>
        </div>
    </div>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
   Silahkan kembali ke halaman login dan gunakan password seperti diatas
  </div>
  <div class="text-center">
    <a href="<?php echo base_url();?>">Sign in</a>
  </div>
 
</div>
<!-- DETAIL -->
  <div class="text-center" id="test" style="background: rgba(252,234,187,1); margin:20px;">
    
  </div>
<!-- /.center -->
<script src="<?php echo base_url(); ?>assets/temaalus/plugins/jQuery/jquery-2.2.3.min.js"></script>

<script src="<?php echo base_url(); ?>assets/temaalus/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>