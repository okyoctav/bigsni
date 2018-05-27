<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
  </div>
  <div class="modal-body">
    <!-- FORM -->
    <form id="form_add" class="form-horizontal">
    	<!-- KONTEN -->
    		    <input type="hidden" readonly class="form-control" style="background-color:#fffec7;cursor: not-allowed;" name="mbs_syscode" value="<?php echo $this->alus_auth->get_code('SN-SNI'); ?>">
      
        <div class="form-group">
          <label class="col-sm-12">Nomor SNI</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" name="mbs_kodesni">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-6">Tahun</label>
          <label class="col-sm-6">ICS</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="mbs_tahun">
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="mbs_ics">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-12">Judul SNI</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" name="mbs_namesni">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-12">Judul ISO</label>
          <div class="col-sm-12">
            <input type="text" class="form-control" name="mbs_nameiso">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-6">PNP</label>
          <label class="col-sm-6">Konsensus</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="mbs_pnp">
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="mbs_konsensus">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-6">Jajak Pendapat</label>
          <label class="col-sm-6">Tanggal Penetapan</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="mbs_jajakpendapat">
          </div>
          <div class="col-sm-6">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input class="form-control pull-right" id="datepicker" name="mbs_tanggalpenetapan" type="text">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-6">SK Penetapan</label>
          <label class="col-sm-6">Keterangan</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="mbs_sk_penetepan">
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="mbs_keterangan">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-8">Klasifikasi</label>
          <label class="col-sm-4">Klas</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="mbs_klasifikasi">
          </div>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="mbs_klas">
          </div>
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

<script type="text/javascript">
$(document).ready(function() {
$('#datepicker').datepicker({
      autoclose: true,
       format: 'yyyy-mm-dd'
    })
});
</script>