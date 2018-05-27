</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.1
    </div>
    <strong>Copyright © 2018 Badan Informasi Geospasial </strong> - Support by <a href="https://alus.co">Alus</a>    
  </footer>
</body>

<script>
	$("#load_ajax").show();
	$(function() {
		$("#load_ajax").fadeOut('slow');
	});

function popup(ms = null) {
  if(ms == null)
  {
    $().toasty({
        message: "Berhasil",
        autoHide: 3000
    }); 
  }else{
    $().toasty({
        message: ms,
        autoHide: 3000
    }); 
  } 
  
}
</script>
<!-- ./wrapper -->
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/temaalus/dist/js/app.min.js"></script>
</html>
