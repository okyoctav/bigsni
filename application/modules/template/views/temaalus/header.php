<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/temaalus/image/bigfavicon.png">
  <title><?php echo $title; ?> | SNI</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/dist/fontawesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/dist/ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/dist/css/skins/_all-skins.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/dist/css/toasty.css">
  
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <script src="<?php echo base_url(); ?>assets/temaalus/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url(); ?>assets/temaalus/bootstrap/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url(); ?>assets/temaalus/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/temaalus/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/temaalus/plugins/datatables/FixedColumns-3.2.4/js/dataTables.fixedColumns.min.js"></script>
  <!-- Toasty Notif -->
  <script src="<?php echo base_url(); ?>assets/temaalus/dist/js/toasty.js"></script>

  <script src="<?php echo base_url(); ?>assets/temaalus/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

  <script type="text/javascript">
      var base_url = "<?php echo base_url(); ?>";
  </script>
  <style type="text/css">
    .load_ajax
    {
      width: 100%;
      height: 100%;
      background:rgba(0,0,0, 0.8);
      position:fixed;
      z-index: 2000;
      text-align: center;
      padding: 150px 0px 0px 0px;
      margin:0px;
      display: none;
    }  
  </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue sidebar-mini">
  <div class="load_ajax" id="load_ajax" style="display:none;">
      <img src="<?php echo base_url(); ?>assets/temaalus/loader/ripple.svg" id="load_img" width="100px">
  </div>
<div class="wrapper">

  <header class="main-header">
     <a href="<?php echo base_url('dashboard');?>" class="logo">
        <img src="<?php echo base_url('assets/logo/big_logo2.png'); ?>" width="30">
        <span><b>BIG</b> - SNI</span>
      </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

        <div class="navbar-custom-menu" >
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo base_url('assets/avatar')."/".$this->session->userdata('avatar');?>" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name') ;?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?php echo base_url('assets/avatar')."/".$this->session->userdata('avatar');?>" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $this->session->userdata('job'); ?>
                    <small><?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name') ;?></small>
                  </p>
                </li>
                <!-- Menu Body -->
               
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url('user_profile');?>" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url(); ?>admin/login/logout" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div> 
        <!-- /.navbar-custom-menu -->
      <!-- /.container-fluid -->
    </nav>
  </header>

   <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/avatar')."/".$this->session->userdata('avatar');?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name') ;?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <?php echo $this->Alus_hmvc->get_menu(); ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<!--   <div style="height:50px;background:#ecf0f5;text-align:center;margin-left:230px;position:fixed;background-image:url('')" id="load_ajax_deep">
    <img src="<?php echo base_url(); ?>assets/temaalus/loader/loadgig.svg" width="110px">    
  </div> -->
  <div id="badan_isi">