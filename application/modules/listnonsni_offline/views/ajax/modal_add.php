<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
  </div>
  <div class="modal-body">
    <!-- FORM -->
    <form id="form_add">
    	<!-- KONTEN -->
    		<div class="form-group">
    		  <label>Kode</label>
    		  <input type="text" readonly class="form-control" style="background-color:#fffec7;cursor: not-allowed;" name="mbs_syscode" value="<?php echo $this->alus_auth->get_code('SN-SNI'); ?>">
    		</div>
        <div class="form-group">
          <label>Nama SNI</label>
          <input type="text" class="form-control" name="mbs_namesni">
        </div>
        <div class="form-group">
          <label>Kode SNI</label>
          <input type="text" class="form-control" name="mbs_kodesni">
        </div>

    	<!-- END KONTEN -->
    </form>
    <!-- END FORM -->
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" onClick="btn_save_add()" class="btn btn-primary">Save changes</button>
  </div>
</div>