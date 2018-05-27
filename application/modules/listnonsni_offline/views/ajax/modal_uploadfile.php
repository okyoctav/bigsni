    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload File</h4>
      </div>
      <div class="modal-body">
        <form id="formupload">
          <input type="hidden" name="mbs_id" value="<?php echo $id; ?>">
          <input type="hidden" name="mts_id" value="<?php echo $idmts; ?>">
        	<div class="form-group">
    		  <label>Jenis File</label>
    		  <select class="form-control" name="mfs_mbsj_id">
    		  		<option>Pilih</option>
              <?php $query_jenis = $this->db->query("SELECT * FROM m_bigsni_jenis WHERE mbsj_mts_id = '".$idmts."'");
                    foreach ($query_jenis->result() as $key => $value) { ?>
              <option value="<?php echo $value->mbsj_id; ?>"><?php echo $value->mbsj_name; ?></option>
              <?php } ?>
    		  </select>
    		</div>
    		<div class="form-group">
    		  <label>Keterangan File</label>
    		  <textarea class="form-control" name="mfs_keterangan"></textarea>
    		</div>
    		<div class="form-group">
    		  <label>File</label>
    		  <input type="file" name="userfile">
    		</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onClick="saveupload()">Simpan Data</button>
      </div>
    </div>

<script type="text/javascript">
    function saveupload() {
        // ajax adding data to database
        var formData = new FormData($('#formupload')[0]);
        $.ajax({
          url : base_url+"listsni/saveupload",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          beforeSend: function(){
              $('#load_ajax').fadeIn(100);
              },
          success: function(msg){
              $('#load_ajax').fadeOut(100);
              $('#modal_add').modal('hide');
              location.reload(); 
              if(msg.status)
              {
                  popup(msg.msg);
              }
              else
              {
                  popup(msg.msg);
              }
          }
        });
    }

    
</script>