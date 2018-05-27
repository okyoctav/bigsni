<!-- Product Alus Solution Licenced PHP Script -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="<?php echo base_url(); ?>/assets/temaalus/image/bigfavicon.png" type="image/gif" sizes="20x20">
  <title>BIG | SNI</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Icon Favicon -->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/temaalus/image/bigfavicon.png">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/dist/css/AdminLTE.min.css">
  <!-- toasty notif -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/temaalus/dist/css/toasty.css" >
  <!-- loader -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/temaalus/loader/css/loader-1.css">

  <style type="text/css">
  .cover{
    background: url('<?php echo base_url();?>/assets/temaalus/image/bg_nkri12.jpg');
    background-color: #f5f5f5;
    background-size: cover;
  }
  </style>
</head>

<body class="hold-transition login-page cover">
<div class="navbar" style="width:100%;height:50px;background:#001F3F;border-top:#001F3F 1px solid;padding:13px 20px;color:#fff;text-align:left;border-radius:0px;margin:0px;">
    <i class="fa fa-television"></i> &nbsp; BADAN INFORMASI GEOSPASIAL - SNI
</div>

<div class="login-box" id="login-box">
  <div class="login-logo">
      <!-- <a href="" style='color:red;'><b>KLINIK</b></a><a href="" style='color:orange;'><b> APP</b></a> -->

  </div>
  <!-- /.login-logo -->
  <?php //echo md5('Regional@159'); ?>
  <div class="login-box-body" style="background-color:rgba(255, 255, 255, 1);border:0.5px #dfdfdf solid;">
    <img src="<?php echo base_url(); ?>/assets/temaalus/image/logobig_login249.png" width="100%" style="border-bottom:1px #dfdfdf solid;padding-bottom:10px;margin-bottom:10px;">
    <p class="login-box-msg"><b>LOGIN APLIKASI SNI</b></p>

    <form action="<?php echo base_url('admin/Login/login'); ?>" method="post" id="form">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" name="identity" tabindex="1" id="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" tabindex="2" id="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
     
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
            	<!-- <a href="<?php echo base_url('forgot_password/');?>">Forgot Password ?</a> -->
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="button" class="btn btn-primary btn-block btn-flat" id="submitform" tabindex="3">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  
  <!-- /.login-box-body -->
  <div class="col-md-12" style="display:none;" id="load_ajax">
    <div style="border-radius: 100px;opacity: 0.8;">
      <h2 class="text-center"><img src="<?php echo base_url('assets/temaalus/loader/images/ripple.svg');?>" width="100px">LOADING</h2>
    </div>
  </div>

</div>


<!-- /.login-box -->


<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/temaalus/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/temaalus/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/temaalus/dist/js/m_login.js"></script>
<script src="<?php echo base_url(); ?>assets/temaalus/dist/js/toasty.js"></script>

<script type="text/javascript">

</script>

</body>
<div class="navbar navbar-default navbar-fixed-bottom footer" style="width:100%;height:50px;background:#fff;border-top:#dfdfdf 1px solid;padding:13px 20px;color:#4f6467;text-align:center;">@2018 BADAN INFORMASI GEOSPASIAL - by <a href="" style="color:#001F3F;"><b>Alus Technology</b></a></div>
</html>
