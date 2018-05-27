<?php foreach ($data as $key => $value); ?>
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
  </div>
  <div class="modal-body">
    <!-- FORM -->
    <form id="form_edit">
        <input type="hidden" name="mkb_id" value="<?php echo $value->mkb_id; ?>">
        <!-- KONTEN -->
        <div class="form-group">
          <label>Nama Kategori</label>
          <input type="text" class="form-control" name="mkb_nama" value="<?php echo $value->mkb_nama; ?>">
        </div>
        <!-- END KONTEN -->
    </form>
    <!-- END FORM -->
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" onClick="btn_save_edit()" class="btn btn-primary">Save changes</button>
  </div>
</div>