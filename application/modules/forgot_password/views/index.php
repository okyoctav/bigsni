<!-- 
@author    Maulana Rahman <maulana.code@gmail.com>
-->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Lockscreen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/dist/fontawesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/dist/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/temaalus/dist/css/AdminLTE.min.css">

<script type="text/javascript">
base_url = '<?php echo base_url();?>';
	function goo() 
	{
		var email = $("#fp_email").val();
		if(email != "")
		{
		var form=$("#forgot-password-form");	
		$.ajax({
        	type:"POST",
        	url:base_url+"forgot_password/actiongo/",
        	data:form.serialize(),
        	beforeSend: function() 
        		{ $("#load_ajax").show(); },
        	complete: function() 
        		{ $("#load_ajax").hide(); },
  			success: function(msg)
  			{
     			if(msg == "FALSE")
     			{
     				alert("Email yang anda masukan salah / sudah pernah dikirimkan recovery password sebelumnya !");
     			}else{
     				alert("Reset password Email Sent! Anda akan otomatis diarahkan ke halaman Login ");
//     					setTimeout(function () {
//   						window.location.href = "<?php echo base_url();?>";
//						}, 2000);
					$("#test").html(msg);
     			}
        	}
   		});
		}else{
			alert("Harap masukan email !");
		}
  	}

  	function runScript(e)
	{
	    if(e.keyCode == 13)
	    {
	        e.preventDefault();
	        goo();
	    }
	}
</script>

</head>
<body class="hold-transition lockscreen">

<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="#"><b>Forgot</b>Password</a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name">Your E-mail :</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?php echo base_url('assets/avatar/avatar_default.png');?>" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form id="forgot-password-form" class="lockscreen-credentials" method="POST">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="E-mail" name="fp_email" id="fp_email" onkeypress="return runScript(event)" >
        <div class="input-group-btn">
          <button type="button" class="btn" onclick="goo()"><i class="fa fa-arrow-right text-muted" ></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Enter your e-mail to retrieve your recovery password
  </div>
  <div class="text-center">
    <a href="<?php echo base_url();?>">Or sign in</a>
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
