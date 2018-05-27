<?php foreach ($data as $key => $value); ?>
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
  </div>
  <div class="modal-body">
    <!-- FORM -->
    <form id="form_edit">
        <input type="hidden" name="mbs_id" value="<?php echo $value->mbs_id; ?>">
        <!-- KONTEN -->
        <div class="form-group">
          <label>Kode</label>
          <input type="text" class="form-control" readonly name="Field" style="background-color:#fffec7;cursor: not-allowed;" value="<?php echo $value->mbs_syscode; ?>">
        </div>

        <div class="form-group">
          <label>Nama SNI</label>
          <input type="text" class="form-control" name="mbs_namesni" value="<?php echo $value->mbs_namesni; ?>">
        </div>
        <div class="form-group">
          <label>Kode SNI</label>
          <input type="text" class="form-control" name="mbs_kodesni" value="<?php echo $value->mbs_kodesni; ?>">
        </div>
        <div class="form-group">
          <label>Type SNI</label>
          <select name="mbs_type" class="form-control">
              <?php if($value->mbs_type=='1') { ?>
              <option value="1" selected>SNI</option>
              <option value="2">NON SNI</option>
              <?php } elseif($value->mbs_type=='2') { ?>
              <option value="1">SNI</option>
              <option value="2" selected>NON SNI</option>
              <?php } else { ?>
              <option selected>Pilih</option>
              <option value="1">SNI</option>
              <option value="2">NON SNI</option>
              <?php } ?>
          </select>
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